Ext.define('Alegra.store.WarehousesMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.warehouses-mapping',
    storeId: 'store.warehouses-mapping',
    model: 'Alegra.model.WarehousesMapping',
    autoLoad: true
});