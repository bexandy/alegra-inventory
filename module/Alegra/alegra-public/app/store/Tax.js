Ext.define('Alegra.store.Tax', {
    extend: 'Ext.data.Store',

    alias: 'store.taxlist',

    model: 'Alegra.model.Tax',

    storeId: 'taxlist',

    proxy: {
        type: 'rest',
        url: '/api/taxes',
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
