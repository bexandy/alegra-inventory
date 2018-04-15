/**
 * This form is a popup window used by the ChildSession view. This view is
 * added as a contained window so we use the same ViewController instance.
 */
Ext.define('Tutorial.view.alegra.CompanySessionForm', {
    extend: 'Ext.window.Window',
    xtype: 'alegra-company-session-form',

    bind: {
        title: '{title}'
    },
    layout: 'fit',
    modal: true,
    width: 600,
    height: 450,
    closable: true,
    centered: true,

    items: {
        xtype: 'form',
        reference: 'form',
        bodyPadding: 10,
        border: false,
        // use the Model's validations for displaying form errors
        modelValidation: true,
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        items: [{
            xtype: 'textfield',
            fieldLabel: 'Name',
            reference: 'name',
            msgTarget: 'side',
            bind: '{theCompanyAlegra.name}'
        }, {
            xtype: 'textfield',
            fieldLabel: 'Phone',
            reference: 'phone',
            msgTarget: 'side',
            bind: '{theCompanyAlegra.phone}'
        }, {
            xtype: 'grid',
            autoLoad: true,
            flex: 1,
            reference: 'currencies',
            margin: '10 0 0 0',
            title: 'Orders',
            bind: '{theCompanyAlegra.currency}',
            tbar: [{
                text: 'Add Order',
                handler: 'onAddOrderClick'
            }],
            columns: [{
                text: 'Code',
                dataIndex: 'code',
                flex: 1,
                renderer: 'renderOrderId'
            }, {
                text: 'Symbol',
                dataIndex: 'symbol',
                width: 90,
            }, {
                text: 'Exchange Rate', 
                dataIndex: 'exchangeRate'
            }, {
               xtype: 'widgetcolumn',
                flex: 1,
                widget: {
                    xtype: 'button',
                    text: 'Remove',
                    handler: 'onRemoveOrderClick'
                }
            }]
        }]
    },

    buttons: [{
        text: 'Save',
        handler: 'onSaveClick'
    }, {
        text: 'Cancel',
        handler: 'onCancelClick'
    }]
});