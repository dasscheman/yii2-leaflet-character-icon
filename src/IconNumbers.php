<?php
namespace dasscheman\leaflet\icon;

use yii\web\JsExpression;
use yii\helpers\Json;

class IconNumbers extends Icon
{
    /**
     * @var string the icon name
     * @see https://github.com/lvoogdt/Leaflet.awesome-markers#properties
     */
    public $icon;

    /**
     * Generates the code to generate a maki marker. Helper method made for speed purposes.
     *
     * @param string $icon the icon name
     * @param array $options the maki marker icon
     *
     * @return string the resulting js code
     */
    public function make($icon, $options = [])
    {
        $options['icon'] = $icon;
        $options = Json::encode($options);
        return new JsExpression("L.AwesomeMarkers.icon($options)");
    }

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:awesomemarker';
    }

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
        AwesomeMarkerAsset::register($view);
        return $this;
    }

    /**
     * Returns the javascript ready code for the object to render
     * @return \yii\web\JsExpression
     */
    public function encode()
    {
        $icon = $this->icon;

        if (empty($icon)) {
            return "";
        }
        $this->clientOptions['icon'] = $icon;
        $options = $this->getOptions();
        $name = $this->getName();

        $js = "L.AwesomeMarkers.icon($options)";

        if (!empty($name)) {
            $js = "var $name = $js;";
        }

        return new JsExpression($js);
    }

}
