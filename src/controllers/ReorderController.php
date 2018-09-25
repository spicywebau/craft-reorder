<?php
namespace spicyweb\reorder\controllers;

use Craft;
use craft\web\Controller;
use craft\commerce\Plugin as Commerce;

use spicyweb\reorder\Plugin as ReOrder;
use spicyweb\reorder\enums\OrderStatus;

/**
 * Class ReorderController
 *
 * @package spicyweb\reorder
 * @author Spicy Web <craft@spicyweb.com.au>
 * @since 1.0.0
 */
class ReorderController extends Controller
{
	/**
	 * Recreates a user's previous order's line items in their current cart.
	 */
	public function actionIndex()
	{
		$this->requirePostRequest();

		$defaultSettings = ReOrder::$plugin->getSettings();
		$request = Craft::$app->getRequest();
		$orderNumber = $request->getRequiredBodyParam('order');
		$retainCart = $request->getBodyParam('retainCart', $defaultSettings->retainCart);
		$allowPartial = $request->getBodyParam('allowPartial', $defaultSettings->allowPartial);

		$isAjaxRequest = $request->getIsAjax();
		$commerce = Commerce::getInstance();

		$error = null;
		$unavailableLineItems = [];
		$order = $orderNumber ? $commerce->getOrders()->getOrderByNumber($orderNumber) : null;
		$cart = null;

		if ($order !== null)
		{
			$currentUser = Craft::$app->getUser();
			$customer = $order->getCustomer();

			if ($customer !== null && $currentUser->id === $customer->userId)
			{
				$cart = $commerce->getCarts()->getCart();

				// The cart ID is used in the unavailable line items check to account for cart items' quantities when
				// determining quantity-based availability.  If we don't want to retain the current cart, then we don't
				// need to account for the cart and therefore don't need to pass the cart ID.
				$cartId = $retainCart ? $cart->id : null;
				$unavailableLineItems = ReOrder::$plugin->methods->getUnavailableLineItems($order, $cartId);

				if (empty($unavailableLineItems) || $allowPartial)
				{
					if (!$retainCart)
					{
						$commerce->getLineItems()->deleteAllLineItemsByOrderId($cart->id);
					}

					$success = ReOrder::$plugin->methods->copyLineItems($order, $allowPartial);
				}
				else
				{
					// Not all purchasables are still available and partial order recreations are disabled, so we
					// couldn't complete the reorder.
					$error = OrderStatus::Partial;
				}
			}
			else
			{
				// This user is trying to access someone else's order, which we can't allow.  Tell them the order
				// doesn't exist.
				$error = OrderStatus::DoesNotExist;
			}
		}
		else
		{
			// The order doesn't exist.
			$error = OrderStatus::DoesNotExist;
		}

		if ($error !== null)
		{
			$translatedError = Craft::t('reorder', $error);

			if ($isAjaxRequest)
			{
				return $this->asJson([
					'error' => $translatedError,
					'unavailable' => $unavailableLineItems,
				]);
			}

			Craft::$app->getUrlManager()->setRouteParams([
				'unavailable' => $unavailableLineItems,
			]);

			Craft::$app->getSession()->setError($translatedError);

			return null;
		}

		if ($isAjaxRequest)
		{
			return $this->asJson([
				'success' => true,
				'cart' => $cart,
				'unavailable' => $unavailableLineItems,
			]);
		}
		
		return $this->redirectToPostedUrl();
	}
}
