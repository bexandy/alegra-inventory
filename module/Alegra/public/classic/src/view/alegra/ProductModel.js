Ext.define('Tutorial.view.alegra.ProductModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.alegra.product',

    requires: [
        'Tutorial.model.Product',
    ],

    stores: {
        products: {
            model: 'Tutorial.model.Product',
            autoLoad: true,
            session: true
        }
    }
});