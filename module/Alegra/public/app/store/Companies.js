Ext.define('MyApp.store.Companies', {
    extend: 'Ext.data.Store',
    alias: 'store.companies',
    model: 'MyApp.model.Company',
    proxy: {
        type: 'rest',
        url: '/api/company',
        reader: {
            type: 'json',
            rootProperty: 'data'
        }
    },
    autoLoad: false
});