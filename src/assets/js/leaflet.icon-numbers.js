/*global L*/

(function (window, document, undefined) {
    "use strict";

    L.IconNumber = {};

    L.IconNumber.version = '1.0.0';

    L.IconNumbers.Icon = L.Icon.extend({
        options: {
            number: '',
            numberSize: [35, 45],
            numberAnchor: [0, 24],
            numberFont: 'Sans-serif',
            numberFontSize: '15px',
            numberColor: 'purple',
        },

        initialize: function (options) {
            options = L.Util.setOptions(this, options);
        },


        createIcon: function () {

            var div = document.createElement('div'),
                options = this.options;

            if (options.icon) {
                div.innerHTML = this._createInner();

                if(options.iconFontSize) {
                    div.style.fontSize = options.iconFontSize;
                }
            }

            if (options.number) {
                div.appendChild(this._createInnerNumber());
            }

            if (options.bgPos) {
                div.style.backgroundPosition =
                    (-options.bgPos.x) + 'px ' + (-options.bgPos.y) + 'px';
            }

            this._setIconStyles(div, 'icon-' + options.markerColor);
            return div;
        },

        _createInnerNumber: function() {
            var numberColorClass = "", numberStyle = "", options = this.options;

            var div = document.createElement('div');
            div.classList.add("leaflet-number");
            var textnode = document.createTextNode(options.number);
            div.appendChild(textnode);

            if(options.numberColor || options.numberFont) {
                if(options.numberColor) {
                    div.style.color = options.numberColor;
                }
                if(options.numberFont) {
                    div.style.fontFamily = options.numberFont;
                }
                if(options.numberFontSize) {
                    div.style.fontSize = options.numberFontSize;
                }
            }

            this._setIconStyles(div, 'number');
            return div;
        },

        _createInner: function() {
            var iconClass, iconSpinClass = "", iconColorClass = "", iconColorStyle = "", options = this.options;

            if(options.icon.slice(0,options.prefix.length+1) === options.prefix + "-") {
                iconClass = options.icon;
            } else {
                iconClass = options.prefix + "-" + options.icon;
            }

            if(options.spin && typeof options.spinClass === "string") {
                iconSpinClass = options.spinClass;
            }

            if(options.iconColor) {
                if(options.iconColor === 'white' || options.iconColor === 'black') {
                    iconColorClass = "icon-" + options.iconColor;
                } else {
                    iconColorStyle = "style='color: " + options.iconColor + "' ";
                }
            }

            return "<i " + iconColorStyle + "class='" + options.extraClasses + " " + options.prefix + " " + iconClass + " " + iconSpinClass + " " + iconColorClass + "'></i>";
        },

        _setIconStyles: function (img, name) {
            var options = this.options;
            var size, anchor;

            switch(name) {
                case 'number':
                    size = L.point(options['numberSize']);
                    break;
                case 'shadow':
                    size = L.point(options['shadowSize']);
                    break;
                default:
                    size = L.point(options['iconSize']);
            }

            if (name === 'number') {
                anchor = L.point(options.numberAnchor || options.iconAnchor);
            }
            else if (name === 'shadow') {
                anchor = L.point(options.shadowAnchor || options.iconAnchor);
            } else {
                anchor = L.point(options.iconAnchor);
            }

            if (!anchor && size) {
                anchor = size.divideBy(2, true);
            }

            img.className = 'awesome-marker-' + name + ' ' +(name !== 'number'?options.className:'');

            if (anchor) {
                img.style.marginLeft = (-anchor.x) + 'px';
                img.style.marginTop  = (-anchor.y) + 'px';
            }

            if (size) {
                img.style.width  = size.x + 'px';
                img.style.height = size.y + 'px';
            }
        },

        createShadow: function () {
            var div = document.createElement('div');

            this._setIconStyles(div, 'shadow');
            return div;
      }
    });

    L.AwesomeMarkers.icon = function (options) {
        return new L.AwesomeMarkers.Icon(options);
    };

}(this, document));
