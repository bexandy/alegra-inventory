Ext.define('Alegra.model.Category', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' },
        { name: 'idParent', type: 'int' },
        { name: 'description', type: 'string' },
        { name: 'type', type: 'string' },
        { name: 'readOnly', type: 'boolean' }
    ],
    belongsTo: 'Alegra.model.Product'
});