/**
 * This class is the main view for the application. It is specified in app.js as the
 * "mainView" property. That setting automatically applies the "viewport"
 * plugin causing this view to become the body element (i.e., the viewport).
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('MyApp.view.main.Main', {
    extend: 'Ext.tab.Panel',
    xtype: 'app-main',
    id: 'mainview',

    requires: [
        'Ext.plugin.Viewport',
        'Ext.window.MessageBox',

        'MyApp.view.main.MainController',
        'MyApp.view.main.MainModel',

        'MyApp.view.alegra.FormGrid',
        'MyApp.view.alegra.ProductForm',
        'MyApp.view.alegra.PriceListGrid',
        'MyApp.view.alegra.TaxesGrid',
        'MyApp.view.alegra.CategoriesGrid',
        'MyApp.view.alegra.WarehousesGrid',

        'MyApp.view.alegra.ProductListPaging'
    ],

    controller: 'main',
    viewModel: 'main',

    ui: 'navigation',

    tabBarHeaderPosition: 1,
    titleRotation: 0,
    tabRotation: 0,

    header: {
        layout: {
            align: 'stretchmax'
        },
        title: {
            bind: {
                text: '{name}'
            },
            flex: 0
        },
        iconCls: 'fa-th-list'
    },

    tabBar: {
        flex: 1,
        layout: {
            align: 'stretch',
            overflowHandler: 'none'
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
    },  {
        title: 'Company',
        iconCls: 'fa-industry',
        items: [{
            xtype: 'productListPaging'
        }]
    }]
});
