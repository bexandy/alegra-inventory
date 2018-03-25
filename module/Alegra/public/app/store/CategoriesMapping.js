Ext.define('MyApp.store.CategoriesMapping', {
    extend: 'Ext.data.Store',
    alias: 'store.categories-mapping',
    storeId: 'store.categories-mapping',
    model: 'MyApp.model.CategoriesMapping',
    autoLoad: true
});