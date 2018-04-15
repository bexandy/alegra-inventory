Ext.define('Tutorial.model.Currency', {
    extend: 'Ext.data.Model',
    fields: [
    	{name: 'code', type: 'string'}, 
    	{name: 'symbol', type: 'string'}, 
    	{name: 'exchangeRate', type: 'string'}
    ],
    belongsTo: 'Tutorial.model.CompanyAlegra'
});