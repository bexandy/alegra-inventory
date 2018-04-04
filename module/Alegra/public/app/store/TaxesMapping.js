Ext.define('Alegra.store.TaxesMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.taxes-mapping',
    storeId: 'store.taxes-mapping',
    model: 'Alegra.model.TaxesMapping',
    autoLoad: true
});