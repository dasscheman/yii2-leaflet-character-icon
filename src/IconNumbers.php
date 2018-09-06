<?php
namespace dasscheman\leaflet\IconNumbers;

use yii\web\JsExpression;
use yii\helpers\Json;
use dosamigos\leaflet\LeafLet;

class IconNumbers extends Icon
{

   /**
    * @var string number placed in icon.
    */
    public $number;

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
        IconNumberAsset::register($view);
        return $this;
    }


    /**
     * @return string the js initialization code of the object
     */
    public function encode()
    {
        $options = Json::encode($this->getOptions(), LeafLet::JSON_OPTIONS);

        $js = "L.iconNumbers($options)";
        if ($this->name) {
            $js = "var $this->name = $js;";
        }
        return new JsExpression($js);
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
