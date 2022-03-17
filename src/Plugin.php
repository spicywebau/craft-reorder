<?php
namespace spicyweb\reorder;

use yii\base\Event;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use craft\web\twig\variables\CraftVariable;

use spicyweb\reorder\models\Settings;

/**
 * Class Plugin
 *
 * @package spicyweb\reorder
 * @author Spicy Web <plugins@spicyweb.com.au>
 * @since 1.0.0
 */
class Plugin extends BasePlugin
{
	/**
	 * @var Plugin|null
	 */
	public static ?Plugin $plugin;

	/**
	 * @inheritdoc
	 */
	public bool $hasCpSettings = true;

	/**
	 * @inheritdoc
	 */
	public function init(): void
	{
		parent::init();

		self::$plugin = $this;

		$this->setComponents([
			'methods' => Service::class,
		]);

		Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event)
		{
			$event->sender->set('reorder', Variable::class);
		});
	}

	/**
	 * @inheritdoc
	 */
	protected function createSettingsModel(): ?Model
	{
		return new Settings();
	}

	/**
	 * @inheritdoc
	 */
	protected function settingsHtml(): ?string
	{
		return Craft::$app->getView()->renderTemplate('reorder/settings', [
			'settings' => $this->getSettings(),
		]);
	}
}
