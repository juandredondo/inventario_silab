var silab = silab || {};


silab.laboratory  = {
    moduleName : "silab.laboratory"
}

silab.laboratory.templates = {
    inventory: {
        card: silab.helpers.getTemplate({
                source: "#silab-template-card",
              }),
        list: silab.helpers.getTemplate({
                source: "#silab-template-list",
              }),
    }
}

var sLaboratoryTemplates = silab.laboratory.templates;

silab.laboratory.activeInventoryDataTable = function(target)
{
    let sLaboratory = silab.laboratory;
    
    if(silab.needs(['jQuery.fn.DataTable'], sLaboratory.moduleName)) 
    {
        $(target).DataTable();
        expanderHandler(target);
        appendDivs(target);

        function appendDivs(target)
        {
            $(target + ' tr[data-row]').each(function(index, key){
                let row     = $(this);

                row.after("<tr data-brother='" + row.data("row") + "' class='inventory-row'>\
                                <td colspan='" + row.children().length + "'> \
                                    <div class='row'>" + lorem + "</div>\
                                </td>\
                           </tr>"
                    );
            });
        }

        function expanderHandler(target)
        {
            if(silab.needs())
            {
                $(target + ' button[data-role="row-expander"]').on('click', function(){
                    let me              = $(this); 
                    let parentId        = $(this).data("parent");
                    let expandSection   = $(target + " tr[data-brother='" + parentId + "']");
                    let isOpen          = expandSection.hasClass("open");
                    // 1. expand or collapse
                    expandSection.removeClass( isOpen ?  "open" : "")
                                 .addClass(!isOpen ?  "open" : "");
                    
                    // 2. change the button icon
                    me.children("i").removeClass(isOpen ?  "fa-minus" : "fa-plus")
                                    .addClass(!isOpen ?  "fa-minus" : "fa-plus");
                    console.log("parent", parentId);
                })
            }
        }
    }  
    
}

silab.laboratory.init = function()
{
    var sLaboratory = silab.laboratory;

    if(silab.needs()) {
        sLaboratory.renderInventories();
        inventoryLinkOverlay();
    }

    function inventoryLinkOverlay()
    {
        $("body").on('click', '#inventory-spot .layout-base a[data-overlay-loader]', function(e){
            e.preventDefault();
            let me           = $(this);
            let baseLayer    = me.closest("[class*='layout']");
            let overlayLayer = baseLayer.next();
            let overContent  = overlayLayer.find( "[data-content]" );

            baseLayer.addClass("hide");  
            overlayLayer.removeClass("hide");  

            silab.overlay.toggle("load");

            overContent.load( me.attr('href'), function(data) {
                silab.overlay.toggle("load");
            });

            
        });

        $("body").on('click', '#inventory-spot a[data-overlay-back]', function(e){
            e.preventDefault();
            let me           = $(this);
            let overlayLayer = me.closest("[class*='layout']");
            let baseLayer = overlayLayer.prev();

            overlayLayer.find( "[data-content]" ).html("");
            
            baseLayer.removeClass("hide");   
            overlayLayer.addClass("hide");        
        });
    }
}

silab.laboratory.renderInventories = function(params) {
    if(silab.needs()) {
        var params = params || {
            mode: "card",
            data: window.inventories,
            target: "#inventory-spot .layout-base",
            loader: true
        };

        if(params.loader) {
            silab.overlay.toggle("process", "Cargando inventarios");
        }

        let template  = sLaboratoryTemplates.inventory[ params.mode ];
        let count     = params.data.length;
        let sizeCount = ( (count % 2 == 0) && !(count % 3 == 0) ) ? 6 : 4;
            sizeCount = ( sizeCount == 4 ) ? 3 : 2;

        let html = "";
        let row  = "<div class='row'>{inventories}</div>";
        let inve = "";
        
        for(var i = 0, lap = 0; i < count; i++) {
            var inv = params.data[ i ];
            inve += _.template( template )( {
                model: {
                    id: inv.INVE_ID,
                    name: inv.INVE_NOMBRE,
                    description: inv.INVE_DESCRIPCION,
                    isCaducated: "<span class='label label-success'>VIGENTE</span>",
                    itemsCount: 15,
                    entriesCount: 15,
                    outsCount: 0
                },
                data: {
                    link: [
                        "overlay-loader"
                    ]
                }
            } );

            if( i % (sizeCount - 1) == 0 && i > 0 ) {
                html +=  row.replace( "{inventories}", inve );
                sizeCount *= 2;
                lap++;
                inve = "";
            }
            else if( lap > 0 && i == count - 1 ) {
                html +=  row.replace( "{inventories}", inve );
                lap++;
                inve = "";
            }
        }

        $(params.target).html( html );

        if(params.loader) {
            silab.overlay.toggle("process");
        }

    }
}



silab.laboratory.init();

