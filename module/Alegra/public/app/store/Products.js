Ext.define('MyApp.store.Products', {
    extend: 'Ext.data.Store',
    alias: 'store.products',
    storeId: 'store.products',
    model: 'MyApp.model.Product',
    autoLoad: true
});