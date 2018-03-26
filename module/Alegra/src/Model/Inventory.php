<?php 

namespace Alegra\Model;

/**
* 
*/
class Inventory
{
	/**
     * @var string|''
     */
    private $unit;

    /**
     * @var string|''
     */
    private $availableQuantity;

    /**
     * @var string|''
     */
    private $unitCost;

    /**
     * @var string|''
     */
    private $initialQuantity;

    /**
     * @var array |''
     */
    private $warehouses;


	/**
	 * Class Constructor
	 * @param string   $unit   |''
	 * @param string   $availableQuantity   |''
	 * @param string   $unitCost   |''
	 * @param string   $initialQuantity   |''
	 * @param Warehouses   $warehouses    |''
	 */
	public function __construct($unit = '', $availableQuantity = '', $unitCost = '', $initialQuantity = '', array $warehouses = array())
	{
		$this->unit = $unit;
		$this->availableQuantity = $availableQuantity;
		$this->unitCost = $unitCost;
		$this->initialQuantity = $initialQuantity;
		$this->warehouses = $warehouses;
	}




    /**
     * @return string|''
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string|'' $unit
     *
     * @return self
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return string|''
     */
    public function getAvailableQuantity()
    {
        return $this->availableQuantity;
    }

    /**
     * @param string|'' $availableQuantity
     *
     * @return self
     */
    public function setAvailableQuantity($availableQuantity)
    {
        $this->availableQuantity = $availableQuantity;

        return $this;
    }

    /**
     * @return string|''
     */
    public function getUnitCost()
    {
        return $this->unitCost;
    }

    /**
     * @param string|'' $unitCost
     *
     * @return self
     */
    public function setUnitCost($unitCost)
    {
        $this->unitCost = $unitCost;

        return $this;
    }

    /**
     * @return string|''
     */
    public function getInitialQuantity()
    {
        return $this->initialQuantity;
    }

    /**
     * @param string|'' $initialQuantity
     *
     * @return self
     */
    public function setInitialQuantity($initialQuantity)
    {
        $this->initialQuantity = $initialQuantity;

        return $this;
    }

    /**
     * @return Warehouses |''
     */
    public function getWarehouses()
    {
        return $this->warehouses;
    }

    /**
     * @param Warehouses |'' $warehouses
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