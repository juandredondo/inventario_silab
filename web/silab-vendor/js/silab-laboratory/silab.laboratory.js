var silab = silab || {};

silab.laboratory  = {
    moduleName : "silab.laboratory"
}

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
    console.log("init from " + silab.laboratory.moduleName)
}

silab.laboratory.init();
