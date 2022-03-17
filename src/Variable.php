<?php

namespace spicyweb\reorder;

use craft\commerce\elements\Order;

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
     * @param int $cartId A cart ID, to check for the quantity of items already in the user's cart.
     * return array The line items that are unavailable and why.
     */
    public function unavailableLineItems(Order $order, int $cartId = null): array
    {
        return ReOrder::$plugin->methods->getUnavailableLineItems($order, $cartId);
    }
}
