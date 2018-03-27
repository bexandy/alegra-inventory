Ext.define('MyApp.view.alegra.ProductViewModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.productviewmodel',
    stores: {
        ProductListPagingStore: {
            model: 'MyApp.model.Product',
            autoLoad: true,
            pageSize: 5,
            proxy:
           {
               type: 'rest',
               reader:
               {
                   rootProperty: 'data',
                   type: 'json',
                   totalProperty: 'TotalCount'
               },
               url: '/api/product'
           }
        }

    }
});