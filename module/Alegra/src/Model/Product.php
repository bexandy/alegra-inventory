<?php 

namespace Alegra\Model;

/**
* 
*/
class Product
{
	/**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $reference;

    /**
     * @var PriceList
     */
    private $price;

    /**
     * @var Tax
     */
    private $tax;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var Inventory
     */
    private $inventory;

    /**
     * @var string
     */
    private $status;

    /**
     * @var ''|string
     */
    private $productKey;


	/**
	 * Class Constructor
	 * @param int   $id   
	 * @param string   $name   
	 * @param string   $description   
	 * @param string   $reference   
	 * @param array   $priceList 
	 * @param array   $taxArray
	 * @param Category $category   
	 * @param Inventory $inventory   
	 * @param string   $status   
	 * @param ''   $productKey   |string
	 */
	public function __construct($id = '', $name = '', $description = '', $reference = '', array $priceLists = array(), array $taxArray = array(), Category $category = null, Inventory $inventory = null, $status = '', $productKey = '')
	{
		$this->id = $id;
		$this->name = $name;
		$this->description = $description;
		$this->reference = $reference;
		$this->price = $priceLists;
		$this->tax = $taxArray;
        $this->category = $category;
		$this->inventory = $inventory;
		$this->status = $status;
		$this->productKey = $productKey;
	}

    
	
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     *
     * @return self
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * @return PriceList
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param PriceList $price
     *
     * @return self
     */
    public function setPrice(array $priceLists)
    {
        $this->price = $priceLists;

        return $this;
    }

    /**
     * @return Tax
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param Tax $tax
     *
     * @return self
     */
    public function setTax(array $taxArray)
    {
        $this->tax = $taxArray;

        return $this;
    }

    /**
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param Category $category
     *
     * @return self
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;
        
        return $this;
    }

    /**
     * @return Inventory
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * @param Inventory $inventory
     *
     * @return self
     */
    public function setInventory(Inventory $inventory)
    {
        $this->inventory = $inventory;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return ''|string
     */
    public function getProductKey()
    {
        return $this->productKey;
    }

    /**
     * @param ''|string $productKey
     *
     * @return self
     */
    public function setProductKey($productKey)
    {
        $this->productKey = $productKey;

        return $this;
    }

    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {

            switch(true) {  
                case $value instanceof Category:
                    $return[$row] = $value->toArray();
                    break;
                case $value instanceof PriceList:
                    $return[$row] = $value->toArray();
                    break;
                case $value instanceof Tax:
                    $return[$row] = $value->toArray();
                    break;
                case $value instanceof Inventory:
                    $return[$row] = $value->toArray();
                    break;
                case is_array($value):
                    $count = 0;
                    foreach ($value as $item)
                    {
                        if ($item instanceof PriceList)
                        {
                            $return[$row][$count] = $item->toArray();
                            $count++;
                        }

                        if ($item instanceof Tax)
                        {
                            $return[$row][$count] = $item->toArray();
                            $count++;
                        }
                    }
                    break;
                default: 
                    $return[$row] = $value;
            }
        }
        return $return;
    }
}