<?php 

namespace Alegra\Model;

interface ProductCommandInterface
{
    /**
     * Persist a new product in the system.
     *
     * @param Product $product The product to insert; may or may not have an identifier.
     * @return Product The inserted product, with identifier.
     */
    public function insertProduct(Product $product);

    /**
     * Update an existing product in the system.
     *
     * @param Product $product The product to update; must have an identifier.
     * @return Product The updated product.
     */
    public function updateProduct(Product $product);

    /**
     * Delete a product from the system.
     *
     * @param Product $product The product to delete.
     * @return bool
     */
    public function deleteProduct(Product $product);
}