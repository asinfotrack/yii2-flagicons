<?php
namespace asinfotrack\yii2\flagicons;

use asinfotrack\yii2\flagicons\implementations\FlagWrapper;

/**
 * Static helper class to generate class without writing too much code.
 * This will work with an intermediate wrapper class which in term will return the
 * widget code via its toString-method.
 *
 * Usage is very easy. If you want a simple flag icon just write:
 * <code>Flag::icon('ch')</code>
 *
 * Another example for an advanced config:
 * <code>Flag::icon('cd', ['id'=>'my-flag'])->squared()->tagName('span')</code>
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class Flag
{

	/**
	 * Generates the wrapper instance which in term will render the flag widget
	 *
	 * @param string $countryCode the country code consisting of two characters (eg us, de, ch)
	 * @param array $options the html options for the tag
	 * @return \asinfotrack\yii2\flagicons\implementations\FlagWrapper
	 */
	public static function icon($countryCode, $options=[])
	{
		return new FlagWrapper([
			'countryCode'=>$countryCode,
			'options'=>$options,
		]);
	}

}
