<?php 

namespace Alegra\Model;

/**
* 
*/
class Currency
{
	
	/**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $symbol;

    /**
     * @var string
     */
    private $exchangeRate;


	/**
	 * Class Constructor
	 * @param string   $code   
	 * @param string   $symbol   
	 * @param string   $exchangeRate   
	 */
	public function __construct($code = null, $symbol = null, $exchangeRate = null)
	{
		$this->code = $code;
		$this->symbol = $symbol;
		$this->exchangeRate = $exchangeRate;
	}
	

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @param string $symbol
     *
     * @return self
     */
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;

        return $this;
    }

    /**
     * @return string
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * @param string $exchangeRate
     *
     * @return self
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

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