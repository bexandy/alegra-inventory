Ext.define('Alegra.store.CategoriesMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.categories-mapping',
    storeId: 'store.categories-mapping',
    model: 'Alegra.model.CategoriesMapping',
    autoLoad: true
});