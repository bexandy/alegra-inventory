/**
 * This controller manages the ChildSession view.
 */
Ext.define('Tutorial.view.alegra.CompanySessionController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.alegra.companysession',

    requires: [
        'Ext.window.Window',
        'Tutorial.view.alegra.CompanySessionForm'
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
            xtype: 'alegra-company-session-form',
            viewModel: {
                data: {
                    title: record ? 'Edit: ' + record.get('name') : 'Add Company'
                },
                // If we are passed a record, a copy of it will be created in the newly spawned session.
                // Otherwise, create a new phantom company in the child.
                links: {
                    theCompanyAlegra: record || {
                        type: 'Tutorial.model.CompanyAlegra',
                        create: true
                    }
                }
            },

            // Creates a child session that will spawn from the current session
            // of this view.
            session: true
        });

        this.dialog.show();
    },

    onAddCompanyClick: function() {
        this.createDialog(null);
    },

    onEditCompanyClick: function (button) {
        this.createDialog(button.getWidgetRecord());
    },

    onRemoveCompanyClick: function(button) {
        var companyGrid = this.lookupReference('companyGrid'),
            selection = companyGrid.getSelectionModel().getSelection()[0];

        selection.drop();
    },

    onAddOrderClick: function() {
        var orders = this.lookupReference('currencies').getStore();
        orders.insert(0, {
            date: new Date(),
            shipped: false
        });
    },

    onRemoveOrderClick: function (button) {
        var orders = this.lookupReference('currencies').getStore();
        orders.remove(button.getWidgetRecord());
    },

    onSaveClick: function () {
        // Save the changes pending in the dialog's child session back to the
        // parent session.
        var dialog = this.dialog,
            form = this.lookupReference('form'),
            isEdit = this.isEdit,
            id;

        if (form.isValid()) {
            if (!isEdit) {
                // Since we're not editing, we have a newly inserted record. Grab the id of
                // that record that exists in the child session
                id = dialog.getViewModel().get('theCompany').id;
            }
            dialog.getSession().save();
            if (!isEdit) {
                // Use the id of that child record to find the phantom in the parent session, 
                // we can then use it to insert the record into our store
                this.getStore('companies').insert(0, this.getSession().getRecord('Tutorial.model.CompanyAlegra', id));
            }
            this.onCancelClick();
        }
    },

    onCancelClick: function () {
        this.dialog = Ext.destroy(this.dialog);
    },

    renderOrderId: function(v) {
        if (String(v).indexOf('O') > -1) {
            v = v.replace('Currency-', 'O');
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