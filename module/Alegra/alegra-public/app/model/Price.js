Ext.define('Alegra.model.Price', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'idPriceList', type: 'int' },
        { name: 'name', type: 'string'},
        { name: 'type', type: 'string' },
        { name: 'status', type: 'string' },
        { name: 'price', type: 'int' }
    ],

    belongsTo: 'Alegra.model.Product'
});