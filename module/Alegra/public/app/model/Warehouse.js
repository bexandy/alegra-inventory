Ext.define('Tutorial.model.Warehouse', {
    extend: 'Ext.data.Model',
    fields: [
    	{ name: 'id', type: 'int' },
    	{ name: 'name', type: 'string' },
    	{ name: 'observations', type: 'string' },
    	{ name: 'isDefault', type: 'boolean' },
    	{ name: 'address', type: 'string'  },
    	{ name: 'status', type: 'string' },
    	{ name: 'initialQuantity', type: 'int' },
    	{ name: 'availableQuantity', type: 'int' }
 	],

    belongsTo: 'Tutorial.model.Inventory'
});