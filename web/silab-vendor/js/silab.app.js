var silab = silab || {};

silab.tags = [];

silab.needs = function(needs, moduleName)
{
    let isValid = true;
    moduleName  = moduleName || "El modulo";
    
    // Module needs
    if(__needs())
    {
        var needs = needs || [ ];    
        for(var need in needs)
        {
            if( !silab.checkProperty( needs [ need ], window ) )
            {
                throw  moduleName + ".js, necesita de '" + needs [ need ] + "'"; 
            }
        }
    }

    // core needs dependencies
    function __needs()
    {
        let needs   = [ "jQuery", { key: "underscore", value : "_" } ];
        let isValid = true;

        for(var need in needs)
        {
            var isObject = Object.prototype.toString.call( needs [ need ] ) === '[object Object]';

            if( !silab.checkProperty( ((isObject) ? needs [ need ][ "value" ] : needs [ need ]), window ) )
            {
                throw "silab.js, necesita basicamente de '" + ((isObject) ? needs [ need ][ "key" ] : needs [ need ] ) + "'"; 
            }
            
        }
        
        return isValid;
    }

    // splits by dot
    
    return isValid;
}

silab.basics = function() {

    if(typeof $ !== "undefined") {
        $(document).on('ready', silab_init);
    }

    function silab_init() {
        
        console.log( "app!" );
        activeTab();
        bindLinkWithHash();
    }

    function bindLinkWithHash()
    {
        $("a[href*='#']").on('click', function (){
            // 1. Obtenenmos el "href" del link
            let href = $(this).attr("href");
            // 2. Obtenemos su hash 
            let hash = href.substr(href.indexOf("#"));

            if(hash.length > 1)
                activeTab(hash);
        });
    }

    function activeTab(hash) {

        var hash = hash || window.location.hash;
        console.log("hash:", hash);
        if(typeof hash !== "undefined")
        {
            let anchor = $('a[role="tab"][href="' + hash + '"]');
            if(typeof anchor !== "undefined") 
            {
                anchor.tab('show');
                anchor.parents("li").addClass("active");
            }

        }
    }

}

silab.registerTabIds = function(tabs) {   
    
    if( Object.prototype.toString.call( tabs ) === '[object Array]' ) {
        
    }
} 

silab.basics();

/**
 * @author Jeancarlo Fontalvo
 * @param property la propiedad a checkear si se encuentra en el objecto
 * @param object Objecto target
 * @return boleano falso si no se encuentra la propiedad o verdadero si se encuentra
 */
silab.checkProperty = function(property, object)
{
    if(property !== null || typeof property !== "undefined")
    {
        var dotted = property.split(".");
        if(dotted.length > 0)
        {
            var current = null;
            for(var i = 0; i < dotted.length; i++)
            {
                if(current == null)
                    current = object[ dotted[ i ] ];
                else
                    current = current[ dotted[ i ] ];

                if(typeof current === "undefined")
                    return false;
            }

            return true;
        }
        
    }

    return false;
}



