Ext.define('Alegra.store.PriceListMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.pricelist-mapping',
    storeId: 'store.pricelist-mapping',
    model: 'Alegra.model.PriceListMapping',
    autoLoad: true
});