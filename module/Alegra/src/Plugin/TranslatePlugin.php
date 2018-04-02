<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 27/03/18
 * Time: 12:35 PM
 */

namespace Alegra\Plugin;


use Alegra\Utility\DatabaseTranslationCommandInterface;
use Alegra\Utility\MyTranslator;
use Alegra\Utility\RealtimeTranslatorInterface;
use Zend\I18n\Translator\Translator;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;


class TranslatePlugin extends AbstractPlugin
{
    /**
     * @var Translator
     */
    protected $translator;

    protected $config;

    protected $realtimeTranslator;

    protected $databaseTranslationCommand;

    /**
     * TranslatePlugin constructor.
     * @param Translator $translator
     */
    public function __construct(MyTranslator $translator, $config, RealtimeTranslatorInterface $realtimeTranslator, DatabaseTranslationCommandInterface $databaseTranslationCommand)
    {
        $this->translator = $translator;
        $this->config = $config;
        $this->realtimeTranslator = $realtimeTranslator;
        $this->databaseTranslationCommand = $databaseTranslationCommand;
    }

    public function translate($message, $textDomain = 'default', $locale = null)
    {
        if (is_null($locale))
        {
            $locale = 'es_ES';
        }

        $translation = $this->translator->translate($message, $textDomain, $locale);


        if ($translation === $message) {
            $messages = $this->translator->getAllMessages($textDomain, $locale);
            if (! isset($messages[$message]))
            {
                $translation = $this->realtimeTranslator->translate($message, $locale);

                $this->databaseTranslationCommand->addMessage($locale, $textDomain, $message, $translation, 0);
                $this->translator->reloadMessages($textDomain, $locale);

                $alt_Locale = ($locale === 'en_US') ? 'es_ES' : 'en_US';
                $this->databaseTranslationCommand->addMessage($alt_Locale, $textDomain, $translation, $message, 0);
                $this->translator->reloadMessages($textDomain, $alt_Locale);
            }
        }
        return $translation;
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
                $data[$row] = in_array($row, $this->config['strings']) && !is_array($value) ? $this->translate($value, 'default', 'en_US') : $value;
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