<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dasscheman\leaflet\charactericon;

use yii\web\AssetBundle;

/**
 * AwesomeMarkerAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\leaflet\plugins\awesome
 */
class CharacterIconAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dasscheman/yii2-leaflet-character-icon/src/assets';

    public $css = ['css/leaflet.character-icon.css'];

    public $depends = [
        'dosamigos\leaflet\LeafLetAsset',
    ];

    public function init()
    {
        $this->js[] = 'js/leaflet.character-icon.js';
    }
}
