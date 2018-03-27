Ext.define('MyApp.view.alegra.FormGridController', {
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
            tax: values.tax,
            price: arrPrice,
            category: objCategory,
            inventory: objInventory,
        };
      
        record.set(product);

        var mask = new Ext.LoadMask({ msg: "Updating...", target: Ext.getCmp('formgrid-fieldset') });
        mask.show();

         record.save({
            waitMsg: 'Saving..',
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
                mask.hide();
            },
            failure: function (record, operation) {
                Ext.Msg.alert('Save Failed', Ext.decode(operation.getError().response.responseText));
                try {
                    var resp = Ext.decode(operation.getError().response.responseText);
                    Ext.Msg.alert('Status', resp.message);

                }
                catch (ex) {
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

        var mask = new Ext.LoadMask({ msg: "Updating...", target: Ext.getCmp('formgrid-fieldset') });
        mask.show();

         record.erase({
            waitMsg: 'Saving..',
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
                mask.hide();
            },
            failure: function (record, operation) {
                Ext.Msg.alert('Delete Failed', Ext.decode(operation.getError().response.responseText));
                try {
                    var resp = Ext.decode(operation.getError().response.responseText);
                    Ext.Msg.alert('Status', resp.message);

                }
                catch (ex) {
                    Ext.Msg.alert('Status', 'Not a valid data.' + ex.Message);
                }
                mask.hide();
            }
        });  
        
        if (mask != undefined) mask.hide();
    }

});