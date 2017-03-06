var silab = silab || {}

silab.helpers = silab.helpers || { };

silab.helpers.createCSSSelector = function(selector, style) {

    if (!document.styleSheets) return;
    if (document.getElementsByTagName('head').length == 0) return;

    var styleSheet,mediaType;
        
    if (document.styleSheets.length > 0) {
        for (var i = 0, l = document.styleSheets.length; i < l; i++) {
        if (document.styleSheets[i].disabled) 
            continue;
        var media = document.styleSheets[i].media;
        mediaType = typeof media;

        if (mediaType === 'string') {
            if (media === '' || (media.indexOf('screen') !== -1)) {
            styleSheet = document.styleSheets[i];
            }
        }
        else if (mediaType=='object') {
            if (media.mediaText === '' || (media.mediaText.indexOf('screen') !== -1)) {
            styleSheet = document.styleSheets[i];
            }
        }

        if (typeof styleSheet !== 'undefined') 
            break;
        }
    }

    if (typeof styleSheet === 'undefined') {
        var styleSheetElement = document.createElement('style');
        styleSheetElement.type = 'text/css';
        document.getElementsByTagName('head')[0].appendChild(styleSheetElement);

        for (i = 0; i < document.styleSheets.length; i++) {
        if (document.styleSheets[i].disabled) {
            continue;
        }
        styleSheet = document.styleSheets[i];
        }

        mediaType = typeof styleSheet.media;
    }
        
    
    if (mediaType === 'string') {
        for (var i = 0, l = styleSheet.rules.length; i < l; i++) {
        if(styleSheet.rules[i].selectorText && styleSheet.rules[i].selectorText.toLowerCase()==selector.toLowerCase()) {
            styleSheet.rules[i].style.cssText = style;
            return;
        }
        }
        styleSheet.addRule(selector,style);
    }
    else if (mediaType === 'object') {
        var styleSheetLength = (styleSheet.cssRules) ? styleSheet.cssRules.length : 0;
        for (var i = 0; i < styleSheetLength; i++) {
        if (styleSheet.cssRules[i].selectorText && styleSheet.cssRules[i].selectorText.toLowerCase() == selector.toLowerCase()) {
            styleSheet.cssRules[i].style.cssText = style;
            return;
        }
        }
        styleSheet.insertRule(selector + '{' + style + '}', styleSheetLength);
    }
}

silab.helpers.getColorForPercentage = function(pct) {
    /**
     * @author Mister @Jacob
     * @link http://stackoverflow.com/a/7128796/3786841
     */ 
    var percentColors = [
        { pct: 0.0, color: { r: 0xff, g: 0x00, b: 0 } },
        { pct: 0.5, color: { r: 0xff, g: 0xff, b: 0 } },
        { pct: 1.0, color: { r: 0x00, g: 0xff, b: 0 } } ];

        for (var i = 1; i < percentColors.length - 1; i++) {
            if (pct < percentColors[i].pct) {
                break;
            }
        }
        var lower = percentColors[i - 1];
        var upper = percentColors[i];
        var range = upper.pct - lower.pct;
        var rangePct = (pct - lower.pct) / range;
        var pctLower = 1 - rangePct;
        var pctUpper = rangePct;
        var color = {
            r: Math.floor(lower.color.r * pctLower + upper.color.r * pctUpper),
            g: Math.floor(lower.color.g * pctLower + upper.color.g * pctUpper),
            b: Math.floor(lower.color.b * pctLower + upper.color.b * pctUpper)
        };

        return 'rgb(' + [color.r, color.g, color.b].join(',') + ')';
        // or output as hex if preferred
}

silab.helpers.registerPercentagesColors = function()
{
    
    for(var i = 0, l = 100; i <= l; i++)
    {
        var selector =  + (( ( 100 - i ) / l) * 100).toFixed(0);
        var color    = silab.helpers.getColorForPercentage( i / l );
        silab.helpers.createCSSSelector( ".bg-hot-" + selector, "background-color:" + color + " !important" );
        silab.helpers.createCSSSelector( ".text-hot-" + selector, "color:" + color + " !important" );
    }
}

silab.helpers.registerPercentagesColors();