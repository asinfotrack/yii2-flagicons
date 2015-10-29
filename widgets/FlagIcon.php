<?php
namespace asinfotrack\yii2\flagicons\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use asinfotrack\yii2\flagicons\Flag;
use asinfotrack\yii2\flagicons\assets\FlagIconAsset;

/**
 * Widget for displaying flag icons. Use this if you want full control or if you
 * do not want to use the static helper-class.
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
	 * @param string $cssSize any css-size like '32px', '2em', etc.
	 */
	public $sizeCss = Flag::SIZE_DEFAULT;

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

		//set size if defined
		if (strcmp($this->sizeCss, Flag::SIZE_DEFAULT) !== 0) {
			$this->addSizeToOptions();
		}
	}

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		echo Html::tag($this->tagName, '', $this->options);
	}

	/**
	 * Generates the size css and adds it to the options
	 */
	protected function addSizeToOptions()
	{
		$val = floatval($this->sizeCss);

		$charPos = 0;
		while (is_numeric($this->sizeCss[$charPos])) $charPos++;

		$unit = $charPos > 0 ? substr($this->sizeCss, $charPos) : '';
		Html::addCssStyle($this->options, [
			'width'=>$this->isSquared ? $val . $unit : (1.33333 * $val) . $unit,
			'line-height'=>$val . $unit,
		]);
	}

}
