<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 21/03/18
 * Time: 11:21 AM
 */
namespace Alegra\Hydrator;

use Alegra\Model\Product;
use Alegra\Model\PriceList;
use Alegra\Model\Tax;
use Alegra\Model\Category;
use Alegra\Model\Inventory;
use Zend\Hydrator\HydratorInterface;

class ProductHydrator implements HydratorInterface
{
    private $childHydrator;

    private $childEntity;


    /**
     * Class Constructor
     * @param    $childHydrator  
     * @param    $childEntity   
     */
    public function __construct()
    {
        $this->childHydrator['price'] = new PriceListHydrator;
        $this->childEntity['price'] = new PriceList();
        $this->childHydrator['tax'] = new TaxHydrator;
        $this->childEntity['tax'] = new Tax();
        $this->childHydrator['category'] = new CategoryHydrator;
        $this->childEntity['category'] = new Category();
        $this->childHydrator['inventory'] = new InventoryHydrator;
        $this->childEntity['inventory'] = new Inventory();
    }



    public function extract($object)
    {
        // TODO: Implement extract() method.
        if (! $object instanceof Product) {
            return $object;
        }
        return $object->toArray();
    }

    public function hydrate(array $data, $object)
    {
        // TODO: Implement hydrate() method.
        if (! $object instanceof Product) {
            return $object;
        }

        if ($this->propertyAvailable('id', $data)) {
            $object->setId($data['id']);
        }

        if ($this->propertyAvailable('name', $data)) {
            $object->setName($data['name']);
        }

        if ($this->propertyAvailable('description', $data)) {
            $object->setDescription($data['description']);
        }

        if ($this->propertyAvailable('reference', $data)) {
            $object->setReference($data['reference']);
        }

        if ($this->propertyAvailable('status', $data)) {
            $object->setStatus($data['status']);
        }

        if ($this->propertyAvailable('productKey', $data)) {
            $object->setProductKey($data['productKey']);
        }

        if ($this->propertyAvailable('price', $data)) {
            $priceList = [];
            foreach ($data['price'] as $price)
            {
                $priceList[] = $this->childHydrator['price']->hydrate(
                                    $price,
                                    $this->childEntity['price']
                                );
            }
            $object->setPrice($priceList);
        }

        if ($this->propertyAvailable('tax', $data)) {
            $taxArray = [];
            foreach ($data['tax'] as $tax)
            {
                $taxArray[] = $this->childHydrator['tax']->hydrate(
                                    $tax,
                                    $this->childEntity['tax']
                                );
            }
            $object->setTax($taxArray);
        }

        if ($this->propertyAvailable('category', $data)) {
            $object->setCategory(
                $this->childHydrator['category']->hydrate(
                    $data['category'], 
                    $this->childEntity['category']
                )
            );
        }

        if ($this->propertyAvailable('inventory', $data)) {
            $object->setInventory(
                $this->childHydrator['inventory']->hydrate(
                    $data['inventory'], 
                    $this->childEntity['inventory']
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