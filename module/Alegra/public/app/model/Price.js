Ext.define('Alegra.model.Price', {
    extend: 'Ext.data.Model',
    fields: [
    	{ name: 'idPriceList', type: 'int', useNull: true, defaultValue: null },
    	{ name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
    	{ name: 'type', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
    	{ name: 'price', type: 'int', allowNull:true, useNull: true, defaultValue: null  }
    ],
    proxy: {
        type: 'rest',
        url: '/api/price-list',
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
    writer: {
            type: 'json',
            writeRecordId: false,
            writeAllFields: false
    },
    belongsTo: 'Alegra.model.Product'
});