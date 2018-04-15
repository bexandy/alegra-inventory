/**
 * This ViewModel provides data for the ChildSession view.
 */
Ext.define('Tutorial.view.alegra.CompanySessionModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.alegra.companysession',

    stores: {
        // Define a store of Company records that links to the Session.
        companiesAlegra: {
            model: 'Tutorial.model.CompanyAlegra',
            autoLoad: true,
            session: true
        }
    }
});