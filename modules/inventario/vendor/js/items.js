var silab =  silab || {};

// Items logic data
silab.items = function()
{
    this.hello = "Hello I'm a item";
}
// functions items
silab.items.prototype.loadForm = function(itemType)
{
    $.ajax({
        url     :   "load-form",
        data    :   { tipoItemId : itemType },
        type    :   "GET",
        success :   function(data)
        {
            var contentForm     = $("[data-next-form]")           .html(data)
            var nextForm        = $("[data-next-form-wrapper]")   .slideDown("slow");
            var contentHeight   = nextForm.addClass('height-auto').height();

            nextForm.removeClass('height-auto').animate({ 
                height: contentHeight
            }, 500);

        }
    });
}

silab.reactivo = function() 
{
    var item = silab.items;
    
}

