<?php
namespace spicyweb\reorder\enums;

/**
 * Class OrderStatus
 *
 * @package spicyweb\reorder\enums
 * @author Spicy Web <craft@spicyweb.com.au>
 * @since 1.0.0
 */
abstract class OrderStatus
{
	const DoesNotExist = 'The order does not exist';
	const Partial = 'Some items are not available';
	const NoItemsAvailable = 'No items available';
}
