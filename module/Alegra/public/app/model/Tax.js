Ext.define('Alegra.model.Tax', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' },
        { name: 'percentage', type: 'string' },
        { name: 'description', type: 'string' },
        { name: 'status', type: 'string'},
        { name: 'type', type: 'string' },
    ],
    belongsTo: 'Alegra.model.Product'
});