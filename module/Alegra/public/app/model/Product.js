Ext.define('MyApp.model.Product', {
    extend: 'Ext.data.Model',
    requires:[
        'MyApp.model.Price',
        'MyApp.model.Inventory',
        'MyApp.model.Category',
        'MyApp.model.Warehouses',
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
            model: 'MyApp.model.Price',                                                  
            name: 'price',
            associationKey: 'price'                                
        }, {                                                              
            model: 'MyApp.model.Inventory',                                                  
            name: 'inventory',
            associationKey: 'inventory'                                              
        },{
            model: 'MyApp.model.Category',                                                  
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