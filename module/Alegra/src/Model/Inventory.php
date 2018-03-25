<?php 

namespace Alegra\Model;

/**
* 
*/
class Inventory
{
	/**
     * @var string|null
     */
    private $unit;

    /**
     * @var string|null
     */
    private $availableQuantity;

    /**
     * @var string|null
     */
    private $unitCost;

    /**
     * @var string|null
     */
    private $initialQuantity;

    /**
     * @var array |null
     */
    private $warehouses;


	/**
	 * Class Constructor
	 * @param string   $unit   |null
	 * @param string   $availableQuantity   |null
	 * @param string   $unitCost   |null
	 * @param string   $initialQuantity   |null
	 * @param Warehouses   $warehouses    |null
	 */
	public function __construct($unit = null, $availableQuantity = null, $unitCost = null, $initialQuantity = null, array $warehouses = null)
	{
		$this->unit = $unit;
		$this->availableQuantity = $availableQuantity;
		$this->unitCost = $unitCost;
		$this->initialQuantity = $initialQuantity;
		$this->warehouses = $warehouses;
	}




    /**
     * @return string|null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     *
     * @return self
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    /**
     * @param string|null $availableQuantity
     *
     * @return self
     */
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnitCost()
    {
        return $this->unitCost;
    }

    /**
     * @param string|null $unitCost
     *
     * @return self
     */
    public function setUnitCost($unitCost)
    {
        $this->unitCost = $unitCost;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getInitialQuantity()
    {
        return $this->initialQuantity;
    }

    /**
     * @param string|null $initialQuantity
     *
     * @return self
     */
    public function setInitialQuantity($initialQuantity)
    {
        $this->initialQuantity = $initialQuantity;

        return $this;
    }

    /**
     * @return Warehouses |null
     */
    public function getWarehouses()
    {
        return $this->warehouses;
    }

    /**
     * @param Warehouses |null $warehouses
     *
     * @return self
     */
    public function setWarehouses(array $warehouses)
    {
        $this->warehouses = $warehouses;

        return $this;
    }

    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {

            switch(true) {  
                case $value instanceof Warehouses:
                    $return[$row] = $value->toArray();
                    break;
                case is_array($value):
                    $count = 0;
                    foreach ($value as $item)
                    {
                        if ($item instanceof Warehouses)
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