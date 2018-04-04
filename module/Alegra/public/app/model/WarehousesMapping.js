Ext.define('Alegra.model.WarehousesMapping', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'id', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'observations', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'isDefault', type: 'boolean', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'address', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'status', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'initialQuantity', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'availableQuantity', type: 'int', allowNull:true, useNull: true, defaultValue: null  }
    ],
    proxy: {
        type: 'rest',
        url: '/api/warehouses',
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