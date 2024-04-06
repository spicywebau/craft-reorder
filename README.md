<img src="docs/icon.png" width="100">

# ReOrder

#### Easy reordering of previous Craft Commerce user orders.

ReOrder makes it easy to allow users to quickly replicate an old order's line items in their existing cart, including the items' quantities, product options and notes.

## Requirements

- ReOrder 3.x requires Craft CMS 5 and Craft Commerce 5.

## Installation

ReOrder can be installed through the Craft [Plugin Store](https://plugins.craftcms.com/).  It can also be set up using Composer:

```
composer require spicyweb/craft-reorder
```

Then browse to **Settings &rarr; Plugins** in the Craft control panel and choose to install ReOrder.

## Usage

ReOrder can be configured to either keep or discard the existing cart items when reordering an old order, and to allow or disallow reordering an order if not all of the associated purchasables are still available, whether they have been deleted, disabled or are just out of stock -- in which case, if reordering is allowed, ReOrder will just replicate the available items.

These options can be configured globally in the Craft control panel and can be overridden on a case-by-case basis in your template files.

ReOrder also makes it easy to allow a customer to select the items they want to reorder, if they don't want to reorder an entire order.

#### Example: retain cart but disallow partial reorders

```twig
<form method="POST">
    <input type="hidden" name="action" value="reorder/reorder">
    {{ csrfInput() }}
    {{ redirectInput('shop/checkout') }}
    <input type="hidden" name="order" value="{{ order.number }}">
    <input type="hidden" name="retainCart" value="1">
    <input type="hidden" name="allowPartial" value="0">
    <button type="submit">ReOrder!</button>
</form>
```

#### Example: allow customer to select which items to reorder
```twig
<form method="POST">
    <input type="hidden" name="action" value="reorder/reorder">
    {{ csrfInput() }}
    {{ redirectInput('shop/checkout') }}
    <input type="hidden" name="order" value="{{ order.number }}">

    {% for item in order.lineItems %}
        <input type="checkbox" name="reOrderItems[]" value="{{ item.id }}">
        {# other item info #}
    {% endfor %}

    <button type="submit">ReOrder!</button>
</form>
```
