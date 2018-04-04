Ext.define('Alegra.view.alegra.CompanyForm', {
    extend: 'Ext.form.Panel',

    xtype: 'companyform',
    title: 'Company Information',
    id: 'companyform',

    store: {
        type: 'companies'
    },
    initComponent: function () {
        Ext.apply(this,
        {
            fieldDefaults:
            {
                xtype: 'displayfield',
            },
            items: [{
                fieldLabel: 'Company Name',
                name: 'name'
            },{
                fieldLabel: 'Identification',
                name: 'identification'
            }, {
                fieldLabel: 'Phone',
                name: 'phone'
            }, {
                fieldLabel: 'Website',
                name: 'website'
            }, {
                fieldLabel: 'Regime',
                name: 'regime'
            }, {
                fieldLabel: 'Currency',
                name: 'currency'
            }]
            
        });

        this.callParent(arguments);

    },
});