<?php 

namespace Alegra\Model;

interface ProductRepositoryInterface
{
    /**
     * Return a set of all products that we can iterate over.
     *
     * Each entry should be a Product instance.
     *
     * @return Product
     */
    public function findAllProducts();

    /**
     * Return a single product.
     *
     * @param  int $id Identifier of the post to return.
     * @return Product
     */
    public function findProduct($id);
}