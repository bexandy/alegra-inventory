Ext.define('MyApp.model.Category', {
    extend: 'Ext.data.Model',
    idProperty: 'id',
    fields: [
    	{ name: 'id', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
    	{ name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null  }
    ],
    proxy: {
        type: 'rest',
        url: '/api/categories',
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
    belongsTo: 'MyApp.model.Product'
});