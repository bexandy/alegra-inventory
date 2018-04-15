Ext.define('Tutorial.model.Inventory', {
    extend: 'Ext.data.Model',
    requires:[
        'Tutorial.model.Warehouse',
    ],
    fields: [
    	{ name: 'initialQuantity', type: 'int' },
    	{ name: 'unit', type: 'string'  },
    	{ name: 'unitCost', type: 'int' },
    	{ name: 'availableQuantity', type: 'int'  }
    ],
    hasMany: [
        {                                                 
            model: 'Tutorial.model.Warehouse',                                                  
            name: 'warehouses',
            associationKey: 'warehouses'                                             
        }
    ],

    belongsTo: 'Tutorial.model.Product'
});