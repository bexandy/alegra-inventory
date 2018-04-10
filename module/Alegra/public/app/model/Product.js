Ext.define('Alegra.model.Product', {
    extend: 'Ext.data.Model',
    requires:[
        'Alegra.model.Price',
        'Alegra.model.Inventory',
        'Alegra.model.Category',
        'Alegra.model.Tax',
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
            model: 'Alegra.model.Tax',                                                  
            name: 'tax',
            associationKey: 'tax' 
        }, {                                                              
            model: 'Alegra.model.Price',                                                  
            name: 'price',
            associationKey: 'price'                                
        }, {                                                              
            model: 'Alegra.model.Inventory',                                                  
            name: 'inventory',
            associationKey: 'inventory'                                              
        }, {
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