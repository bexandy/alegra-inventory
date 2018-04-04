Ext.define('Alegra.view.alegra.ProductForm', {
    extend: 'Ext.form.Panel',
    requires: [
        'Ext.grid.*',
        'Ext.form.*',
        'Ext.layout.container.Column',
        'Alegra.model.ProductMapping',
        'Alegra.store.PriceListMapping',
        'Alegra.store.TaxesMapping',
        'Alegra.store.CategoriesMapping',
        'Alegra.store.WarehousesMapping',
        'Alegra.store.Units',

        'Alegra.view.alegra.ProductFormController',
        'Alegra.utility.VTypes'

    ],

    xtype: 'productform',    
    id: 'productform',

    controller: 'productform',

    frame: true,
    title: 'New Product',
    bodyPadding: 5,

    initComponent: function () {
        Ext.apply(this,
        {
            buttonAlign: 'center',
            fieldDefaults: {
                labelAlign: 'left',
                labelWidth: 90,
                anchor: '100%',
                msgTarget: 'side'
            },
            items: [
                    // Field Container Superior Datos Generales
            {
                xtype: 'fieldcontainer',
                layout: 'hbox',
                defaultType: 'textfield',
                width: '100%',
                fieldDefaults:
                {
                    labelAlign: 'top',
                    labelStyle: 'font-weight:bold'
                },
                items: [
                        // FieldContainer Izquierdo 50%
                {
                    xtype: 'fieldcontainer',
                    layout: 'vbox',
                    defaultType: 'textfield',
                    width: '50%',
                    fieldDefaults:
                    {
                        labelAlign: 'left',
                        labelStyle: 'font-weight:bold',
                        flex: 1,
                    },
                    items: [
                    {
                        fieldLabel: 'Name',
                        name: 'name',
                        required: true,
                        allowBlank: false,
                        maxLength: 150
                    },
                    {
                        fieldLabel: 'Reference',
                        name: 'reference',
                        maxLength: 45
                    },
                        // FieldSet De PriceList
                    {                                   
                        xtype:'fieldset',
                        title: 'PriceList',
                        //layout: 'hbox',
                        collapsible: false,
                        autoHeight:true,
                        //defaults: {width: 210},
                        defaultType: 'textfield',
                        items: [{
                            xtype: 'fieldcontainer',
                            layout: 'vbox',
                            defaultType: 'textfield',
                            //width: '50%',
                            items: [{
                                xtype: 'combobox',                                        
                                store: Ext.create('Alegra.store.PriceListMapping'),
                                displayField: 'name',
                                valueField: 'idPriceList',
                                label: 'Name',
                                labelWrap: true,
                                name: 'priceId',
                                fieldLabel: 'Name',
                                queryMode: 'local',
                                typeAhead: true,
                                allowBlank: false
                            },{
                                fieldLabel: 'Price ($)',
                                name: 'priceValue',
                                required: true,
                                allowBlank: false
                            }],
                        }],                        
                    }]
                },
                        // FieldContainer Derecho 50 %
                {
                    xtype: 'fieldcontainer',
                    layout: 'vbox',
                    defaultType: 'textfield',
                    width: '50%',
                    fieldDefaults:
                    {
                        labelAlign: 'left',
                        labelStyle: 'font-weight:bold',
                        flex: 1,
                    },
                    items: [
                    {
                        fieldLabel: 'Description',
                        xtype: 'textarea',
                        name: 'description',
                        maxLength: 150
                    },
                    {
                        xtype: 'combobox',                                        
                        store: Ext.create('Alegra.store.TaxesMapping'),
                        displayField: 'name',
                        valueField: 'id',
                        label: 'Tax Name',
                        labelWrap: true,
                        name: 'tax',
                        fieldLabel: 'Tax',
                        queryMode: 'local',
                        typeAhead: true,
                        //forceSelection: true
                    },
                    {
                        xtype: 'combobox',                                        
                        store: Ext.create('Alegra.store.CategoriesMapping'),
                        displayField: 'name',
                        valueField: 'id',
                        label: 'Category Name',
                        labelWrap: true,
                        name: 'categoryId',
                        fieldLabel: 'Category',
                        queryMode: 'local',
                        typeAhead: true,
                        //forceSelection: true
                    }]
                }]
            },
                    // Field Container Inferior Inventario
            {
                xtype: 'fieldcontainer',
                layout: 'hbox',
                defaultType: 'textfield',
                width: '100%',
                title: 'Inventory Details',
                fieldDefaults:
                {
                    labelAlign: 'top',
                    labelStyle: 'font-weight:bold',
                    flex: 1,
                },
                items: [
                {
                    xtype:'fieldset',
                    title: 'Inventory',
                    layout: 'hbox',
                    collapsible: false,
                    autoHeight:true,
                    defaults: {
                        margin: '0 0 10 5',
                    },
                    //defaultType: 'textfield',
                    items: [
                        // Field Container Inventory Details
                    {
                        xtype: 'fieldcontainer',
                        layout: 'hbox',
                        defaultType: 'textfield',
                        width: '50%',
                        defaults: {
                            margin: '0 0 10 5',
                        },
                        title: 'Inventory Details',
                        items: [
                        {
                            //margin: '0 0 5 5',
                            xtype: 'combobox',                                        
                            store: Ext.create('Alegra.store.Units'),
                            displayField: 'name',
                            valueField: 'name',
                            label: 'Unit',
                            labelWrap: true,
                            name: 'inventoryUnit',
                            fieldLabel: 'Unit',
                            queryMode: 'local',
                            typeAhead: true,
                            id: 'unit',
                            vtype: 'inventoryMatch'
                        },{
                            fieldLabel: 'Unit Cost ($)',
                            name: 'inventoryUnitCost',
                            id: 'unitCost',
                            vtype: 'inventoryMatch'
                            
                        }],
                    },
                        // Field Container Warehouses
                    {
                        xtype: 'fieldcontainer',
                        layout: 'hbox',
                        defaultType: 'textfield',
                        width: '50%',
                        defaults: {
                            margin: '0 0 10 5',
                        },
                        title: 'Warehouses',
                        items: [
                        {
                            //margin: '0 0 5 5',
                            xtype: 'combobox',                                        
                            store: Ext.create('Alegra.store.WarehousesMapping'),
                            displayField: 'name',
                            valueField: 'id',
                            label: 'Warehouse',
                            labelWrap: true,
                            name: 'warehousesId',
                            fieldLabel: 'Warehouse',
                            queryMode: 'local',
                            typeAhead: true,
                            id: 'warehouse',
                            vtype: 'inventoryMatch'
                            //forceSelection: true   
                        }, {
                            fieldLabel: 'Initial Quantity',
                            name: 'warehousesInitialQuantity',
                            id: 'initialQuantity',
                            vtype: 'inventoryMatch'
                            //margin: '0 0 5 5',
                        }],
                    }],
                }],
            }],
            buttons: [{
                text: 'Create',
                itemId: 'btnCreate',
                formBind: true,
                handler: 'onCreateClick'
            },
            {
                text: 'Reset',
                itemId: 'btnReset',
                handler: 'onResetClick'
            },
            {
                text: 'Clear',
                itemId: 'btnClear',
                handler: 'onClearClick'
            }]
        });

        

        this.callParent(arguments);

    },

    clearForm: function () {
        this.getForm().getFields().each(function (field) {
            field.validateOnChange = false;
            field.setValue('');
            field.resetOriginalValue();
        });
    }
});

