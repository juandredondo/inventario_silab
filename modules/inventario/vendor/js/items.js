var silab =  silab || {};


// Items logic data
silab.items = function()
{
    this.form       = null;
    this.tipoActual = "items";
}
silab.items.tipos = {
    "ids" : {
        "reactivo"    :   3,
        "material"    :   4,
        "equipo"      :   5,
        "accesorio"   :   6,
        "herramienta" :   7,
    },
    "nombres" : {
        "3": "reactivo",
        "4": "material",
        "5": "equipo",
        "6": "accesorio",
        "7": "herramienta",
    }
}


silab.items.prototype.cambiarAccion = function(tipoId)
{
    if(this.form !== null)
    {
        // 1. guardar accion para remplazar
        var accion      = this.form.attr("action");
        var tipoNuevo   = silab.items.tipos.nombres[ tipoId ]; 
        // 2. remplazo accion
        if(typeof tipoNuevo !== "undefined")
        {
            accion          = accion.replace(this.tipoActual, tipoNuevo);
            this.tipoActual = tipoNuevo;
            this.form.attr("action", accion);
        }
    }
        
}
// functions items
silab.items.prototype.loadForm = function(params)
{
    var self = this;

    if(typeof params !== "undefined")
    {
        if(typeof params.itemType !== "undefined")
        {
            var nextForm        = $("[data-next-form-wrapper]");
                nextForm.animate({ height: 0 }, 500);
            
            $.ajax({
                url     :   "../items/load-form",
                data    :   { 
                                tipoItemId  :   params.itemType, 
                                formId      :   this.form.attr("id"),
                                itemId      :   params.itemId
                            },
                type    :   "GET",
                cache   : false,
                success :   function(data)
                {
                    console.log(nextForm);
                    var contentForm     = $("[data-next-form]")             .html(
                            self.getFormContent(data)
                        );
                    var contentHeight   = nextForm.addClass('height-auto')  .height();

                    nextForm.removeClass('height-auto').animate({ 
                        height: contentHeight
                    }, 500);

                }
            });
        }
        else
            throw "Debes pasar al menos, el tipo de item { itemType: entero }";
    }
    else
        throw "Parametros requeridos";
}

silab.items.prototype.getFormContent = function(data)
{
    var form = document.createElement("div");
        form.innerHTML = data;

    var formData = $("form", form).html();
        $("form", form).remove();

    return formData + $(form).html();
}

silab.reactivo = function() 
{
    var item = silab.items;
    
}

