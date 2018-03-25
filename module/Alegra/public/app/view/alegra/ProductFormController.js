Ext.define('MyApp.view.alegra.ProductFormController', {
    extend: 'Ext.app.ViewController',

    alias: 'controller.productform',

    requires: [
        'MyApp.model.Product',
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

        var product = Ext.create('MyApp.model.Product',{
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
        
         
    },

});