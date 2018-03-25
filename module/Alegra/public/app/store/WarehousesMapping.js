Ext.define('MyApp.store.WarehousesMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.warehouses-mapping',
    storeId: 'store.warehouses-mapping',
    model: 'MyApp.model.WarehousesMapping',
    autoLoad: true
});