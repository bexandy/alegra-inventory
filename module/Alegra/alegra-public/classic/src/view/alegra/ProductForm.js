Ext.define('Alegra.view.alegra.ProductForm', {
    extend: 'Ext.window.Window',
    xtype: 'alegra-product-form',

    requires: [
        'Ext.grid.*',
        'Ext.form.*',
        'Ext.layout.container.Column',
        'Alegra.store.Category',
        'Alegra.store.Tax',
        'Alegra.store.Price',
        'Alegra.store.Warehouse'
    ],

    bind: {
        title: '{title}'
    },

    autoScroll: true,
    layout: 'fit',
    modal: true,
    width: 800,
    height: 550,
    closable: true,
    centered: true,

    items: {
        xtype: 'form',
        reference: 'form',
        autoScroll: true,
        bodyPadding: 10,
        border: false,
        // use the Model's validations for displaying form errors
        modelValidation: true,
        layout: {
            type: 'vbox',
            align: 'stretch'
        },
        fieldDefaults: {
            labelAlign: 'right',
            labelWidth: 90,
            msgTarget: Ext.supports.Touch ? 'side' : 'qtip',
            fieldStyle: 'font-weight: bold;',
        },
        items: [{
            xtype: 'fieldset',
            title: 'General Information',
            defaultType: 'textfield',
            layout: 'anchor',
            defaults: {
                anchor: '100%'
            },
            items: [{
                xtype: 'fieldcontainer',
                fieldLabel: 'Product',

                layout: 'hbox',
                combineErrors: true,
                defaultType: 'textfield',
                defaults: {
                    hideLabel: 'true'
                },
                items : [{
                    xtype: 'textfield',
                    fieldLabel: 'Name',
                    reference: 'name',
                    name: 'name',
                    msgTarget: 'side',
                    bind: '{theProduct.name}',
                    margin: '0 0 10 5',
                    flex: 2,
                    emptyText: 'Name',
                    allowBlank: false
                }, {
                    xtype: 'textfield',
                    fieldLabel: 'Reference',
                    reference: 'reference',
                    name: 'reference',
                    msgTarget: 'side',
                    bind: '{theProduct.reference}',
                    flex: 3,
                    margin: '0 0 0 6',
                    emptyText: 'Reference',
                    allowBlank: true
                }]
            }, {
                xtype: 'container',
                layout: 'hbox',
                defaultType: 'textfield',
                margin: '0 0 5 0',
                bind: '{category}',
                items: [{
                        xtype: 'combobox',
                        reference: 'categoryCombo',
                        name: 'category',
                        //reference: 'category',
                        bind: {
                            value: '{categoryName}', 
                        },                               
                        store: {
                            type: 'categorylist',
                            autoLoad: true
                        },
                        displayField: 'name',
                        valueField: 'id',
                        publishes: 'id',
                        label: 'Category Name',
                        labelWrap: true,
                        fieldLabel: 'Category',
                        queryMode: 'local',
                        typeAhead: true,
                        allowBlank: false,
                        flex: 3
                }, {
                        xtype: 'combobox',
                        reference: 'taxCombo',
                        name: 'tax',    
                        bind: '{taxName}',                                     
                        store: {
                            type: 'taxlist',
                            autoLoad: true
                        },
                        displayField: 'name',
                        valueField: 'name',
                        label: 'Tax Name',
                        labelWrap: true,
                        fieldLabel: 'Tax',
                        queryMode: 'local',
                        typeAhead: true,
                        flex: 3
                }]
            }, {
                xtype: 'container',
                layout: 'hbox',
                defaultType: 'textfield',
                margin: '0 0 5 0',

                items: [{
                        fieldLabel: 'Description',
                        name: 'description',
                        xtype: 'textarea',
                        bind: '{theProduct.description}',
                        reference: 'description',
                        flex: 12,
                }]
            }]
        }],
    },
    buttons: [{
        text: 'Save',
        handler: 'onSaveClick'
    }, {
        text: 'Cancel',
        handler: 'onCancelClick'
    }]
});