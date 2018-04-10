Ext.define('Alegra.model.Category', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' }
    ],
    belongsTo: 'Alegra.model.Product'
});