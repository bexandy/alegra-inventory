Ext.define('MyApp.view.alegra.CategoriesGrid', {
    extend: 'Ext.grid.Panel',
    xtype: 'categoriesgrid',
    id: 'categoriesgrid',

    title: 'Categories List',

    frame: true,
    collapsible: true,

    autoScroll: true,
    height: 600,

    store: {
        type: 'categories-mapping'
    },

    columns: [
        { 
            text: 'Id', 
            dataIndex: 'id', 
            hidden: true,
            flex: 1 
        },
        { 
            text: 'Id Parent',  
            dataIndex: 'idParent' , 
            hidden: true,
            flex: 1
        },
        { 
            text: 'Name',  
            dataIndex: 'name' , 
            flex: 1
        },
        { 
            text: 'Description',  
            dataIndex: 'description' , 
            flex: 1
        },
        {
            text: 'Type',
            dataIndex: 'type' , 
        },
        { 
            text: 'ReadOnly', 
            dataIndex: 'readOnly', 
            flex: 1 
        }
    ],

});
