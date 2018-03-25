Ext.define('MyApp.model.ProductMapping', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'id' },
        { name: 'name' },
        { name: 'description' },
        { name: 'reference' },
        { name: 'tax' },
        { name: 'priceId' , mapping: 'price[0].idPriceList' },
        { name: 'priceName' , mapping: 'price[0].name' },
        { name: 'priceValue' , mapping: 'price[0].price' },
        { name: 'categoryId' , mapping: 'category.id' },
        { name: 'categoryName' , mapping: 'category.name' },
        { name: 'inventoryUnit' , mapping: 'inventory.unit' },
        { name: 'inventoryUnitCost' , mapping: 'inventory.unitCost' },
        { name: 'inventoryInitialQuantity' , mapping: 'inventory.initialQuantity' },
        { name: 'inventoryAvailableQuantity' , mapping: 'inventory.availableQuantity' },
        { name: 'warehousesId' , mapping: 'inventory.warehouses[0].id' },
        { name: 'warehousesName' , mapping: 'inventory.warehouses[0].name' },
        { name: 'warehousesObservations' , mapping: 'inventory.warehouses[0].observations' },
        { name: 'warehousesIsDefault' , mapping: 'inventory.warehouses[0].isDefault' },
        { name: 'warehousesAddress' , mapping: 'inventory.warehouses[0].address' },
        { name: 'warehousesStatus' , mapping: 'inventory.warehouses[0].status' },
        { name: 'warehousesInitialQuantity' , mapping: 'inventory.warehouses[0].initialQuantity' },
        { name: 'warehousesAvailableQuantity' , mapping: 'inventory.warehouses[0].availableQuantity' },
        { name: 'status' },
        { name: 'productKey' }
    ],
    proxy: {
        type: 'rest',
        url: '/api/product',
        reader: {
            type: 'json',
            rootProperty: 'data'
        },
        writer: {
            type: 'json',
            writeRecordId: false,
            writeAllFields: false
        }
    },
});