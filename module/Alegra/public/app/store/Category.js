Ext.define('Tutorial.store.Category', {
    extend: 'Ext.data.Store',

    requires: [
        'Tutorial.model.Category',
    ],

    alias: 'store.categorylist',

    model: 'Tutorial.model.Category',

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

    autoLoad: true,
    session: true
});