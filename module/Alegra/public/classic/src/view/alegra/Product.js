Ext.define('Tutorial.view.alegra.Product', {
    extend: 'Ext.panel.Panel',
    xtype: 'alegra-product',

    requires: [
        'Tutorial.view.alegra.ProductController',
        'Tutorial.view.alegra.ProductModel',
    ],

    title: 'All Products',
    //frame: true,
    //width: 600,
    //height: 450,
    centered: true,
    layout: {
        type: 'vbox',
        align: 'stretch'
    },

    viewModel: {
        type: 'alegra.product'
    },

    controller: 'alegra.product',

    // Create a session for this view
    session: true,

    items: [{
        flex: 1,
        xtype: 'grid',
        reference: 'productGrid',
        bind: '{products}',
        columns: [{
            dataIndex: 'name',
            flex: 1,
            text: 'Name'
        }, {
            dataIndex: 'reference',
            flex: 1,
            text: 'Reference'
        }, {
            flex: 1,
            text: 'General Price ($)',
            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var firstPrice = record.price().first();
                            text = firstPrice.get('price');
                            return text + ' $ (USD)';
                        }
        }, {
            dataIndex: 'description',
            flex: 1,
            text: 'Description'
        }, {
            xtype: 'widgetcolumn',
            width: 90,
            widget: {
                xtype: 'button',
                text: 'Edit',
                handler: 'onEditProductClick'
            }
        }]
    }],

    tbar: [{
        text: 'Add Product',
        handler: 'onAddProductClick'
    }, {
        text: 'Remove Product',
        handler: 'onRemoveProductClick',
        bind: {
            disabled: '{!productGrid.selection}'
        }
    }],

    buttons: [{
        text: 'Show Changes',
        handler: 'onSessionChangeClick'
    }]
});