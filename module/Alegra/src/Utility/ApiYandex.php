<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 01:40 PM
 */

namespace Alegra\Utility;


use Yandex\Translate\Exception;
use Yandex\Translate\Translator;

class ApiYandex implements RealtimeTranslatorInterface
{
    protected $config;
    protected $key;

    /**
     * ApiYandex constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
        $this->key = $config['key'];
    }


    public function translate($message, $locale = null)
    {
        $key = $this->key;

        switch ($locale) {
            case 'en_US':
                $language = 'es-en';
                break;
            case 'es_ES':
                $language = 'en-es';
                break;
            default:
                $language = 'es-en';
                break;
        }

        try {
            $translator = new Translator($key);
            $translation = $translator->translate($message, $language);

            return $translation->getResult()[0];
        } catch (Exception $e) {
            return $message;
        }
    }
}