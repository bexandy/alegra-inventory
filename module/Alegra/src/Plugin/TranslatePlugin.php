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

    public function translate($string)
    {
        return $this->translator->translate($string);
    }

    public function toEnglish($data)
    {
        foreach ($data as $row => $value) {

            if (is_null($value) || $value == '') {
                $data[$row] = $value;
            } elseif (is_array($value)){
                $data[$row] = $this->ToEnglish($value);
            } elseif (in_array($row, $this->config['prices'])) {
                $data[$row] = $value / $this->config['convert_currency']['rate'];
            } else {
                $data[$row] = in_array($row, $this->config['strings']) && !is_array($value) ? $this->translate($value) : $value;
            }

        }
        return $data;
    }
}