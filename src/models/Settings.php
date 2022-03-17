<?php
namespace spicyweb\reorder\models;

use craft\base\Model;

/**
 * Class Settings
 *
 * @package spicyweb\reorder\models
 * @author Spicy Web <craft@spicyweb.com.au>
 * @since 1.0.0
 */
class Settings extends Model
{
	/**
	 * @var bool
	 */
	public $retainCart = true;

	/**
	 * @var bool
	 */
	public $allowPartial = false;

	/**
	 * @inheritdoc
	 */
	public function rules(): array
	{
		return [
			[['retainCart', 'allowPartial'], 'boolean'],
		];
	}
}
