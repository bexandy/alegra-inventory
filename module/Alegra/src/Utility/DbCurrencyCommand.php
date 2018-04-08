<?php
/**
 * Created by PhpStorm.
 * User: brodriguez
 * Date: 06/04/18
 * Time: 06:33 PM
 */

namespace Alegra\Utility;


use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\Sql\Insert;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Update;

class DbCurrencyCommand implements DbCurrencyCommandInterface
{
    protected $dbAdapter;

    public function __construct( AdapterInterface $dbAdapter)
    {
        $this->dbAdapter = $dbAdapter;
    }

    public function addRate($rate)
    {
        $insert = new Insert('exchangerate');
        $now = new \DateTime("now");
        $now = $now->format('Y-m-d H:i');
        $insert->values([
            'rate' => $rate,
            'update_date' => $now,
        ]);

        $sql = new Sql($this->dbAdapter);

        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new \RuntimeException(
                'Database error occurred during database exchange insert operation'
            );
        }

        return $result->valid();
    }

    public function getExchangeRate()
    {
        $sql = new Sql($this->dbAdapter);

        $select = $sql->select();
        $select->from('exchangerate');

        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new \RuntimeException(
                'Database error occurred during database exchange select operation'
            );
        }

        return $result->current();
    }

    public function updateExchangeRate($rate)
    {
        $update = new Update('exchangerate');
        $now = new \DateTime("now");
        $now = $now->format('Y-m-d H:i');
        $update->set([
            'rate' => $rate,
            'update_date' => $now,
        ]);

        //$update->where([1 = 1]);

        $sql = new Sql($this->dbAdapter);

        $statement = $sql->prepareStatementForSqlObject($update);
        $result = $statement->execute();

        if (! $result instanceof ResultInterface) {
            throw new \RuntimeException(
                'Database error occurred during database exchange insert operation'
            );
        }

        return $result->valid();
    }

}