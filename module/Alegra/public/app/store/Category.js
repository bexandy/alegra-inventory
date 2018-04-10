Ext.define('Alegra.store.Category', {
    extend: 'Ext.data.Store',

    alias: 'store.categorylist-bx',

    model: 'Alegra.model.Category',

    storeId: 'categorylist',

    proxy: {
        type: 'rest',
        url: '/api/categories',
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