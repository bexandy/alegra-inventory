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
        /*
        record.save();

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
        
        var product = Ext.create('MyApp.model.Product',{
                            id: values.id,
                            name: values.name,
                            description: values.description,
                            reference: values.reference,
                            tax: values.tax,
                            price: arrPrice,
                            category: objCategory,
                            inventory: objInventory,
                        });
        */
        //Ext.Msg.alert('Data Values', values);
        
        
         record.save({
            waitMsg: 'Saving..',
            scope: this,
            success: function(record, operation) {
                console.log(operation.response); // I can get server response in success      

                //var product = Ext.create('MyApp.model.Student');
                //var resp = Ext.decode(action.response.responseText);

                //if (resp.data[0]) {
                    // addstudent returns product model with Id so we can re-load model into form so form will have isDirty false
                //    product.set(resp.data[0]);
                //    productForm.loadRecord(product);
                //}
                
                productForm.getFields().each(function (field) {
                    field.validateOnChange = false;
                    field.setValue('');
                    field.resetOriginalValue();
                });

                //var store = Ext.create('MyApp.store.ProductsMapping');
                //store.load();
                Ext.getCmp('gridpanel').getStore().load();
                Ext.Msg.alert('Status', 'Saved successfully.');
            },
            failure: function(record, operation) {
                console.log(operation.response); // undefined
                Ext.Msg.alert('Status', 'Operation Failure.');
            }
        });  
        

        //result should contain success=true and data property otherwise it will go to failure even if there is no failure
        /*
        productForm.load({
            waitMsg: 'Loading...',
            method: 'GET',
            params:
            {
                id: 1
            },
            success: function (form, action) {
                try {
                    var resp = Ext.decode(action.response.responseText);

                    if (resp.data.length > 0) {
                        // addstudent returns student model with Id so we can re-load model into form so form will have isDirty false
                        var student = Ext.create('MyApp.model.Student');
                        student.set(resp.data[0]);
                        productForm.loadRecord(student);
                    }
                }
                catch (ex) {
                    Ext.Msg.alert('Status', 'Exception: ' + ex.Message);

                }
            },
            failure: function (form, action) {
                Ext.Msg.alert("Load failed", action.result.errorMessage);
            }
        });
        */
    },

});