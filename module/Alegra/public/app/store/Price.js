Ext.define('Tutorial.store.Price', {
    extend: 'Ext.data.Store',
    requires: [
        'Tutorial.model.Price',
    ],

    alias: 'store.pricelist',

    model: 'Tutorial.model.Price',

    storeId: 'pricelist',

    proxy: {
        type: 'rest',
        url: '/api/price-list',
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