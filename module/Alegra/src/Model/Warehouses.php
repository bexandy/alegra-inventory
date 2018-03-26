<?php 

namespace Alegra\Model;

use Alegra\Utility\Translatable;
/**
* 
*/
class Warehouses extends Translatable
{
    /**
     * @return ''|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param ''|string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }
	/**
     * @var string|''
     */
    private $id;


    /**
     * @var string|''
     */
    private $name;

    /**
     * @var string|''
     */
    private $observations;

    /**
     * @var boolean|''
     */
    private $isDefault;

    /**
     * @var string|''
     */
    private $address;

    /**
     * @var string|''
     */
    private $initialQuantity;

    /**
     * @var string|''
     */
    private $availableQuantity;

    /**
     * @var string|''
     */
    private $status;


	/**
	 * Class Constructor
	 * @param string   $id   |''
	 * @param string   $name   |''
	 * @param string   $observations   |''
	 * @param boolean   $isDefault   |''
	 * @param string   $address   |''
	 * @param string   $initialQuantity   |''
	 * @param string   $availableQuantity   |''
	 */
	public function __construct($id = '', $name = '', $observations = '', $isDefault = false, $address = '', $initialQuantity = '', $availableQuantity = '', $status = '')
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
     * @return string|''
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string|'' $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|''
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|'' $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|''
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * @param string|'' $observations
     *
     * @return self
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * @return boolean|''
     */
    public function isIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param boolean|'' $isDefault
     *
     * @return self
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * @return string|''
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string|'' $address
     *
     * @return self
     */
    public function setAddress($address)
    {
        $this->address = $address;

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
    
    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {
            $return[$row] = $value;
        }
        return $return;
    }
}