<?php 

namespace Alegra\Model;


class Company
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $identification;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string
     */
    private $website;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $regime;

    /**
     * @var Currency
     */
    private $currency;

    /**
     * @var boolean
     */
    private $multicurrency;

    /**
     * @var object
     */
    private $address;

    /**
     * @var int
     */
    private $decimalPrecision;

    /**
     * @var object
     */
    private $invoicePreferences;

    /**
     * @var string
     */
    private $applicationVersion;

    /**
     * @var string
     */
    private $registryDate;

    /**
     * @var string
     */
    private $logo;

    /**
     * @var string
     */
    private $timezone;

	/**
	 * Class Constructor
	 * @param string   $name   
	 * @param string   $identification   
	 * @param string   $phone   
	 * @param string   $website   
	 * @param string   $email   
	 * @param string   $regime   
	 * @param Currency   $currency   
	 * @param boolean   $multicurrency   
	 * @param object   $address   
	 * @param int   $decimalPrecision   
	 * @param object   $invoicePreferences   
	 * @param string   $applicationVersion   
	 * @param string   $registryDate   
	 * @param string   $logo   
	 * @param string   $timezone   
	 */
	public function __construct($name = null, $identification = null, $phone = null, $website = null, $email = null, $regime = null, Currency $currency = null, $multicurrency = null, $address = null, $decimalPrecision = null, $invoicePreferences = null, $applicationVersion = null, $registryDate = null, $logo = null, $timezone = null)
	{
		$this->name = $name;
		$this->identification = $identification;
		$this->phone = $phone;
		$this->website = $website;
		$this->email = $email;
		$this->regime = $regime;
		$this->currency = $currency;
		$this->multicurrency = $multicurrency;
		$this->address = $address;
		$this->decimalPrecision = $decimalPrecision;
		$this->invoicePreferences = $invoicePreferences;
		$this->applicationVersion = $applicationVersion;
		$this->registryDate = $registryDate;
		$this->logo = $logo;
		$this->timezone = $timezone;
	}


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getRegime()
    {
        return $this->regime;
    }

    /**
     * @return object
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return boolean
     */
    public function isMulticurrency()
    {
        return $this->multicurrency;
    }

    /**
     * @return object
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getDecimalPrecision()
    {
        return $this->decimalPrecision;
    }

    /**
     * @return object
     */
    public function getInvoicePreferences()
    {
        return $this->invoicePreferences;
    }

    /**
     * @return string
     */
    public function getApplicationVersion()
    {
        return $this->applicationVersion;
    }

    /**
     * @return string
     */
    public function getRegistryDate()
    {
        return $this->registryDate;
    }

    /**
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $identification
     */
    public function setIdentification(string $identification)
    {
        $this->identification = $identification;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param string $website
     */
    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * @param string $regime
     */
    public function setRegime(string $regime)
    {
        $this->regime = $regime;
    }

    /**
     * @param Currency $currency
     */
    public function setCurrency(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * @param bool $multicurrency
     */
    public function setMulticurrency(bool $multicurrency)
    {
        $this->multicurrency = $multicurrency;
    }

    /**
     * @param object $address
     */
    public function setAddress(object $address)
    {
        $this->address = $address;
    }

    /**
     * @param int $decimalPrecision
     */
    public function setDecimalPrecision(int $decimalPrecision)
    {
        $this->decimalPrecision = $decimalPrecision;
    }

    /**
     * @param object $invoicePreferences
     */
    public function setInvoicePreferences(object $invoicePreferences)
    {
        $this->invoicePreferences = $invoicePreferences;
    }

    /**
     * @param string $applicationVersion
     */
    public function setApplicationVersion(string $applicationVersion)
    {
        $this->applicationVersion = $applicationVersion;
    }

    /**
     * @param string $registryDate
     */
    public function setRegistryDate(string $registryDate)
    {
        $this->registryDate = $registryDate;
    }

    /**
     * @param string $logo
     */
    public function setLogo(string $logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param string $timezone
     */
    public function setTimezone(string $timezone)
    {
        $this->timezone = $timezone;
    }



    public function toArray()
    {
        $return = [];
        foreach ($this as $row => $value) {

            if ($value instanceof Currency)
            {
                $return[$row] = $value->toArray();
            } else {
                $return[$row] = $value;
            }

        }
        return $return;
    }

}