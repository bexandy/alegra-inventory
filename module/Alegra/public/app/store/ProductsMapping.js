Ext.define('MyApp.store.ProductsMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.products-mapping',
    storeId: 'store.products-mapping',
    model: 'MyApp.model.ProductMapping',

    autoLoad: true
});