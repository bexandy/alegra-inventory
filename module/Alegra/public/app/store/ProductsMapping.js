Ext.define('Alegra.store.ProductsMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.products-mapping',
    storeId: 'store.products-mapping',
    model: 'Alegra.model.ProductMapping',

    autoLoad: true
});