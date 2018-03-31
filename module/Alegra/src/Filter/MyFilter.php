<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 29/03/18
 * Time: 07:09 PM
 */

namespace Alegra\Filter;


use Zend\Filter\Exception;
use Zend\Filter\FilterInterface;

class MyFilter implements FilterInterface
{
    public function filter($value)
    {
        // TODO: Implement filter() method.
        switch (true) {
            case is_bool($value):
                return $value;
                break;
            case is_null($value):
                return '';
                break;
            case ($value === ''):
                return null;
                break;
            case empty($value):
                return '';
                break;
            case is_array($value):
                return array_filter($value);
                break;
            default:
                return $value;
        }
    }
}