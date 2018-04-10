Ext.define('Alegra.view.alegra.ProductBxController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.alegra.productbx',

     requires: [
        'Ext.window.Window',
        'Alegra.view.alegra.ProductBxForm'
    ],

    onSessionChangeClick: function () {
        var changes = this.getView().getSession().getChanges();
        if (changes !== null) {
            new Ext.window.Window({
                autoShow: true,
                title: 'Session Changes',
                modal: true,
                width: 600,
                height: 400,
                layout: 'fit',
                items: {
                    xtype: 'textarea',
                    value: JSON.stringify(changes, null, 4)
                }
            });
        } else {
            Ext.Msg.alert('No Changes', 'There are no changes to the session.');
        }
    },

    createDialog: function(record) {
        var view = this.getView();

        this.isEdit = !!record;
        this.dialog = view.add({
            xtype: 'alegra-product-bx-form',
            viewModel: {
                data: {
                    title: record ? 'Edit: ' + record.get('name') : 'Add Product'
                },
                // If we are passed a record, a copy of it will be created in the newly spawned session.
                // Otherwise, create a new phantom company in the child.
                links: {
                    theProduct: record || {
                        type: 'Alegra.model.Product',
                        create: true
                    }
                },

                formulas: {
                    category: {
                        get: function(get) {
                            var hasCategory = get('theProduct').category();
                            var category = hasCategory ? hasCategory : null;
                            return category;
                        },

                    },
                    categoryName: {
                        get: function(get) {
                            var hasCategory = get('theProduct').category().first();
                            var categoryName = hasCategory ? hasCategory.get('id') : null;
                            return categoryName;
                        },
                        set: function(value) {
                            var category = this.get('theProduct').category().first();
                            var selection = this.get('categoryCombo').selection;
                            category.set({
                                id: selection.get('id'),
                                //idParent: selection.get('idParent'),
                                name: selection.get('name'),
                                //readOnly: selection.get('readOnly'),
                                //type: selection.get('type'),
                            });
                            //category.set('name',value);
                        },

                    },
                    taxName: {
                        get: function(get) {
                            var hasTax = get('theProduct').tax().first();
                            var taxName = hasTax ? hasTax.get('name') : null ;
                            return taxName;
                        },
                        set: function(value) {
                            var tax = this.get('theProduct').tax().first();
                            //this.get('theProduct').tax().set('name','prueba')
                            tax.set('name','PRUEBA');
                        },
                    },
                    inventory: {
                        get: function(get) {
                            var hasInventory = get('theProduct').inventory().first();
                            var inventory = hasInventory ? hasInventory : null ;
                            return inventory;
                        }
                    },
                    warehouses: {
                        get: function(get) {
                            var inventory = get('inventory');
                            var hasWarehouses = inventory ? inventory.warehouses() : null;
                            var warehouses = hasWarehouses ? hasWarehouses : null ;
                            return warehouses;
                        }
                    },
                }
            },
            session: true
        });

        this.dialog.show();
    },

    onAddProductClick: function() {
        this.createDialog(null);
    },

    onEditProductClick: function (button) {
        this.createDialog(button.getWidgetRecord());
    },

    onRemoveProductClick: function(button) {
        var productGrid = this.lookupReference('productGrid'),
            selection = productGrid.getSelectionModel().getSelection()[0];

        selection.drop();
    },

    onAddPriceClick: function() {
        var prices = this.lookupReference('prices').getStore();
        prices.insert(0,{
            idPriceList: 1,
            name: 'Select a Price List...',
            price: 0
        });
    },

    onRemovePriceClick: function (view, recIndex, cellIndex, item, e, record) {
        var prices = this.lookupReference('prices').getStore();
        prices.remove(record);
        //record.drop();
    },

    onAddWarehouseClick: function() {
        var warehouses = this.lookupReference('warehouses').getStore();
        warehouses.insert(0, {
            initialQuantity: 1,
            name: 'Select a Warehouse...'
        });
    },

    onRemoveWarehouseClick: function (view, recIndex, cellIndex, item, e, record) {
        var warehouses = this.lookupReference('warehouses').getStore();
        warehouses.remove(record);
    },

    onSaveClick: function () {
        // Save the changes pending in the dialog's child session back to the
        // parent session.
        var me = this;
        var dialog = this.dialog,
            form = this.lookupReference('form'),
            isEdit = this.isEdit,
            id;

        if (form.isValid()) {
            var me = this;

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

            me.timer = Ext.defer(function(){
                //This simulates a long-running operation like a database save or XHR call.
                //In real code, this would be in a callback function.
                me.timer = null;
                Ext.MessageBox.hide();
                //me.showToast('Your fake data was saved!', 'Done');
            }, 8000);

            if (!isEdit) {
                // Since we're not editing, we have a newly inserted record. Grab the id of
                // that record that exists in the child session
                id = dialog.getViewModel().get('theProduct').id;
            }
            //dialog.getSession().save();

            theProduct = dialog.getViewModel().get('theProduct');

            

            theProduct.save({
                waitMsg: 'Saving..',
                scope: this,
                success: function(record, operation) {
                    console.log(operation.response); // I can get server response in success      

                    Ext.Msg.alert('Status', 'Saved successfully.');
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
                }
            });  

            if (!isEdit) {
                // Use the id of that child record to find the phantom in the parent session, 
                // we can then use it to insert the record into our store
                this.getStore('products').insert(0, this.getSession().getRecord('Tutorial.model.Product', id));
            }
            this.onCancelClick();
            Ext.MessageBox.hide();
            //me.showToast('Your fake data was saved!', 'Done');
        } else {
            Ext.Msg.alert('Status', 'Invalid data.');
            Ext.MessageBox.hide();
            //me.showToast('Your fake data not was saved!', 'Done');
            return;
        }


    },

    onCancelClick: function () {
        this.dialog = Ext.destroy(this.dialog);
    },

    renderOrderId: function(v) {
        if (String(v).indexOf('O') > -1) {
            v = v.replace('Price-', 'O');
        }
        return v;
    },

    onWaitClick: function(btn) {
        var me = this;

        Ext.MessageBox.show({
            msg: 'Saving your data, please wait...',
            progressText: 'Saving...',
            width: 300,
            wait: {
                interval: 200
            },
            animateTarget: btn,
            maskClickAction: me.getMaskClickAction()
        });

        me.timer = Ext.defer(function(){
            //This simulates a long-running operation like a database save or XHR call.
            //In real code, this would be in a callback function.
            me.timer = null;
            Ext.MessageBox.hide();
            me.showToast('Your fake data was saved!', 'Done');
        }, 8000);
    },

});