<?php

namespace spicyweb\reorder\enums;

/**
 * Order status enum
 *
 * @package spicyweb\reorder\enums
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 3.0.0
 */
enum OrderStatus: string
{
    case DoesNotExist = 'The order does not exist';
    case Partial = 'Some items are not available';
    case NoItemsAvailable = 'No items available';
}
