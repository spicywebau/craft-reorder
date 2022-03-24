<?php

namespace spicyweb\reorder;

use Craft;
use craft\commerce\elements\Order;
use craft\commerce\Plugin as Commerce;
use spicyweb\reorder\Plugin as ReOrder;

/**
 * Class Variable
 *
 * @package spicyweb\reorder
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
class Variable
{
    /**
     * Checks an order's line items and returns the unavailable items along with why they're unavailable.
     *
     * @param Order $order The order to check.
     * @param Order|int|null $cart A cart, or cart ID, to check for the quantity of items already in the user's cart.
     * return array The line items that are unavailable and why.
     */
    public function unavailableLineItems(Order $order, Order|int|null $cart = null): array
    {
        if (is_int($cart)) {
            $cart = Commerce::getInstance()->getOrders()->getOrderById($cart);
        }

        // Make sure the order and cart belong to the current user, otherwise tell them nothing
        $currentUser = Craft::$app->getUser();
        $orderUser = $order->getCustomer();
        $cartUser = $cart !== null ? $cart->getCustomer() : null;

        if ((int)$currentUser->id !== (int)$orderUser->id || $cart !== null && (int)$currentUser->id !== (int)$cartUser->id) {
            return [];
        }

        return ReOrder::$plugin->methods->getUnavailableLineItems($order, $cart);
    }
}
