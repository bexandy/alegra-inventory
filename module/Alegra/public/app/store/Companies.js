Ext.define('Alegra.store.Companies', {
    extend: 'Ext.data.Store',
    alias: 'store.companies',
    model: 'Alegra.model.Company',
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