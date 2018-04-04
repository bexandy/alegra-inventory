Ext.define('Alegra.view.alegra.ProductViewModel', {
    extend: 'Ext.app.ViewModel',
    alias: 'viewmodel.productviewmodel',
    stores: {
        ProductListPagingStore: {
            model: 'Alegra.model.Product',
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