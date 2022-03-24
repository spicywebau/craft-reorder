# Changelog

## Unreleased

### Fixed
- Fixed an error that occurred when using `craft.reorder.unavailableLineItems()`

## 2.0.0-beta.1 - 2022-03-17

### Added
- Added Craft 4 compatibility (requires Craft 4.0.0-beta.2 or later)
- Added Craft Commerce 4 compatibility (requires Craft Commerce 4.0.0-beta.1 or later)

### Changed
- Service methods that would previously take a cart/order ID as an argument now take a cart/order element instead

## 1.1.5 - 2020-12-14

### Fixed
- Fixed an issue where reorders could fail at the point of comparing the current user's ID with the order customer's user ID, if one of them was set as a string instead of an integer

## 1.1.4 - 2020-02-07

### Changed
- update requirement for commerce 3

## 1.1.3 - 2019-07-30

### Added
- Add ability to only reorder certain items - thanks @ttempleton
- New Icon
- Add issue template

## 1.1.2 - 2018-12-06
### Added
- Now sets `reorder.unavailable` session variable, for accessing unavailable line items in templates, when redirecting after form submit (thanks @engram-design)

## 1.1.2 - 2018-12-06
### Added
- Now sets `reorder.unavailable` session variable, for accessing unavailable line items in templates, when redirecting after form submit (thanks @engram-design)

## 1.1.1 - 2018-11-04
### Fixed
- Updated usage of Craft Commerce `resolveLineItem()` method for changes made in Commerce 2.0.0-beta.13 regarding setting item quantities and notes

## 1.1.0 - 2018-10-28
### Added
- Added `hasAvailableLineItems()` service method to check whether an order has any available line items
- Added new order status `OrderStatus::NoItemsAvailable`

### Fixed
- No longer tries to delete line items on a new cart when set not to retain cart
- Now ensures that, if the cart is new, items have been added to it before saving it

## 1.0.2 - 2018-10-25
### Fixed
- Ensure cart has been saved (and therefore has an ID) before attempting to resolve cart line items; fixes error in newer Craft Commerce 2 beta releases

## 1.0.1 - 2018-10-20
### Fixed
- Fixed error when a line item's note is null (thanks @engram-design)
- Ensure lineItemStatus takes into account Live status (thanks @engram-design)

## 1.0.0 - 2018-09-25
- Initial release
