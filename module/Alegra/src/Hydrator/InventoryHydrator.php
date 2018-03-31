<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 21/03/18
 * Time: 11:21 AM
 */
namespace Alegra\Hydrator;

use Alegra\Filter\InventoryFilter;
use Alegra\Model\Inventory;
use Alegra\Model\Warehouses;
use Zend\Hydrator\HydratorInterface;

class InventoryHydrator implements HydratorInterface
{
    private $childHydrator;

    private $childEntity;


    /**
     * Class Constructor
     * @param    $currencyHydrator   
     */
    public function __construct()
    {
        $this->childHydrator['warehouses'] = new WarehousesHydrator;
        $this->childEntity['warehouses'] = new Warehouses();
    }



    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Inventory) {
            return $object;
        }
        return $object->toArray();
    }

    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Inventory) {
            return $object;
        }

        $filter = new InventoryFilter();
        $test = $filter->validate($data);

        if ($test->isValid()){
            $data = $test->getValues();
        } else {
            $noValid = str_replace(array('},','":{"','"','}','{'),array('|','->',' ','',''),json_encode($test->getMessages()));
            return $noValid;
        }

        if ($this->propertyAvailable('id', $data)) {
            $object->setId($data['id']);
        }

        if ($this->propertyAvailable('unit', $data)) {
            $object->setUnit($data['unit']);
        }

        if ($this->propertyAvailable('availableQuantity', $data)) {
            $object->setAvailableQuantity($data['availableQuantity']);
        }

        if ($this->propertyAvailable('unitCost', $data)) {
            $object->setUnitCost($data['unitCost']);
        }

        if ($this->propertyAvailable('initialQuantity', $data)) {
            $object->setInitialQuantity($data['initialQuantity']);
        }

        if ($this->propertyAvailable('warehouses', $data)) {
            $warehousesArray = [];
            foreach ($data['warehouses'] as $warehouses)
            {
                $warehousesArray[] = $this->childHydrator['warehouses']->hydrate(
                                        $warehouses, 
                                        $this->childEntity['warehouses']
                                    );
            }
            $object->setWarehouses($warehousesArray);
        }

        return $object;
    }

    protected function propertyAvailable($property, $data)
    {
        return (array_key_exists($property, $data));
    }

}