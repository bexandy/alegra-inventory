/**
 * This class is the main view for the application. It is specified in app.js as the
 * "mainView" property. That setting automatically applies the "viewport"
 * plugin causing this view to become the body element (i.e., the viewport).
 *
 * TODO - Replace this content of this view to suite the needs of your application.
 */
Ext.define('Tutorial.view.main.Main', {
    extend: 'Ext.tab.Panel',
    xtype: 'app-main',

    requires: [
        'Ext.plugin.Viewport',
        'Ext.window.MessageBox',

        'Tutorial.view.main.MainController',
        'Tutorial.view.main.MainModel',
        'Tutorial.view.main.List',
        'Tutorial.view.alegra.Product'
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
            html: '{logo}',
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
            headerPosition: 'top',
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
        title: 'Home',
        iconCls: 'fa-home',
        // The following grid shares a store with the classic version's grid as well!
        items: [{
            xtype: 'mainlist'
        }]
    }, {
        title: 'Products',
        iconCls: 'fa-cog',
        items: [{
            xtype: 'alegra-product'
        }]
    }, {
        xtype: 'toolbar',
        docked: 'bottom',
        title: 'Bottom Toolbar'
   }]
});
