Ext.define('MyApp.model.PriceListMapping', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'idPriceList', type: 'int', allowNull:true, useNull: true, defaultValue: null },
        { name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null },
        { name: 'status', type: 'string', allowNull:true, useNull: true, defaultValue: null },
        { name: 'type', type: 'string', allowNull:true, useNull: true, defaultValue: null },
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
});