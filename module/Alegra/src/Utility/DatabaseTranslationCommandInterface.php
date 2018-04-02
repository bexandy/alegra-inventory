<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 02:27 PM
 */

namespace Alegra\Utility;


interface DatabaseTranslationCommandInterface
{
    public function addMessage($locale_id, $message_domain, $message_key, $message_translation, $message_plural_index);

    public function getLocaleId($locale);


}