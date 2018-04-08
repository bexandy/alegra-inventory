<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 06/04/18
 * Time: 06:39 PM
 */

namespace Alegra\Utility;


interface DbCurrencyCommandInterface
{
    public function addRate($rate);

    public function getExchangeRate();

    public function updateExchangeRate($rate);
}