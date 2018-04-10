Ext.define('Alegra.view.alegra.ProductBxForm', {
    extend: 'Ext.window.Window',
    xtype: 'alegra-product-bx-form',

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
                            type: 'categorylist-bx',
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
                            type: 'taxlist-bx',
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
        }, {
            xtype: 'fieldset',
            title: 'Price List',
            defaultType: 'textfield',
            layout: 'anchor',
            collapsible: true,
            defaults: {
                anchor: '100%',
            },
            items: [{
                xtype: 'grid',
                name: 'price',
                autoLoad: true,
                plugins: 'grideditable',
                flex: 6,
                reference: 'prices',
                margin: '10 0 0 0',
                bind: '{theProduct.price}',
                tbar: [{
                        text: 'Add PriceList',
                        handler: 'onAddPriceClick'
                }],
                actions: {
                        remove: {
                            iconCls: 'cell-editing-delete-row',
                            handler: 'onRemovePriceClick'
                        },
                },
                columns: [{
                        text: 'Name',
                        dataIndex: 'name',
                        flex: 1,
                        editor: {
                            xtype: 'combobox',
                            store: {
                                type: 'pricelist-bx',
                                autoLoad: true
                            },
                            displayField: 'name',
                            valueField: 'name',
                            label: 'Name',
                            labelWrap: true,
                            name: 'name',
                            fieldLabel: 'Name',
                            queryMode: 'local',
                            typeAhead: true,
                            allowBlank: false
                        }
                }, {
                        text: 'Price ($ USD)',
                        dataIndex: 'price',
                        flex: 1,
                        editable: true,
                        format: '$0,0',
                        dirtyText: null,
                        editor: {
                            xtype: 'numberfield',
                            allowBlank: false,
                            minValue: 1,
                            maxValue: 150000,
                        }
                }, {
                        menuDisabled: true,
                        sortable: false,
                        xtype: 'actioncolumn',
                        width: 50,
                        items: ['@remove']
                }],
                plugins: [{
                        ptype: 'rowediting',
                        clicksToMoveEditor: 1,
                        autoCancel: false
                }]
            }]
        }, {
            xtype: 'fieldset',
            title: 'Inventory',
            defaultType: 'textfield',
            layout: 'anchor',
            collapsible: true,
            defaults: {
                anchor: '100%'
            },
            items: [{
                xtype: 'container',
                name: 'inventory',
                layout: 'hbox',
                defaultType: 'textfield',
                margin: '0 0 5 0',

                items: [{
                        fieldLabel: 'Unit Cost ($ USD)',
                        bind: '{inventory.unitCost}',
                        flex: 3,
                        allowBlank: true
                }, {
                        xtype: 'combobox',
                        reference: 'unit',
                        bind: '{inventory.unit}',                               
                        store: {
                            type: 'units',
                            autoLoad: true
                        },
                        displayField: 'name',
                        valueField: 'name',
                        label: 'Unit',
                        labelWrap: true,
                        fieldLabel: 'Unit',
                        queryMode: 'local',
                        typeAhead: true,
                        allowBlank: true,
                        flex: 3
                }]
            },  {
                xtype: 'grid',
                autoLoad: true,
                plugins: 'grideditable',
                flex: 6,
                reference: 'warehouses',
                margin: '10 0 0 0',
                bind: '{warehouses}',
                tbar: [{
                        text: 'Add Warehouse',
                        handler: 'onAddWarehouseClick'
                }],
                actions: {
                        remove: {
                            iconCls: 'cell-editing-delete-row',
                            handler: 'onRemoveWarehouseClick'
                        },
                },
                columns: [{
                        text: 'Initial Quantity',
                        dataIndex: 'initialQuantity',
                        flex: 1,
                        editable: true,
                        dirtyText: null,
                        editor: {
                            xtype: 'numberfield',
                            allowBlank: true,
                            minValue: 1,
                            maxValue: 150000,
                        }
                },{
                        text: 'Name',
                        dataIndex: 'name',
                        flex: 1,
                        editor: {
                            xtype: 'combobox',
                            store: {
                                type: 'warehouselist-bx',
                                autoLoad: true
                            },
                            displayField: 'name',
                            valueField: 'name',
                            label: 'Name',
                            labelWrap: true,
                            name: 'name',
                            fieldLabel: 'Name',
                            queryMode: 'local',
                            typeAhead: true,
                            allowBlank: true
                        }
                }, {
                        menuDisabled: true,
                        sortable: false,
                        xtype: 'actioncolumn',
                        width: 50,
                        items: ['@remove']
                }],
                plugins: [{
                        ptype: 'rowediting',
                        clicksToMoveEditor: 1,
                        autoCancel: false
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