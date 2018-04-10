Ext.define('Alegra.store.Warehouse', {
    extend: 'Ext.data.Store',

    alias: 'store.warehouselist-bx',

    model: 'Alegra.model.Warehouse',

    storeId: 'warehouselist',

    proxy: {
        type: 'rest',
        url: '/api/warehouses',
        reader: {
            type: 'json',
            rootProperty: 'data'
        },
        writer: {
            type: 'json',
            writeRecordId: false,
            writeAllFields: false
        }
    },

});