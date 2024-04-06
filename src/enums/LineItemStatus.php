<?php

namespace spicyweb\reorder\enums;

/**
 * Line item status enum
 *
 * @package spicyweb\reorder\enums
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 3.0.0
 */
enum LineItemStatus
{
    case Available;
    case Deleted;
    case Disabled;
    case BelowMinQty;
    case AboveMaxQty;
    case InsufficientStock;
    case OutOfStock;
}
