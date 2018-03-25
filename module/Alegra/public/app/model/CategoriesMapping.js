Ext.define('MyApp.model.CategoriesMapping', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'id', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'idParent', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'description', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'type', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'readOnly', type: 'boolean', allowNull:true, useNull: true, defaultValue: null  },
    ],
    proxy: {
        type: 'rest',
        url: '/api/categories',
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