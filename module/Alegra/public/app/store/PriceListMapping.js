Ext.define('MyApp.store.PriceListMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.pricelist-mapping',
    storeId: 'store.pricelist-mapping',
    model: 'MyApp.model.PriceListMapping',
    autoLoad: true
});