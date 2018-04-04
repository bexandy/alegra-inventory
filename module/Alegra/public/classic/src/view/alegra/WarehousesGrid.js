Ext.define('Alegra.view.alegra.WarehousesGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'warehousesgrid',
    id: 'warehousesgrid',

    title: 'Warehouses List',

    frame: true,
    collapsible: true,

    autoScroll: true,
    height: 600,

    store: {
        type: 'warehouses-mapping'
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
            text: 'Observations',  
            dataIndex: 'observations' , 
            flex: 1
        },
        { 
            text: 'Is Default',  
            dataIndex: 'isDefault' , 
            flex: 1
        },
        {
            text: 'Address',
            dataIndex: 'address' , 
        },
        { 
            text: 'Status', 
            dataIndex: 'status', 
            flex: 1 
        },
        { 
            text: 'Initial Quantity', 
            dataIndex: 'initialQuantity', 
            flex: 1 
        },
        { 
            text: 'Available Quantity', 
            dataIndex: 'availableQuantity', 
            flex: 1 
        }
    ],

});
