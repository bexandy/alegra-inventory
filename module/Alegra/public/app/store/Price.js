Ext.define('Alegra.store.Price', {
    extend: 'Ext.data.Store',

    alias: 'store.pricelist-bx',

    model: 'Alegra.model.Price',

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

});