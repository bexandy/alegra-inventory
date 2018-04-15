Ext.define('Tutorial.store.Warehouse', {
    extend: 'Ext.data.Store',
    requires: [
        'Tutorial.model.Warehouse',
    ],

    alias: 'store.warehouselist',

    model: 'Tutorial.model.Warehouse',

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
    autoLoad: true,
    session: true
});