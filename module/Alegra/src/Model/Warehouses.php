<?php 

namespace Alegra\Model;

/**
* 
*/
class Warehouses
{
    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param null|string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
	/**
     * @var string|null
     */
    private $id;


    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $observations;

    /**
     * @var boolean|null
     */
    private $isDefault;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var string|null
     */
    private $initialQuantity;

    /**
     * @var string|null
     */
    private $availableQuantity;

    /**
     * @var string|null
     */
    private $status;


	/**
	 * Class Constructor
	 * @param string   $id   |null
	 * @param string   $name   |null
	 * @param string   $observations   |null
	 * @param boolean   $isDefault   |null
	 * @param string   $address   |null
	 * @param string   $initialQuantity   |null
	 * @param string   $availableQuantity   |null
	 */
	public function __construct($id = null, $name = null, $observations = null, $isDefault = false, $address = null, $initialQuantity = null, $availableQuantity = null, $status = null)
	{
		$this->id = $id;
		$this->name = $name;
		$this->observations = $observations;
		$this->isDefault = $isDefault;
		$this->address = $address;
		$this->initialQuantity = $initialQuantity;
		$this->availableQuantity = $availableQuantity;
        $this->status = $status;
	}



    /**
     * @return string|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param string|null $observations
     *
     * @return self
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * @return boolean|null
     */
    public function isIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param boolean|null $isDefault
     *
     * @return self
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
    
    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {
            $return[$row] = $value;
        }
        return $return;
    }
}