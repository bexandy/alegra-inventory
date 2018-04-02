<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 01/04/18
 * Time: 02:33 PM
 */

namespace Alegra\Utility;


use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Exception\RuntimeException;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;

class DatabaseTranslationCommand implements DatabaseTranslationCommandInterface
{
    protected $dbAdapter;

    /**
     * DatabaseTranslationCommand constructor.
     * @param $dbAdapter
     */
    public function __construct($dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function addMessage($locale_id, $message_domain, $message_key, $message_translation, $message_plural_index)
    {
        // TODO: Implement addMessage() method.
        $insert = new Insert('messages');
        $insert->values([
            'locale_id' => $locale_id,
            'message_domain' => $message_domain,
            'message_key' => $message_key,
            'message_translation' => $message_translation,
            'message_plural_index' => $message_plural_index
        ]);

        $sql = new Sql($this->dbAdapter);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new RuntimeException(
                'Database error occurred during database translation insert operation'
            );
        }

        return $result->valid();
    }

    public function getLocaleId($locale)
    {
        // TODO: Implement getLocaleId() method.
    }

}