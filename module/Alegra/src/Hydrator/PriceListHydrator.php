<?php

namespace Alegra\Hydrator;


use Alegra\Filter\PriceListFilter;
use Alegra\Model\PriceList;
use Zend\Hydrator\HydratorInterface;

class PriceListHydrator implements HydratorInterface
{
    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof PriceList) {
            return $object;
        }

        $filter = new PriceListFilter();
        $test = $filter->validate($data);

        if ($test->isValid()){
            $data = $test->getValues();
        } else {
            $noValid = str_replace(array('},','":{"','"','}','{'),array('|','->',' ','',''),json_encode($test->getMessages()));
            return $noValid;
        }

        if ($this->propertyAvailable('idPriceList', $data)) {
            $object->setIdPriceList($data['idPriceList']);
        }

        if ($this->propertyAvailable('name', $data)) {
            $object->setName($data['name']);
        }

        if ($this->propertyAvailable('price', $data)) {
            $object->setPrice($data['price']);
        }

        if ($this->propertyAvailable('id', $data)) {
            if (empty($data['idPriceList']))
            {
                $object->setIdPriceList($data['id']);
            }
        }

        if ($this->propertyAvailable('status', $data)) {
            $object->setStatus($data['status']);
        }

        if ($this->propertyAvailable('type', $data)) {
            $object->setType($data['type']);
        }

        return $object;
    }

    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof PriceList) {
            return array();
        }
        return $object->toArray();
     }

    protected function propertyAvailable($property, $data)
    {
        return (array_key_exists($property, $data));
    }

}