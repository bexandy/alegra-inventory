Ext.define('MyApp.view.alegra.TaxesGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'taxesgrid',
    id: 'taxesgrid',

    title: 'Taxes List',

    frame: true,
    collapsible: true,

    autoScroll: true,
    height: 600,

    store: {
        type: 'taxes-mapping'
    },

    columns: [
        { 
            text: 'Id', 
            dataIndex: 'id', 
            hidden: true,
            flex: 1 
        },
        { 
            text: 'Name',  
            dataIndex: 'name' , 
            flex: 1
        },
        { 
            text: 'Percentage',  
            dataIndex: 'percentage' , 
            flex: 1
        },
        { 
            text: 'Description',  
            dataIndex: 'description' , 
            flex: 1
        },
        {
            text: 'Status',
            dataIndex: 'status' , 
        },
        { 
            text: 'Type', 
            dataIndex: 'type', 
            flex: 1 
        }
    ],

});
