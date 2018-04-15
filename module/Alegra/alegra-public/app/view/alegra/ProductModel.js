Ext.define('Alegra.view.alegra.ProductModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.alegra.product',

    requires:[
        'Alegra.model.Product'
    ],

    stores: {
        products: {
            model: 'Alegra.model.Product',
            autoLoad: true,
            //session: true
        }
    }

});