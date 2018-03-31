<?php

namespace Alegra\Hydrator;


use Alegra\Filter\CategoryFilter;
use Alegra\Model\Category;
use Zend\Hydrator\HydratorInterface;

class CategoryHydrator implements HydratorInterface
{
    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Category) {
            return $object;
        }

        $filter = new CategoryFilter();
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

        if ($this->propertyAvailable('idParent', $data)) {
            $object->setIdParent($data['idParent']);
        }

        if ($this->propertyAvailable('name', $data)) {
            $object->setName($data['name']);
        }

        if ($this->propertyAvailable('description', $data)) {
            $object->setDescription($data['description']);
        }

        if ($this->propertyAvailable('type', $data)) {
            $object->setType($data['type']);
        }

        if ($this->propertyAvailable('readOnly', $data)) {
            $object->setReadOnly($data['readOnly']);
        }

        return $object;
    }

    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Category) {
            return array();
        }
        return $object->toArray();
     }

    protected function propertyAvailable($property, $data)
    {
        return array_key_exists($property, $data);
    }

}