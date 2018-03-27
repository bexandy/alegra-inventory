Ext.define('MyApp.store.Personnel', {
    extend: 'Ext.data.Store',
    alias: 'store.personnel',
    model: 'MyApp.model.Person',
    proxy: {
        type: 'rest',
        url: '/api/company',
        reader: {
            type: 'json',
            rootProperty: 'data'
        }
    },
    autoLoad:false
});
