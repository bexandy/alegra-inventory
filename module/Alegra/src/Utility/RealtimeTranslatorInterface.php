<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 02:08 PM
 */

namespace Alegra\Utility;


interface RealtimeTranslatorInterface
{
    public function translate($message, $locale);
}