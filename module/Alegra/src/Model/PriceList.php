<?php 

namespace Alegra\Model;

/**
* 
*/
class PriceList 
{
	/**
     * @var string|''
     */
    private $idPriceList;

    /**
     * @var string|''
     */
    private $name;

    /**
     * @var string|''
     */
    private $status;

    /**
     * @var string|''
     */
    private $type;

    /**
     * @var string|''
     */
    private $price;

    /**
     * PriceList constructor.
     * @param ''|string $idPriceList
     * @param ''|string $name
     * @param ''|string $price
     */
    public function __construct($idPriceList = '', $name = '', $status = '', $type = '', $price = '')
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
     * @return ''|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param ''|string $type
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