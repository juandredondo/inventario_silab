var silab = silab || {};


silab.order  = {
    moduleName : "silab.order"
}

sOrder = silab.order;

silab.order.form = {
    id: "",
    widget: null   
}

silab.order.helpers = {
    appendDetail: function(data) {
        if( silab.needs(["jQuery.fn.yiiDynamicForm"], sOrder.moduleName) ) {
            console.log("This will be implemented... soon!");
        }
    }
}