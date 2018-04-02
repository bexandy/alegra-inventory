<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 10:29 PM
 */

namespace Alegra\Plugin;


use Alegra\Utility\CurrencyExchangeRateInterface;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class CurrencyConverterPlugin extends AbstractPlugin
{
    protected $rate;
    protected $currencyExchangeRate;
    /**
 * CurrencyConverterPlugin constructor.
 * @param $currencyExchangeRate
 */
    public function __construct(CurrencyExchangeRateInterface $currencyExchangeRate)
    {
        $this->currencyExchangeRate = $currencyExchangeRate;
        $this->rate = $currencyExchangeRate->getExchangeRate();
    }

    public function convertCOPtoUSD($amount)
    {
        $converted = $amount / $this->rate;
        return $converted;
    }

    public function convertUSDtoCOP($amount)
    {
        $converted = $amount * $this->rate;
        return $converted;
    }

}