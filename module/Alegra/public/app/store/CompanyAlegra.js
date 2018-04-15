Ext.define('Tutorial.store.CompanyAlegra', {
    extend: 'Ext.data.Store',
    alias: 'store.companyalegra',
    model: 'Tutorial.model.CompanyAlegra',

    proxy: {
        type: 'ajax',
        url: 'data/companyalegra.json',
    },

    autoLoad: true,
    session: true
});