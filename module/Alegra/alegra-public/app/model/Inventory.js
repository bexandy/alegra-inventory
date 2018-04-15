Ext.define('Alegra.model.Inventory', {
    extend: 'Ext.data.Model',
    requires:[
        'Alegra.model.Warehouse',
    ],
    fields: [
        { name: 'initialQuantity', type: 'int' },
        { name: 'unit', type: 'string'  },
        { name: 'unitCost', type: 'int' },
        { name: 'availableQuantity', type: 'int'  }
    ],
    hasMany: [
        {                                                 
            model: 'Alegra.model.Warehouse',                                                  
            name: 'warehouses',
            associationKey: 'warehouses'                                             
        }
    ],

    belongsTo: 'Alegra.model.Product'
});