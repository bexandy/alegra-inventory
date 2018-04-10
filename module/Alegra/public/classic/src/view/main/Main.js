/**
 * This class is the main view for the application. It is specified in app.js as the
 * "mainView" property. That setting automatically applies the "viewport"
 * plugin causing this view to become the body element (i.e., the viewport).
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('Alegra.view.main.Main', {
    extend: 'Ext.tab.Panel',
    xtype: 'app-main',
    id: 'mainview',

    requires: [
        'Ext.plugin.Viewport',
        'Ext.window.MessageBox',

        'Alegra.view.main.MainController',
        'Alegra.view.main.MainModel',

        'Alegra.view.alegra.FormGrid',
        'Alegra.view.alegra.ProductForm',
        'Alegra.view.alegra.PriceListGrid',
        'Alegra.view.alegra.TaxesGrid',
        'Alegra.view.alegra.CategoriesGrid',
        'Alegra.view.alegra.WarehousesGrid',
        'Alegra.view.alegra.ProductBx'

    ],

    controller: 'main',
    viewModel: 'main',

    ui: 'navigation',

    session: true,

    tabBarHeaderPosition: 1,
    titleRotation: 0,
    tabRotation: 0,

    style: {
        background: '#F5EEEE',
    },


    header: {
        layout: {
           align: 'stretchmax'
        },
        title: {
            bind: {
                text: '{logo}'
            },
            flex: 0,
            //html: '{logo}',
            width: 150
        },
        
        iconAlign: 'top',
    },

    tabBar: {
        flex: 1,
        layout: {
            align: 'stretch',
            overflowHandler: 'scroller'
        }
    },

    responsiveConfig: {
        tall: {
            headerPosition: 'top'
        },
        wide: {
            headerPosition: 'left'
        }
    },

    defaults: {
        bodyPadding: 20,
        tabConfig: {
            plugins: 'responsive',
            responsiveConfig: {
                wide: {
                    iconAlign: 'left',
                    textAlign: 'left'
                },
                tall: {
                    iconAlign: 'top',
                    textAlign: 'center',
                    width: 120
                }
            }
        }
    },

    items: [{
        title: ' Products Inventory',
        iconCls: 'fa-cubes',
        items: [{
            xtype: 'form-grid',
            reference: 'formGrid'
        }]
    },  
    {
        title: 'New Product',
        iconCls: 'fa-plus',
        items: [{
            xtype: 'productform',
        }]
    },
    {
        title: 'Price List',
        iconCls: 'fa-dollar',
        items: [{
            xtype: 'pricelistgrid',
        }]
    },
    {
        title: 'Taxes List',
        iconCls: 'fa-calculator',
        items: [{
            xtype: 'taxesgrid'
        }]
    },
    {   
        title: 'Categories List',
        iconCls: 'fa-sitemap',
        items: [{
            xtype: 'categoriesgrid',
        }]
    },  {
        title: 'Warehouses List',
        iconCls: 'fa-home',
        items: [{
            xtype: 'warehousesgrid'
        }]
    }, {
        title: 'Products',
        iconCls: 'fa-times',
        items: [{
            xtype: 'alegra-product-bx'
        }]
    }]
});
