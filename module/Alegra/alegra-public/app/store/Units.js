Ext.define('Alegra.store.Units', {
    extend: 'Ext.data.Store',
    alias: 'store.units',
    model: 'Alegra.model.Unit',
    data : [
     {name: 'unit'},
     {name: 'centimeter'},
     {name: 'meter'},
     {name: 'inch'},
     {name: 'centimeterSquared'},
     {name: 'meterSquared'},
     {name: 'inchSquared'},
     {name: 'mililiter'},
     {name: 'liter'},
     {name: 'gallon'},
     {name: 'gram'},
     {name: 'kilogram'},
     {name: 'ton'},
     {name: 'pound'},
     {name: 'piece'},
     {name: 'service'},
     {name: 'notApplicable'}
    ],

    proxy: {
        type: 'memory',
        reader: {
            type: 'json'
        }
    },

    autoLoad: true
});