<?php 

namespace Alegra\Model;

interface TaxRepositoryInterface
{
    /**
     * Return a set of all taxes that we can iterate over.
     *
     * Each entry should be a taxes instance.
     *
     * @return Tax
     */
    public function findAllTaxes();

    /**
     * Return a single tax.
     *
     * @param  int $id Identifier of the tax to return.
     * @return Tax
     */
    public function findTax($id);
}