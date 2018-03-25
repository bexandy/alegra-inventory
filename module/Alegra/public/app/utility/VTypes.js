Ext.define('MyApp.utility.VTypes', {
 
    init: function () {
        var me = this;
 
        this.defineVtypes();

    },

    defineVtypes:function () {
        var me = this;
 
        Ext.apply(Ext.form.field.VTypes, {
            inventoryMatch: function(val, field) {
                var unitField = field.up('form').down('#unit');
                var unitCostField = field.up('form').down('#unitCost');
                var warehouseField = field.up('form').down('#warehouse');
                var initialQuantityField = field.up('form').down('#initialQuantity');
                
                if (field.getValue() === null){
                    if (unitField.getValue() === null && unitCostField.getValue() === null && warehouseField.getValue() === null && initialQuantityField.getValue() === null){
                        unitField.clearInvalid();
                        unitCostField.clearInvalid();
                        warehouseField.clearInvalid();
                        initialQuantityField.clearInvalid();
                        return true;
                    } else {
                        unitField.markInvalid(true);
                        unitCostField.markInvalid(true);
                        warehouseField.markInvalid(true);
                        initialQuantityField.markInvalid(true);
                        return  true;
                    }
                }

                if (field.isDirty() && field.getValue() != ''){
                    if (
                        (unitField.isDirty() && unitField.getValue() != '') && 
                        (unitCostField.isDirty() || unitCostField.getValue() != '') && 
                        (warehouseField.isDirty() || warehouseField.getValue() != '') && 
                        (initialQuantityField.isDirty() != null || initialQuantityField.getValue() != '')
                       )
                    {
                        unitField.setValidation(true);
                        unitField.clearInvalid();
                        unitCostField.setValidation(true);
                        unitCostField.clearInvalid();
                        warehouseField.setValidation(true);
                        warehouseField.clearInvalid();
                        initialQuantityField.setValidation(true);
                        initialQuantityField.clearInvalid();
                        return true;
                    }
                } else {
                    if (
                        (unitField.getValue() === null || unitField.getValue() === '') && 
                        (unitCostField.getValue() === null || unitCostField.getValue() === '') && 
                        (warehouseField.getValue() === null || warehouseField.getValue() === '') && 
                        (initialQuantityField.getValue() === null || initialQuantityField.getValue() === '')
                       ){
                        unitField.setValidation(true);
                        unitField.clearInvalid();
                        unitCostField.setValidation(true);
                        unitCostField.clearInvalid();
                        warehouseField.setValidation(true);
                        warehouseField.clearInvalid();
                        initialQuantityField.setValidation(true);
                        initialQuantityField.clearInvalid();
                        return true;
                    }
                }
                
                unitField.setValidation(false);
                unitField.markInvalid(true);
                unitCostField.setValidation(false);
                unitCostField.markInvalid(true);
                warehouseField.setValidation(false);
                warehouseField.markInvalid(true);
                initialQuantityField.setValidation(false);
                initialQuantityField.markInvalid(true);
                return  false;

            },
            inventoryMatchText: 'All inventory data are required...'
        });

        Ext.apply(Ext.form.field.VTypes, {
            inventoryGridMatch: function(val, field) {
                var unitField = field.up('form').down('#formgrid-unit');
                var unitCostField = field.up('form').down('#formgrid-unitCost');
                var warehouseField = field.up('form').down('#formgrid-warehouse');
                var initialQuantityField = field.up('form').down('#formgrid-initialQuantity');
                
                if (field.getValue() === null){
                    if (unitField.getValue() === null && unitCostField.getValue() === null && warehouseField.getValue() === null && initialQuantityField.getValue() === null){
                        unitField.clearInvalid();
                        unitCostField.clearInvalid();
                        warehouseField.clearInvalid();
                        initialQuantityField.clearInvalid();
                        return true;
                    } else {
                        unitField.markInvalid(true);
                        unitCostField.markInvalid(true);
                        warehouseField.markInvalid(true);
                        initialQuantityField.markInvalid(true);
                        return  true;
                    }
                }

                if (field.isDirty() && field.getValue() != ''){
                    if (
                        (unitField.isDirty() && unitField.getValue() != '') && 
                        (unitCostField.isDirty() || unitCostField.getValue() != '') && 
                        (warehouseField.isDirty() || warehouseField.getValue() != '') && 
                        (initialQuantityField.isDirty() != null || initialQuantityField.getValue() != '')
                       )
                    {
                        unitField.setValidation(true);
                        unitField.clearInvalid();
                        unitCostField.setValidation(true);
                        unitCostField.clearInvalid();
                        warehouseField.setValidation(true);
                        warehouseField.clearInvalid();
                        initialQuantityField.setValidation(true);
                        initialQuantityField.clearInvalid();
                        return true;
                    }
                } else {
                    if (
                        (unitField.getValue() === null || unitField.getValue() === '') && 
                        (unitCostField.getValue() === null || unitCostField.getValue() === '') && 
                        (warehouseField.getValue() === null || warehouseField.getValue() === '') && 
                        (initialQuantityField.getValue() === null || initialQuantityField.getValue() === '')
                       ){
                        unitField.setValidation(true);
                        unitField.clearInvalid();
                        unitCostField.setValidation(true);
                        unitCostField.clearInvalid();
                        warehouseField.setValidation(true);
                        warehouseField.clearInvalid();
                        initialQuantityField.setValidation(true);
                        initialQuantityField.clearInvalid();
                        return true;
                    }
                }
                
                unitField.setValidation(false);
                unitField.markInvalid(true);
                unitCostField.setValidation(false);
                unitCostField.markInvalid(true);
                warehouseField.setValidation(false);
                warehouseField.markInvalid(true);
                initialQuantityField.setValidation(false);
                initialQuantityField.markInvalid(true);
                return  false;

            },
            inventoryGridMatchText: 'All inventory data are required...'
        });


    }
});