Ext.define('Alegra.model.TaxesMapping', {
    extend: 'Ext.data.Model',
    fields: [
        { name: 'id', type: 'int', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'name', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'percentage', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'description', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'status', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
        { name: 'type', type: 'string', allowNull:true, useNull: true, defaultValue: null  },
    ],
    proxy: {
        type: 'rest',
        url: '/api/taxes',
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