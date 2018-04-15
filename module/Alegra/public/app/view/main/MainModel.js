/**
 * This class is the view model for the Main view of the application.
 */
Ext.define('Tutorial.view.main.MainModel', {
    extend: 'Ext.app.ViewModel',

    alias: 'viewmodel.main',

    requires: [
        'Tutorial.model.CompanyAlegra',
    ],

    constructor: function(config) {
        var vm = this;

        this.callParent(arguments);
        
        vm.setStores({
            company: {
                model: 'Tutorial.model.CompanyAlegra',
                autoLoad: true,
                session: true,
                listeners: {
                    load: function(store, records) {                        
                        vm.set('name', store.getAt(0).get('name'));
                        vm.set('logo', '<img src="'+store.getAt(0).get('logo')+'" width="150px" />');
                        console.log(store.getAt(0).get('logo'));
                    }
                }
            }
        });
    },

    data: {
        name: '',
        img: '',
        logo: '<img src="{img}"/>',
        //empresa: '{company.first().name}',

        loremIpsum: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    }

    //TODO - add data, formulas and/or methods to support your view
});
