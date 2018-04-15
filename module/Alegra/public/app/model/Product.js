Ext.define('Tutorial.model.Product', {
    extend: 'Ext.data.Model',
    requires:[
        'Tutorial.model.Price',
        'Tutorial.model.Inventory',
        'Tutorial.model.Category',
        'Tutorial.model.Tax',
    ],
    fields: [
        { name: 'id', type: 'int' },
        { name: 'name', type: 'string' },
        { name: 'description', type: 'string' },
        { name: 'reference', type: 'string'},
        { name: 'status', type: 'string' },
        { name: 'productKey', type: 'string' }
    ],
    hasMany: [
        {
            model: 'Tutorial.model.Tax',                                                  
            name: 'tax',
            associationKey: 'tax' 
        }, {                                                              
            model: 'Tutorial.model.Price',                                                  
            name: 'price',
            associationKey: 'price'                                
        }, {                                                              
            model: 'Tutorial.model.Inventory',                                                  
            name: 'inventory',
            associationKey: 'inventory'                                              
        }, {
            model: 'Tutorial.model.Category',                                                  
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