Ext.define('Tutorial.model.Category', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [
    	{ name: 'id', type: 'int' },
    	{ name: 'name', type: 'string' }
    ],
    belongsTo: 'Tutorial.model.Product'
});