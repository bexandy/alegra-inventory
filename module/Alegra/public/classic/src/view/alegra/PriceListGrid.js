Ext.define('Alegra.view.alegra.PriceListGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'pricelistgrid',
    id: 'pricelistgrid',

    title: 'Price List',

    margin: 20,
    layout: {
        type: 'vbox',
        align: 'stretch'
    },

    frame: true,
    collapsible: true,

    store: {
        type: 'pricelist-mapping'
    },

    collapsible: true,

    columns: [
        { 
            text: 'Id', 
            dataIndex: 'idPriceList', 
            hidden: true,
            flex: 1 
        },
        { 
            text: 'Name',  
            dataIndex: 'name' , 
            flex: 1
        },
        {
            text: 'Type',
            dataIndex: 'type' , 
        },
        { 
            text: 'Status', 
            dataIndex: 'status', 
            flex: 1 
        }
    ],

});
