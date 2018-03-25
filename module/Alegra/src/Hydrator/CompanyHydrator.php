<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 21/03/18
 * Time: 11:21 AM
 */
namespace Alegra\Hydrator;

use Alegra\Model\Company;
use Alegra\Model\Currency;
use Zend\Hydrator\HydratorInterface;

class CompanyHydrator implements HydratorInterface
{
    private $childHydrator;

    private $childEntity;


    /**
     * Class Constructor
     * @param    $currencyHydrator   
     */
    public function __construct()
    {
        $this->childHydrator = new CurrencyHydrator;
        $this->childEntity = new Currency();
    }



    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Company) {
            return $object;
        }
        return $object->toArray();
    }

    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Company) {
            return $object;
        }

        if ($this->propertyAvailable('name', $data)) {
            $object->setName($data['name']);
        }

        if ($this->propertyAvailable('identification', $data)) {
            $object->setIdentification($data['identification']);
        }

        if ($this->propertyAvailable('phone', $data)) {
            $object->setPhone($data['phone']);
        }

        if ($this->propertyAvailable('website', $data)) {
            $object->setWebsite($data['website']);
        }

        if ($this->propertyAvailable('email', $data)) {
            $object->setEmail($data['email']);
        }

        if ($this->propertyAvailable('regime', $data)) {
            $object->setRegime($data['regime']);
        }

        if ($this->propertyAvailable('multicurrency', $data)) {
            $object->setMulticurrency($data['multicurrency']);
        }

        if ($this->propertyAvailable('decimalPrecision', $data)) {
            $object->setDecimalPrecision($data['decimalPrecision']);
        }

        if ($this->propertyAvailable('applicationVersion', $data)) {
            $object->setApplicationVersion($data['applicationVersion']);
        }

        if ($this->propertyAvailable('registryDate', $data)) {
            $object->setRegistryDate($data['registryDate']);
        }

        if ($this->propertyAvailable('logo', $data)) {
            $object->setLogo($data['logo']);
        }

        if ($this->propertyAvailable('timezone', $data)) {
            $object->setTimeZone($data['timezone']);
        }

        if ($this->propertyAvailable('currency', $data)) {
            $object->setCurrency(
                $this->childHydrator->hydrate(
                    $data['currency'], 
                    $this->childEntity
                )
            );
        }

        return $object;
    }

    protected function propertyAvailable($property, $data)
    {
        return (array_key_exists($property, $data)
            && !empty($data[$property]));
    }

}