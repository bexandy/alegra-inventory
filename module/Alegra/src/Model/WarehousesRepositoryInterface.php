<?php 

namespace Alegra\Model;

interface WarehousesRepositoryInterface
{
    /**
     * Return a set of all warehouses that we can iterate over.
     *
     * Each entry should be a Warehouses instance.
     *
     * @return Warehouses
     */
    public function findAllWarehouses();

    /**
     * Return a single warehouse.
     *
     * @param  int $id Identifier of the warehouse to return.
     * @return Warehouses
     */
    public function findWarehouse($id);
}