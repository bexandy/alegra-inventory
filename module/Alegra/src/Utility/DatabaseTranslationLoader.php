<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 31/03/18
 * Time: 01:49 AM
 */

namespace Alegra\Utility;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface as DbAdapter;
use Zend\Db\Sql\Sql;
use Zend\I18n\Translator\Loader\RemoteLoaderInterface;
use Zend\I18n\Translator\Plural\Rule as PluralRule;
use Zend\I18n\Translator\TextDomain;

class DatabaseTranslationLoader implements RemoteLoaderInterface
{
    protected $dbAdapter;

    /**
     * DatabaseTranslationLoader constructor.
     * @param $dbAdapter
     */
    public function __construct(DbAdapter $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function load($locale, $textDomain)
    {
        // TODO: Implement load() method.

        $textDomainClass = new TextDomain();
        $sql        = new Sql($this->dbAdapter);

        $select = $sql->select();
        $select->from('locales');
        $select->columns(array('locale_plural_forms'));
        $select->where(array('locale_id' => $locale));

        $localeInformation = $this->dbAdapter->query(
            $sql->getSqlStringForSqlObject($select),
            Adapter::QUERY_MODE_EXECUTE
        );

        if (!count($localeInformation)) {
            return $textDomain;
        }

        //$localeInformation = reset($localeInformation);
        $localeInformation = $localeInformation->toArray();

        $textDomainClass->setPluralRule(
            PluralRule::fromString($localeInformation[0]['locale_plural_forms'])
        );

        $select = $sql->select();
        $select->from('messages');
        $select->columns(array(
            'message_key',
            'message_translation',
            'message_plural_index'
        ));
        $select->where(array(
            'locale_id'      => $locale,
            'message_domain' => $textDomain
        ));

        $messages = $this->dbAdapter->query(
            $sql->getSqlStringForSqlObject($select),
            Adapter::QUERY_MODE_EXECUTE
        );

        foreach ($messages as $message) {
            $message = $message->getArrayCopy();
            if (isset($textDomainClass[$message['message_key']])) {
                if (!is_array($textDomainClass[$message['message_key']])) {
                    $textDomainClass[$message['message_key']] = array(
                        $message['message_plural_index'] => $textDomainClass[$message['message_key']]
                    );
                }

                $textDomainClass[$message['message_key']][$message['message_plural_index']]
                    = $message['message_translation'];
            } else {
                $textDomainClass[$message['message_key']] = $message['message_translation'];
            }
        }

        return $textDomainClass;
    }


}