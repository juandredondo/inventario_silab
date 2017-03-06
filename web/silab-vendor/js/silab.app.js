var silab = silab || {};

String.prototype.capitalize = function () {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
String.prototype.deentitize = function () {
    var ret = this.replace(/&gt;/g, '>');
    ret = ret.replace(/&lt;/g, '<');
    ret = ret.replace(/&quot;/g, '"');
    ret = ret.replace(/&apos;/g, "'");
    ret = ret.replace(/&amp;/g, '&');
    return ret;
},


silab.tags = [];
silab.colors = [
    "aqua",
    "red",
    "green",
    "orange",
    "yellow",
    "white",
    "teal",
    "maroon",
];

silab.itemsTypes = {
     consumible    : {
         text : "Consumible",
         value: 1,
         icon : "fa fa-hourglass-end"
     },
     noconsumible  : {
         text : "No Consumible",
         value: 2,
         icon : "fa fa-hourglass-end"
     },
     reactivo      : {
         text : "Reactivo",
         value: 3,
         icon : "fa fa-hourglass-end"
     },
     material      : {
         text : "Material",
         value: 4,
         icon : "fa fa-eyedropper"
     },
     equipo        : {
         text : "Equipo",
         value: 5,
         icon : "fa fa fa-laptop"
     },
     accesorio     : {
         text : "Accesorio",
         value: 6,
         icon : "fa fa-laptop"
     },
     herramienta   : {
         text : "Herramienta",
         value: 7,
         icon : "fa fa-gavel"
     }
}


silab.consts = {
    MAX_NOT_CONSUMIBLE : 1
}

silab.needs = function(needs, moduleName)
{
    let isValid = true;
    moduleName  = moduleName || "Silab";
    
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
        clickableAlertsDimissible();
        activeTab();
        bindLinkWithHash();
        getLaboratories();
        accordionToggle();
        collapsableField();
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

    function getLaboratories(size)
    {
        var domain  = $("body").data("domain");
        size        = size || 5;

        $.ajax({
            url     :   domain + "/laboratorio/get-all?page=" + size,
            type    :   "GET",
            success :   renderLaboratories
        });

        function renderLaboratories(data)
        {
            let targetMenu  = "#laboratories-menu";
                targetMenu  += " ul.treeview-menu";
            var ref         = $(targetMenu);
            
            var items       = "<li><a href='" + domain + "/laboratorio/manager/<%= LABO_ID %>'><i class='fa fa-circle-o text-<%= color %>'></i><%= LABO_NOMBRE %></a></li>";
            var template    = _.template(items);
            
            _.each(data, function(laboratory){
                let silabCount      = silab.colors.length;
                laboratory.color    = silab.colors[ _.random(0, silabCount - 1) ];
                ref.append( template( laboratory ) );
            });

            console.log(data);
        }
    }    

    function clickableAlertsDimissible()
    {
        $("body").on("click", ".alert.alert-dismissible", hideAnimated);

        function hideAnimated(e)
        {
            let me = $(this);

            me.fadeOut("slow");
        }
    }

    function ajaxConfiguration()
    {
        $( document ).ajaxStart(function() {
            $( "#loading" ).show();
        });
    }

    function accordionToggle()
    {
        if( silab.needs() ) {
            $('body').on('click', '[data-toggle=\'collapse\'][data-target]', accordionHandler);

            function accordionHandler(e)
            {
                let me       = $(this);
                let next     = $(me.data( 'next' ));
                let target   = $(me.data( 'target' ));
                let nextCopy    = me.data( 'next' );
                let targetCopy  = me.data( 'target' );

                next.collapse('show');
                target.collapse('hide');

                me.data( 'next', targetCopy );
                me.data( 'target', nextCopy );

            }
        }
    }

    function collapsableField() {
        if( silab.needs() ) {
            $("body").on( "click", '[data-collapsable-trigger]', collapseFieldHandler);

            function collapseFieldHandler(e){
                let me       = $(this);
                let myData   = me.data();

                let _default  = $(myData[ "defaultTarget" ] );
                let formField = $( myData[ "formField" ] ); 

                if( me.prop("checked") ) {
                    _default.val( _default.data( "defaultOff" ) );
                    formField.attr( "required", true );
                }
                else {
                    _default.val( _default.data( "defaultValue" ) );
                    formField.removeAttr( "required" );
                }
                
                $(myData[ "href" ]).collapse( me.prop("checked") ? "show" : "hide" );
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

silab.helpers = {
    getTemplate : function(params)
    {
        if(silab.needs())
        {
            if(!_.isUndefined(params))
            {
                let targets = { source: "#templates", target: "" };

                if (!_.isUndefined(params.source))
                    targets.source = params.source;

                if (!_.isUndefined(params.target))
                    targets.target = params.target;

                let isGrouped = !_.isUndefined(params.isGrouped) ? params.isGrouped : false;

                let html = $(targets.source).html();

                if (isGrouped) {
                    var template = $(targets.target, html);
                    html         = template.html().deentitize();
                }

                return html;
            }
        }
        
        return "";
    },
    pushNotification: function(params, callback)
    {
        if( silab.needs() ) {
            $.post("/notify/" + params.type, params.data, callback);
        }
    },
    appendOption: function(data)
    {
        if( silab.needs() ) {
            if( !_.isUndefined(data) ) {
                var option      = new Option(data.text, data.value);
                
                option.selected = !_.isUndefined(data.selected) ? data.selected : false;
                
                for(var key in data.data) {
                    option.setAttribute("data-" + key, data.data[ key ]);
                }
                
                data.select.append( option );
                data.select.trigger("change");
            }
            
        }
    },
    addAlert: function(target, data, autoHide)
    {
        if( silab.needs() )
        {
            var isSuccess   = data.status == 0;
            var autoHide    = !_.isUndefined( autoHide ) ? autoHide : false;

            var alertHtml   = silab.helpers.getTemplate({
                                    target: '#alert-dimissible',
                                    isGrouped: true
                                });
            
            var template = _.template( alertHtml );
            var message  = data.message;
            var result   = template({
                                type:  isSuccess ? 'success' : 'danger',
                                icon: {
                                    class: 'icon icon-bottom material-icons',
                                    text: (isSuccess ? 'check_circle': 'error')
                                },
                                title: isSuccess ? 'Enhorabuena' : 'Opps!',
                                content: message
                            });

            $(target).html( result );
            // - - - Auto hide the alert :v 
            if(autoHide) {
                $(target + ' .alert').fadeTo(2000, 500).delay(5000).slideUp(500);
            }
        }
    },
    grid: {
        getSelectedRows: function ( grid ) {
            if( silab.needs(["jQuery.fn.yiiGridView", "Storages.sessionStorage"]) ) {

                var $grid       = $(grid);
                var sStorage    = Storages.sessionStorage;
                var data        = $grid.yiiGridView('data');
                var keys        = [];

                if (data.selectionColumn) {
                    $grid.find("input[name='" + data.selectionColumn + "']:checked").each(function () {
                        let record = $(this).parent().closest('tr');
                        let data   = record.data();

                        let item   = {
                            id : data.key,
                            info : data.item
                        };
                        keys.push( item );
                        console.log( item )
                    });
                }

                if( sStorage.isSet("stocks.selected") ) {
                    keys = _.uniq(_.union(keys, sStorage.get("stocks.selected")), false, _.property( 'id' ) );
                }

                if( keys.length ) {
                    sStorage.set("stocks.selected", keys );
                }
                return keys;
            }

            return [];
        },
        selectRows: function( grid, keys ) {
            if( silab.needs(["jQuery.fn.yiiGridView", "Storages.sessionStorage"]) ) {

                var $grid       = $(grid);
                var sStorage    = Storages.sessionStorage;
                var data        = $grid.yiiGridView('data');

                if(sStorage.isSet("stocks.selected")) {
                    keys = sStorage.get("stocks.selected");
                }

                if ( data.selectionColumn ) {
                    _.each(keys, function(i){
                        let check = $grid.find( "[data-key='" + i.id + "']" ).find("input[name='" + data.selectionColumn + "']");
                            check.prop("checked", true);
                    });
                }

                return keys;
            }
        }
    }
};

silab.ajax = function(options)
{
    var trigger = options.trigger;
    
    function beforeAjax()
    {
        silab.overlay.toggle( "process", "Procesando..." );
    }

    function completeAjax()
    {
        silab.overlay.toggle( "process", "Procesando..." );
    }

    options.beforeSend = options.beforeSend || beforeAjax;
    options.complete   = options.complete   || completeAjax;

    $.ajax(options);

}

silab.ajaxStart = function(handler)
{
    handler();
}

silab.submitForm = function(form, data, config)
{
    var me          = getForm(form);
    var dataToSend  = data;
    var config      = config || {
        "alert-spot" : ".alert-spot"
    };

    function getForm(form)
    {
        if(Object.prototype.toString.call( form ) === '[object String]')
            return $(form);

        return form;
    }

    me.on('beforeSubmit', { "form": me, "dataToSend": dataToSend } ,function(e){
        // - - - - Stop propagation
            e.preventDefault();
            e.stopPropagation();
        // - - - - It's Maui Time!
        let form = $(this);
        
        silab.ajax(
            {
                url: form.attr('action'),
                data:  e.data.dataToSend || form.serialize(), 
                success: success,
                type: "POST",
                trigger: form.find("button[type='submit']")
            }
        );

        function success(data)
        {
            var insideModal = $('form[id*=\'item\']').animate({ scrollTop: 0 }, 'slow'); 
            
            displayAlert(data);

            // - - - Executar la accion de refrescado o redireccion - - -
            if( !_.isUndefined( data.action ) ) {
                setTimeout(function() {
                    window.location[ data.action.type ]( data.action.value );                            
                }, 2000);
            }

            reset(e.data.form);
        }

        function displayAlert(data)
        {
            let parent      = $('form[id*=\'item\']').closest('.modal');
                parent      = parent.length ? parent : $('html, body');

            data.message    = _.template( data.message )( { } );

            parent.animate({ scrollTop: 0 }, 'slow');
            
            silab.helpers.addAlert( config[ "alert-spot" ], data, true);
                
            if( typeof window.itemFormCallback !== 'undefined' )
            {
                window.itemFormCallback( data );
            }                

        }

        return false;
    });
    // reseter trigger
    me.find("[data-form-reseter]").on('click', { "form" : me }, function(e){        
        let form    = e.data.form;
        // reset the form
        reset(form);
    });

    function reset(form)
    {
        form[ 0 ].reset();
        form.find('select').val('').trigger('change');
    }
}

silab.overlay = {
    toggle: function (mode, message)
    {
        if(silab.needs()) {

            let overlay     = $("#overlay-block");
            let target      = null;
            let messageSpot = overlay.find("p");
            
            // Check the spinner mode
            switch( mode ) {
                case 'load':
                    target = overlay.find("[data-load]");                                 
                break;

                case 'process':
                    target = overlay.find("[data-process]");    
                break;
            }

            // Si hay un spinner entonces muestrelo u ocultelo
            if(target != null)
            {
                target .toggleClass("hide")
            }
            
            overlay.toggleClass("hide");
            messageSpot.text( message || "" );
        }
        
    }
}