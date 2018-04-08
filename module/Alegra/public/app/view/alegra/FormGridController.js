Ext.define('Alegra.view.alegra.FormGridController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.formgrid',

    
    onResetClick: function (sender, record) {
        Ext.getCmp('formgrid-fieldset').setDisabled(true);
        this.getView().getForm().reset();
    },

    onSelectionChange: function(model, records) {
        //var dato = this.getView().getSelectionModel().getSelection();
        var rec = records[0];
        if (rec) {
          this.getView().getForm().reset();
          this.getView().getForm().loadRecord(rec);          
          Ext.getCmp('formgrid-fieldset').setDisabled(false);


/*
          var items = this.getView().getForm().getFields().items,
              i = 0,
              len = items.length;
          for(; i < len; i++) {
            var c = items[i];
            if(c.mixins && c.mixins.field && typeof c.mixins.field['initValue'] == 'function') {
              c.mixins.field.initValue.apply(c);
              c.wasDirty = false;
            }
          }
          */
        }
    },

    onUpdateClick: function (sender, record) {

        var productForm = this.getView().getForm();

        if (!productForm.isDirty()) {
            Ext.Msg.alert('Status', 'No pending changes to save.');
            return;
        }
        else if (!productForm.isValid()) {
            Ext.Msg.alert('Status', 'Invalid data.');
            return;
        }

        var record = productForm.getRecord();
        
       
        var values = productForm.getValues();

        var objTax = { id: values.taxId };
        var arrTax = [];
        arrTax.push(objTax);

        var objCategory = { id: values.categoryId };

        var objPrice = { id: values.priceId, price: values.priceValue };
        var arrPrice = [];
        arrPrice.push(objPrice);

        var objWarehouse = { id: values.warehousesId, initialQuantity: values.warehousesInitialQuantity };
        var arrWarehouses = [];
        arrWarehouses.push(objWarehouse);

        var objInventory = { unit: values.inventoryUnit, unitCost: values.inventoryUnitCost, warehouses: arrWarehouses };
        console.log(values);


        var product = {
            id: values.id,
            name: values.name,
            description: values.description,
            reference: values.reference,
            tax: arrTax,
            price: arrPrice,
            category: objCategory,
            inventory: objInventory,
        };
      
        record.set(product);

        var mask = new Ext.LoadMask({ msg: "Updating...", target: Ext.getCmp('formgrid-fieldset') });
        mask.show();

        Ext.MessageBox.show({
                msg: 'Updating your data, please wait...',
                progressText: 'Updating...',
                width: 300,
                wait: {
                    interval: 200
                },
                //animateTarget: btn,
                //maskClickAction: me.getMaskClickAction()
        });

         record.save({
            waitMsg: 'Updating..',
            scope: this,
            success: function(record, operation) {
                console.log(operation.response); // I can get server response in success      

                  productForm.getFields().each(function (field) {
                    field.validateOnChange = false;
                    field.setValue('');
                    field.resetOriginalValue();
                });

                Ext.getCmp('gridpanel').getStore().load();
                Ext.Msg.alert('Status', 'Saved successfully.');
                Ext.MessageBox.hide();
                mask.hide();
            },
            failure: function (record, operation) {
                Ext.Msg.alert('Save Failed', Ext.decode(operation.getError().response.responseText));
                try {
                    var resp = Ext.decode(operation.getError().response.responseText);
                    Ext.MessageBox.hide();
                    Ext.Msg.alert('Status', resp.message);

                }
                catch (ex) {
                    Ext.MessageBox.hide();
                    Ext.Msg.alert('Status', 'Not a valid data.' + ex.Message);
                }
                mask.hide();
            }
        });  
        

       if (mask != undefined) mask.hide();
    },

    onDeleteClick: function (sender, record) {

        var productForm = this.getView().getForm();
/*
        if (!productForm.isValid()) {
            Ext.Msg.alert('Status', 'Invalid data.');
            return;
        }

        if (!productForm.getValues(false, false, false, true).id) {
            Ext.Msg.alert('Status', 'Invalid or no data.');
            return;
        }
*/
        var record = productForm.getRecord();
        
       
             
        //record.set(product);

        var mask = new Ext.LoadMask({ msg: "Deleting...", target: Ext.getCmp('formgrid-fieldset') });
        mask.show();

        Ext.MessageBox.show({
                msg: 'Deleting your data, please wait...',
                progressText: 'Deleting...',
                width: 300,
                wait: {
                    interval: 200
                },

                //animateTarget: btn,
                //maskClickAction: me.getMaskClickAction()
        });

         record.erase({
            waitMsg: 'Deleting..',
            scope: this,
            success: function(record, operation) {
                console.log(operation.response); // I can get server response in success      

                productForm.getFields().each(function (field) {
                    field.validateOnChange = false;
                    field.setValue('');
                    field.resetOriginalValue();
                });

                //var store = Ext.create('MyApp.store.ProductsMapping');
                //store.load();
                Ext.getCmp('gridpanel').getStore().load();
                Ext.Msg.alert('Status', 'Delete successfully.');
                Ext.MessageBox.hide();
                mask.hide();
            },
            failure: function (record, operation) {
                Ext.Msg.alert('Delete Failed', Ext.decode(operation.getError().response.responseText));
                try {
                    var resp = Ext.decode(operation.getError().response.responseText);
                    Ext.MessageBox.hide();
                    Ext.Msg.alert('Status', resp.message);

                }
                catch (ex) {
                    Ext.MessageBox.hide();
                    Ext.Msg.alert('Status', 'Not a valid data.' + ex.Message);
                }
                mask.hide();
            }
        });  
        
        if (mask != undefined) mask.hide();
    }

});