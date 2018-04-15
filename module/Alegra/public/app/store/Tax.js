Ext.define('Tutorial.store.Tax', {
    extend: 'Ext.data.Store',

    requires: [
        'Tutorial.model.Tax',
    ],

    alias: 'store.taxlist',

    model: 'Tutorial.model.Tax',

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
    autoLoad: true,
    session: true
});
