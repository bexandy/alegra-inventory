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
    protected $dbCurrencyCommand;
    protected $interval;

    /**
     * ApiCurrencyLayer constructor.
     * @param $config
     */
    public function __construct($config, DbCurrencyCommandInterface $dbCurrencyCommand)
    {
        $this->config = $config;
        $this->endpoint = $config['endpoint'];
        $this->accessKey = $config['access_key'];
        $this->currencies = $config['currencies'];
        $this->dbCurrencyCommand = $dbCurrencyCommand;
        $this->interval = $config['interval'];
    }

    public function getExchangeRate()
    {
        $exchangerate = $this->dbCurrencyCommand->getExchangeRate();

        $update = $exchangerate['update_date'];

        $updateTime = new \DateTime($update);

        $now = new \DateTime("now");

        $diff = $updateTime->diff($now);

        $time = $diff->format('%H');

        $interval = $this->interval;

        if ($time > $interval) {
            $this->dbCurrencyCommand->updateExchangeRate($this->ApiExchangeRate());
            $exchangerate = $this->dbCurrencyCommand->getExchangeRate();
        }

        $rate = $exchangerate['rate'];

        return $rate;

    }

    public function getDbRate()
    {
        $rate = '2700';

        return $rate;
    }

    public function ApiExchangeRate()
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