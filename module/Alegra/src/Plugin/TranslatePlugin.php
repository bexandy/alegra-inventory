<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 27/03/18
 * Time: 12:35 PM
 */

namespace Alegra\Plugin;


use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\Mvc\I18n\Translator;

class TranslatePlugin extends AbstractPlugin
{
    /**
     * @var Translator
     */
    protected $translator;

    protected $config;

    /**
     * TranslatePlugin constructor.
     * @param Translator $translator
     */
    public function __construct(Translator $translator, $config)
    {
        $this->translator = $translator;
        $this->config = $config;
    }

    public function translate($message, $textDomain = 'default', $locale = null)
    {
        return $this->translator->translate($message, $textDomain, $locale);
    }

    public function toEnglish($data)
    {
        foreach ($data as $row => $value) {

            if (is_null($value) || $value == '') {
                $data[$row] = $value;
            } elseif (is_array($value)){
                $data[$row] = $this->toEnglish($value);
            } elseif (in_array($row, $this->config['prices'])) {
                $price = ($value) / ($this->config['convert_currency']['rate']);
                $data[$row] = number_format($price,2,'.','');
            } else {
                $data[$row] = in_array($row, $this->config['strings']) && !is_array($value) ? $this->translate($value) : $value;
            }

        }
        return $data;
    }

    public function toSpanish($data)
    {
        foreach ($data as $row => $value) {

            if (is_null($value) || $value == '') {
                $data[$row] = $value;
            } elseif (is_array($value)){
                $data[$row] = $this->toSpanish($value);
            } elseif (in_array($row, $this->config['prices'])) {
                $price = ($value) * ($this->config['convert_currency']['rate']);
                $data[$row] = number_format($price,2,'.','');
            } else {
                $data[$row] = in_array($row, $this->config['strings']) && !is_array($value) ? $this->translate($value, 'default', 'es_ES') : $value;
            }

        }
        return $data;
    }
}