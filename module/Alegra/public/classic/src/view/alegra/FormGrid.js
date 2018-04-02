Ext.define('MyApp.view.alegra.FormGrid', {
    extend: 'Ext.form.Panel',
    requires: [
        'Ext.grid.*',
        'Ext.form.*',
        'Ext.layout.container.Column',
        'MyApp.model.ProductMapping',
        'MyApp.store.ProductsMapping',
        'MyApp.store.PriceListMapping',

        'MyApp.view.alegra.FormGridController'
    ],
    xtype: 'form-grid',

    autoScroll: true,
    height: 600,

    controller: 'formgrid',

    frame: true,
    title: 'Products data',
    bodyPadding: 5,
    //layout: 'column',

    initComponent: function(){
    	Ext.apply(this, {
    		//width: 100%,
            buttonAlign: 'center',
            //controller: 'formgrid',
            fieldDefaults: {
                labelAlign: 'left',
                labelWidth: 90,
                anchor: '100%',
                msgTarget: 'side'
            },
            items: [
                    // GRID PARA VER EL LISTADO DE PRODUCTOS
            {
            	//columnWidth: 0.65,
                xtype: 'gridpanel',
                id: 'gridpanel',
                //controller: 'formgrid',
                store: {
			        type: 'products-mapping'
			    },
                height: 200,
                columns: [{
                    text     : 'Name',
                    flex     : 1,
                    dataIndex: 'name'
                },{
                    text     : 'Reference',
                    flex     : 1,
                    dataIndex: 'reference'
                },
                {
                    text     : 'Price',
                    flex     : 1,
                    dataIndex: 'priceValue'
                },
                {
                    text     : 'Description',
                    flex     : 1,
                    sortable : true,
                    dataIndex: 'description'
                }],

                listeners: {
                    selectionchange: 'onSelectionChange'
                }
            }, 
                   // FORMULARIO PARA EDITAR LOS PRODUCTOS 
            {
                disabled: true,
                id: 'formgrid-fieldset',
                margin: '0 0 0 10',
                xtype: 'fieldset',
                title:'Product details',
                defaultType: 'textfield',
                trackResetOnLoad: true,
                items: [
                {
                    xtype: 'displayfield',
                    fieldLabel: 'ID',
                    name: 'id',
                    required: true,
                    allowBlank: false,
                    submitValue: true
                },
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
                                    store: Ext.create('MyApp.store.PriceListMapping'),
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
                            maxLength: 500
                        },
                        {
                            xtype: 'combobox',                                        
                            store: Ext.create('MyApp.store.TaxesMapping'),
                            displayField: 'name',
                            valueField: 'id',
                            label: 'Tax Name',
                            labelWrap: true,
                            name: 'taxId',
                            fieldLabel: 'Tax',
                            queryMode: 'local',
                            typeAhead: true,
                            //forceSelection: true
                        },
                        {
                            xtype: 'combobox',                                        
                            store: Ext.create('MyApp.store.CategoriesMapping'),
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
                                store: Ext.create('MyApp.store.Units'),
                                displayField: 'name',
                                valueField: 'name',
                                label: 'Unit',
                                labelWrap: true,
                                name: 'inventoryUnit',
                                fieldLabel: 'Unit',
                                queryMode: 'local',
                                typeAhead: true,
                                id: 'formgrid-unit',
                                //vtype: 'inventoryGridMatch'
                            },{
                                fieldLabel: 'Unit Cost ($)',
                                name: 'inventoryUnitCost',
                                id: 'formgrid-unitCost',
                                //vtype: 'inventoryGridMatch'
                                
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
                                store: Ext.create('MyApp.store.WarehousesMapping'),
                                displayField: 'name',
                                valueField: 'id',
                                label: 'Warehouse',
                                labelWrap: true,
                                name: 'warehousesId',
                                fieldLabel: 'Warehouse',
                                queryMode: 'local',
                                typeAhead: true,
                                id: 'formgrid-warehouse',
                                //vtype: 'inventoryGridMatch'
                                //forceSelection: true   
                            }, {
                                fieldLabel: 'Initial Quantity',
                                name: 'warehousesInitialQuantity',
                                id: 'formgrid-initialQuantity',
                                //vtype: 'inventoryGridMatch'
                                //margin: '0 0 5 5',
                            }],
                        }],
                    }],
                }],
            }],
                    // BOTONES PARA ACTUALIZAR, BORRAR O RESETEAR
            buttons: [
            {
                text: 'Update',
                itemId: 'btnUpdate',
                formBind: true,
                handler: 'onUpdateClick'
            },
            {
                text: 'Delete',
                itemId: 'btnDelete',
                formBind: true,
                handler: 'onDeleteClick'
            },
            {
                text: 'Reset',
                itemId: 'btnReset',
                handler: 'onResetClick'
            }
            ]
    	});
    	this.callParent();
    },

    onSelectionChange: function(model, records) {
        Ext.Msg.confirm('Confirm', 'onSelectionChange Local', 'onConfirm', this);
        var rec = records[0];
        if (rec) {
          this.getForm().loadRecord(rec);
        }
    },

    onConfirm: function (choice) {
        if (choice === 'yes') {
            //
        }
    }    
});