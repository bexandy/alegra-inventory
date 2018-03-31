<?php

namespace Alegra\Hydrator;


use Alegra\Filter\WarehousesFilter;
use Alegra\Model\Warehouses;
use Zend\Hydrator\HydratorInterface;

class WarehousesHydrator implements HydratorInterface
{
    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Warehouses) {
            return $object;
        }

        $filter = new WarehousesFilter();
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

        if ($this->propertyAvailable('name', $data)) {
            $object->setName($data['name']);
        }

        if ($this->propertyAvailable('observations', $data)) {
            $object->setObservations($data['observations']);
        }

        if ($this->propertyAvailable('isDefault', $data)) {
            $object->setIsDefault($data['isDefault']);
        }

        if ($this->propertyAvailable('address', $data)) {
            $object->setAddress($data['address']);
        }

        if ($this->propertyAvailable('initialQuantity', $data)) {
            $object->setInitialQuantity($data['initialQuantity']);
        }

        if ($this->propertyAvailable('availableQuantity', $data)) {
            $object->setAvailableQuantity($data['availableQuantity']);
        }

        if ($this->propertyAvailable('status', $data)) {
            $object->setStatus($data['status']);
        }

        return $object;
    }

    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Warehouses) {
            return array();
        }
        return $object->toArray();
     }

    protected function propertyAvailable($property, $data)
    {
        return array_key_exists($property, $data);
    }

}