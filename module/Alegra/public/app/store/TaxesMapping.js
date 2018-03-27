Ext.define('MyApp.store.TaxesMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.taxes-mapping',
    storeId: 'store.taxes-mapping',
    model: 'MyApp.model.TaxesMapping',
    autoLoad: true
});