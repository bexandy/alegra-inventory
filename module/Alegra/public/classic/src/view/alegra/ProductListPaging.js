Ext.define('MyApp.view.alegra.ProductListPaging', {
    extend: 'Ext.grid.Panel',
    xtype: 'productListPaging',

    title: 'Product List - Paging Demo',

    viewModel: { type: 'productviewmodel' },
    selType: 'rowmodel',
    selModel:
    {
        mode: 'SINGLE'
    },
    viewConfig:
    {
        stripeRows: true
    },
    listeners: {
      selectionchange: 'onSelectionChange'
    },
    bind: {
        store: '{ProductListPagingStore}'
    },
    initComponent: function () {
        Ext.apply(this,
        {
            columns: [
                { 
                    text: 'Id',  
                    dataIndex: 'id', 
                },
                { 
                    text: 'Name', 
                    dataIndex: 'name', 
                    flex: 1 
                },
                { 
                    text: 'Description', 
                    dataIndex: 'description', 
                    flex: 1 
                },
                { 
                    text: 'Reference',  
                    hidden: true,
                    dataIndex: 'reference' , 
                    flex: 1
                },
                { 
                    text: 'Price', 
                    columns: [{
                        text: 'idPriceList',
                        hidden: true,
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var firstPrice = record.price().first();
                            text = firstPrice.get('idPriceList');
                            return text;
                        }
                    }, {
                        text: 'name',
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var firstPrice = record.price().first();
                            text = firstPrice.get('name');
                            return text;
                        }
                    }, {
                        text: 'type',
                        hidden: true,
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var firstPrice = record.price().first();
                            text = firstPrice.get('type');
                            return text;
                        }
                    }, {
                        text: 'price',
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var firstPrice = record.price().first();
                            text = firstPrice.get('price');
                            return text;
                        }
                    }]
                },
                { 
                    text: 'Tax', 
                    dataIndex: 'tax', 
                    flex: 1 
                },
                { 
                    text: 'Category',
                    columns: [{
                        text: 'id',
                        hidden: true,
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var category = record.category().first();
                            text = category.get('id');
                            return text;
                        }
                    }, {
                        text: 'name',
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var category = record.category().first();
                            text = category.get('name');
                            return text;
                        }
                    }]
                },
                { 
                    text: 'Inventory', 
                    columns: [{
                        text: 'initialQuantity',
                        hidden: true,
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var inventory = record.inventory().first();
                            text = inventory.get('initialQuantity');
                            return text;
                        }
                    }, {
                        text: 'unit',
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var inventory = record.inventory().first();
                            text = inventory.get('unit');
                            return text;
                        }
                    }, {
                        text: 'unitCost',
                        hidden: true,
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var inventory = record.inventory().first();
                            text = inventory.get('unitCost');
                            return text;
                        }
                    }, {
                        text: 'availableQuantity',
                        renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                            var inventory = record.inventory().first();
                            text = inventory.get('availableQuantity');
                            return text;
                        }
                    }, {
                        text: 'warehouses',
                        columns: [{
                            text: 'id',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('id');
                                return text;
                            }
                        }, {
                            text: 'name',
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('name');
                                return text;
                            }
                        }, {
                            text: 'observations',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('observations');
                                return text;
                            }
                        }, {
                            text: 'isDefault',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('isDefault');
                                return text;
                            }
                        }, {
                            text: 'address',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('address');
                                return text;
                            }
                        }, {
                            text: 'status',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('status');
                                return text;
                            }
                        }, {
                            text: 'initialQuantity',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('initialQuantity');
                                return text;
                            }
                        }, {
                            text: 'availableQuantity',
                            hidden: true,
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                var inventory = record.inventory().first();
                                var warehouses = inventory.warehouses().first();
                                text = warehouses.get('availableQuantity');
                                return text;
                            }
                        }]
                    }]
                },
                { 
                    text: 'Status', 
                    dataIndex: 'status', 
                    flex: 1 
                },
                { 
                    text: 'Product Key', 
                    hidden: true,
                    dataIndex: 'productKey', 
                    flex: 1
                }
            ],
            bbar: [{
                xtype: 'pagingtoolbar',
                bind:{
                    store: '{ProductListPagingStore}'
                },
                displayInfo: true,
                displayMsg: 'Displaying {0} to {1} of {2} &nbsp;records ',
                emptyMsg: "No records to display&nbsp;"
            }]

        });

        this.callParent(arguments);
    }
});