<?php
namespace spicyweb\reorder\enums;

/**
 * Class LineItemStatus
 *
 * @package spicyweb\reorder\enums
 * @author Spicy Web <craft@spicyweb.com.au>
 * @since 1.0.0
 */
abstract class LineItemStatus
{
	public const Available = 'Available';
	public const Deleted = 'Deleted';
	public const Disabled = 'Disabled';
	public const BelowMinQty = 'BelowMinQty';
	public const AboveMaxQty = 'AboveMaxQty';
	public const InsufficientStock = 'InsufficientStock';
	public const OutOfStock = 'OutOfStock';
}
