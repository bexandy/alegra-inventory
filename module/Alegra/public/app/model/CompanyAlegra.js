Ext.define('Tutorial.model.CompanyAlegra', {
    extend: 'Ext.data.Model',
    requires:[
        'Tutorial.model.Currency'
    ],
    fields: [
    	{name: 'name', type: 'string'}, 
    	{name: 'identification', type: 'string'}, 
    	{name: 'phone', type: 'string'}, 
    	{name: 'website', type: 'string'}, 
    	{name: 'email', type: 'string'}, 
    	{name: 'regime', type: 'string'}, 
    	{name: 'multicurrency', type: 'string'}, 
    	{name: 'address', type: 'string'}, 
    	{name: 'decimalPrecision', type: 'string'}, 
    	{name: 'invoicePreferences', type: 'string'}, 
    	{name: 'applicationVersion', type: 'string'}, 
    	{name: 'registryDate', type: 'string'}, 
    	{name: 'logo', type: 'string'}, 
    	{name: 'timeZone', type: 'string'}
    ],
    hasMany: {                                                              
        model: 'Tutorial.model.Currency',                                                  
        name: 'currency',
        associationKey: 'currency',                       
    },
    proxy: {
        type: 'rest',
        url: '/api/company',
        reader: {
            type: 'json',
            rootProperty: 'data'
        },
    },
});