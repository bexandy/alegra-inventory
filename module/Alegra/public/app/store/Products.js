Ext.define('Alegra.store.Products', {
    extend: 'Ext.data.Store',
    alias: 'store.products',
    storeId: 'store.products',
    model: 'Alegra.model.Product',
    autoLoad: true
});