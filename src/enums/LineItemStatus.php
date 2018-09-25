<?php
namespace spicyweb\reorder\enums;

/**
 * Class LineItemStatus
 *
 * @package spicyweb\reorder
 * @author Spicy Web <craft@spicyweb.com.au>
 * @since 1.0.0
 */
abstract class LineItemStatus
{
	const Available = 'Available';
	const Deleted = 'Deleted';
	const Disabled = 'Disabled';
	const BelowMinQty = 'BelowMinQty';
	const AboveMaxQty = 'AboveMaxQty';
	const InsufficientStock = 'InsufficientStock';
	const OutOfStock = 'OutOfStock';
}
