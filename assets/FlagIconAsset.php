<?php
namespace asinfotrack\yii2\flagicons\assets;

/**
 * Asset bundle needed for flag icons
 *
 * @author Pascal Mueller, AS infotrack AG
 * @link http://www.asinfotrack.ch
 * @license MIT
 */
class FlagIconAsset extends \yii\web\AssetBundle
{

	public $sourcePath = '@vendor/components/flag-icon-css';

	public $css =  [
		'css/flag-icon.min.css',
	];

}
