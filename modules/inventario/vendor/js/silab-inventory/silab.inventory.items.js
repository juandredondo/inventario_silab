var silab = silab || {};

silab.items = {
    init: init
};

function init()
{
    if(silab.needs())
    {
        formLoaders();
    }

    function formLoaders()
    {
        $("body").on("click", "a[ data-role='form-loader' ][  data-source ]", function(e){
            e.preventDefault();
            let me      = $(this);

            silab.overlay.toggle( "load", "Cargando formulario..." );

            $(me.data("target"))
                .fadeOut()
                .load( me.data("source"), function(){
                    $(me.data("target")).fadeIn();
                    silab.overlay.toggle( "load" );
                }); 
        });
    }

}

