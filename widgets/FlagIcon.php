<?php
namespace asinfotrack\yii2\flagicons\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use asinfotrack\yii2\flagicons\assets\FlagIconAsset;

/**
 * Widget for displaying flag icons
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class FlagIcon extends \yii\base\Widget
{

	/**
	 * @var string the mandatory country code consisting of two characters
	 */
	public $countryCode;

	/**
	 * @var array options for the enclosing tag
	 */
	public $options = [];

	/**
	 * @var string the tag-name to use (defaults to span)
	 */
	public $tagName = 'span';

	/**
	 * @var bool whether or not the flag should be square (defaults to false)
	 */
	public $isSquared = false;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		//register asset
		FlagIconAsset::register($this->getView());

		//assert country code is set and valid
		if ($this->countryCode === null) {
			$msg = Yii::t('app', 'The country code is required');
			throw new InvalidConfigException($msg);
		} else {
			if (!is_string($this->countryCode) || strlen($this->countryCode) !== 2) {
				$msg = Yii::t('app', 'The country code needs to be a string with a length of 2 characters');
				throw new InvalidConfigException($msg);
			}
			$this->countryCode = strtolower($this->countryCode);
		}

		//add default classes
		Html::addCssClass($this->options, 'flag-icon');
		if ($this->isSquared) {
			Html::addCssClass($this->options, 'flag-icon-squared');
		}

		//add actual flag class
		Html::addCssClass($this->options, 'flag-icon-' . $this->countryCode);
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		echo Html::tag($this->tagName, '', $this->options);
	}

}
