<?php 

namespace Alegra\Model;

interface PriceListRepositoryInterface
{
    /**
     * Return a set of all pricelists that we can iterate over.
     *
     * Each entry should be a PriceList instance.
     *
     * @return PriceList
     */
    public function findAllPriceLists();

    /**
     * Return a single pricelist.
     *
     * @param  int $id Identifier of the pricelist to return.
     * @return PriceList
     */
    public function findPriceList($id);
}