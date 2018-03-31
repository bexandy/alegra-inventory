<?php

namespace Alegra\Hydrator;


use Alegra\Filter\TaxFilter;
use Alegra\Model\Tax;
use Zend\Hydrator\HydratorInterface;

class TaxHydrator implements HydratorInterface
{
    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Tax) {
            return $object;
        }

        $filter = new TaxFilter();
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

        if ($this->propertyAvailable('percentage', $data)) {
            $object->setPercentage($data['percentage']);
        }

        if ($this->propertyAvailable('description', $data)) {
            $object->setDescription($data['description']);
        }

        if ($this->propertyAvailable('type', $data)) {
            $object->setType($data['type']);
        }

        if ($this->propertyAvailable('status', $data)) {
            $object->setStatus($data['status']);
        }

        return $object;
    }

    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Tax) {
            return array();
        }
        return $object->toArray();
     }

    protected function propertyAvailable($property, $data)
    {
        return array_key_exists($property, $data);
    }

}