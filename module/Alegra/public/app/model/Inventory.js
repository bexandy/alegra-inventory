Ext.define('Alegra.model.Inventory', {
    extend: 'Ext.data.Model',
    requires:[
        'Alegra.model.Warehouses',
    ],
    fields: [
    	{ name: 'initialQuantity', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
    	{ name: 'unit', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
    	{ name: 'unitCost', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
    	{ name: 'availableQuantity', type: 'int', allowNull:true, useNull: true, defaultValue: null  }
    ],
    hasMany: [
        {                                                 
            model: 'Alegra.model.Warehouses',                                                  
            name: 'warehouses',
            associationKey: 'warehouses'                                             
        }
    ],
    writer: {
            type: 'json',
            writeRecordId: false,
            writeAllFields: false
    },
    belongsTo: 'Alegra.model.Product'
});