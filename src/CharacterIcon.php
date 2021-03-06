<?php
/**
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dasscheman\leaflet\charactericon;

// use dosamigos\leaflet\Plugin;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\types\Icon;
use yii\web\JsExpression;
use yii\helpers\Json;

/**
 *
 * @see https://github.com/dasscheman/yii2-leaflet-character-icon
 * @package dosamigos\leaflet\charactericon
 */
class CharacterIcon extends Icon
{
   /**
    * @var string number placed in icon.
    */
    public $number;

    /**
     * Generates the code to generate a maki marker. Helper method made for speed purposes.
     *
     * @param string $icon the icon name
     * @param array $options the maki marker icon
     *
     * @return string the resulting js code
     */
    // public function init()
    // {
    //     dd($this);
    // //    $options['icon'] = $icon;
    //     $options = Json::encode($options);
    //     return new JsExpression("L.Character.icon($options)");
    // }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        CharacterIconAsset::register($view);
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $options = Json::encode($this->getOptions(), LeafLet::JSON_OPTIONS);

        $js = "L.character.icon($options)";
        if ($this->name) {
            $js = "var $this->name = $js;";
        }
        return new JsExpression($js);
        // $icon = $this->icon;
        //
        // if (empty($icon)) {
        //     return "";
        // }
        // $this->clientOptions['icon'] = $icon;
        // $options = $this->getOptions();
        // $name = $this->getName();
        //
        // $js = "L.character.icon($options)";
        //
        // if (!empty($name)) {
        //     $js = "var $name = $js;";
        // }
        //
        // return new JsExpression($js);
    }

    /**
     * @return array the configuration options of the array
     */
    public function getOptions()
    {
        $options = [];
        $class = new \ReflectionClass(__CLASS__);
        foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            if (!$property->isStatic()) {
                $name = $property->getName();
                $options[$name] = $this->$name;
            }
        }
        foreach (['iconAnchor', 'iconSize', 'popupAnchor', 'shadowAnchor', 'shadowSize', 'number'] as $property) {
            $point = $this->$property;
            if ($point instanceof Point) {
                $options[$property] = $point->toArray(true);
            }
        }
        return array_filter($options);
    }
}
