Ext.define('Alegra.view.alegra.ProductBxModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.alegra.productbx',

    stores: {
        products: {
            model: 'Alegra.model.Product',
            autoLoad: true,
            //session: true
        }
    }
});