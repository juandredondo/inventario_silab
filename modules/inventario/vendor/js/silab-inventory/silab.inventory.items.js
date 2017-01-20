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

            $(me.data("target"))
                .fadeOut()
                .load( me.data("source"), function(){
                    $(me.data("target")).fadeIn();
                }); 
        });
    }

}

