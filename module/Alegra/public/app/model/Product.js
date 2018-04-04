Ext.define('Alegra.model.Product', {
    extend: 'Ext.data.Model',
    requires:[
        'Alegra.model.Price',
        'Alegra.model.Inventory',
        'Alegra.model.Category',
        'Alegra.model.Warehouses',
    ],
    fields: [
        { name: 'id', type: 'int', allowNull:true, useNull: true, defaultValue: null },
        { name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'description', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'reference', type: 'string', allowNull:true, useNull: true, defaultValue: null },
        { name: 'tax', type: 'auto', allowNull:true, useNull: true, defaultValue: null },
        { name: 'status', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'productKey', type: 'string', allowNull:true, useNull: true, defaultValue: null }
    ],
    hasMany: [
        {                                                              
            model: 'Alegra.model.Price',                                                  
            name: 'price',
            associationKey: 'price'                                
        }, {                                                              
            model: 'Alegra.model.Inventory',                                                  
            name: 'inventory',
            associationKey: 'inventory'                                              
        },{
            model: 'Alegra.model.Category',                                                  
            name: 'category',
            associationKey: 'category'
        }
    ],
    proxy: {
        type: 'rest',
        url: '/api/product',
        reader: {
            type: 'json',
            rootProperty: 'data'
        },
        writer: {
            type: 'json',
            writeRecordId: false,
            writeAllFields: false
        }
    },
});