<?php
/**
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dasscheman\leaflet\charactericon;

use yii\web\AssetBundle;

/**
 * CharacterIconAsset
 *
 * @see https://github.com/dasscheman/yii2-leaflet-character-icon
 * @package dosamigos\leaflet\charactericon
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
