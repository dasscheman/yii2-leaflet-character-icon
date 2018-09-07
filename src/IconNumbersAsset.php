<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dasscheman\leaflet\;

use yii\web\AssetBundle;

/**
 * AwesomeMarkerAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\leaflet\plugins\awesome
 */
class IconNumberAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dasscheman/yii2-leaflet-icon-number/src/assets';

    public $css = ['css/leaflet.icon-numbers.css'];

    public $depends = [
        'dosamigos\leaflet\LeafLetAsset',
    ];

    public function init()
    {
        $this->js[] = 'js/leaflet.icon-numbers.js';
    }
}
