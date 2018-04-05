Ext.define('Alegra.view.alegra.ProductFormController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.productform',

    requires: [
        'Alegra.model.Product',
     ],

    onResetClick: function (sender, record) {
        this.getView().getForm().reset();
    },
    onClearClick: function (sender, record) {
        this.getView().clearForm();
    },

    onCreateClick: function (sender, record) {
        var productForm = this.getView().getForm();

        if (!productForm.isDirty()) {
            Ext.Msg.alert('Status', 'No new data to create.');
            return;
        }
        else if (!productForm.isValid()) {
            Ext.Msg.alert('Status', 'Invalid data.');
            return;
        }

        var values = productForm.getValues();

        var objCategory = { id: values.categoryId };

        var objPrice = { id: values.priceId, price: values.priceValue };
        var arrPrice = [];
        arrPrice.push(objPrice);

        var objWarehouse = { id: values.warehousesId, initialQuantity: values.warehousesInitialQuantity };
        var arrWarehouses = [];
        arrWarehouses.push(objWarehouse);

        var objInventory = { unit: values.inventoryUnit, unitCost: values.inventoryUnitCost, warehouses: arrWarehouses };

        var product = Ext.create('Alegra.model.Product',{
                            name: values.name,
                            description: values.description,
                            reference: values.reference,
                            tax: values.tax,
                            price: arrPrice,
                            category: objCategory,
                            inventory: objInventory,
                        });
        //console.log(values);
        //Ext.Msg.alert('Data Values', values);
        Ext.MessageBox.show({
                msg: 'Saving your data, please wait...',
                progressText: 'Saving...',
                width: 300,
                wait: {
                    interval: 200
                },
                //animateTarget: btn,
                //maskClickAction: me.getMaskClickAction()
            });

         product.save({
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

                Ext.getCmp('gridpanel').getStore().load();
                Ext.MessageBox.hide();
                Ext.Msg.alert('Status', 'Saved successfully.');
            },
            failure: function (record, operation) {
                Ext.MessageBox.hide();
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
            }
        });  
        
         
    },

});