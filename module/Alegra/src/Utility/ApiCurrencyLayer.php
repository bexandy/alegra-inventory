<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 10:39 PM
 */

namespace Alegra\Utility;


class ApiCurrencyLayer implements CurrencyExchangeRateInterface
{
    protected $config;
    protected $endpoint;
    protected $accessKey;
    protected $currencies;

    /**
     * ApiCurrencyLayer constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->endpoint = $config['endpoint'];
        $this->accessKey = $config['access_key'];
        $this->currencies = $config['currencies'];
    }

    public function getExchangeRate()
    {
        // TODO: Implement getExchangeRate() method.
        // set API Endpoint, access key, required parameters
        $endpoint = $this->endpoint;
        $access_key = $this->accessKey;

        $currencies = $this->currencies;

        // initialize CURL:
        $ch = curl_init($this->config['api_url'].$endpoint.'?access_key='.$access_key.'&currencies='.$currencies.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // get the (still encoded) JSON data:
        try {
            $json = curl_exec($ch);
            curl_close($ch);

            // Decode JSON response:
            $conversionResult = json_decode($json, true);

            // access the conversion result
            return $conversionResult['quotes']['USDCOP'];
        } catch (\Exception $e) {
            return $this->config['rate'];
        }

    }


}