<?php 

namespace Alegra\Model;

/**
* 
*/
class PriceList 
{
	/**
     * @var string|null
     */
    private $idPriceList;

    /**
     * @var string|null
     */
    private $name;

    /**
     * @var string|null
     */
    private $status;

    /**
     * @var string|null
     */
    private $type;

    /**
     * @var string|null
     */
    private $price;

    /**
     * PriceList constructor.
     * @param null|string $idPriceList
     * @param null|string $name
     * @param null|string $price
     */
    public function __construct($idPriceList = null, $name = null, $status = null, $type = null, $price = null)
    {
        $this->idPriceList = $idPriceList;
        $this->name = $name;
        $this->status = $status;
        $this->type = $type;
        $this->price = $price;
    }


    /**
     * @return string
     */
    public function getIdPriceList()
    {
        return $this->idPriceList;
    }

    /**
     * @param string $idPriceList
     *
     * @return self
     */
    public function setIdPriceList($idPriceList)
    {
        $this->idPriceList = $idPriceList;

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
    public function getPrice()
    {
        return $this->price;
    }

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
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

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