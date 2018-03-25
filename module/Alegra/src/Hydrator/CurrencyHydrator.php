<?php

namespace Alegra\Hydrator;


use Alegra\Model\Currency;
use Zend\Hydrator\HydratorInterface;

class CurrencyHydrator implements HydratorInterface
{
    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Currency) {
            return $object;
        }

        if ($this->propertyAvailable('code', $data)) {
            $object->setCode($data['code']);
        }

        if ($this->propertyAvailable('symbol', $data)) {
            $object->setSymbol($data['symbol']);
        }

        if ($this->propertyAvailable('exchangeRate', $data)) {
            $object->setExchangeRate($data['exchangeRate']);
        }

        return $object;
    }

    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Currency) {
            return array();
        }
        return $object->toArray();
     }

    protected function propertyAvailable($property, $data)
    {
        return (array_key_exists($property, $data)
            && !empty($data[$property]));
    }

}