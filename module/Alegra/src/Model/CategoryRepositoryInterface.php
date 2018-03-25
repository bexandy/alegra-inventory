<?php 

namespace Alegra\Model;

interface CategoryRepositoryInterface
{
    /**
     * Return a set of all categories that we can iterate over.
     *
     * Each entry should be a Category instance.
     *
     * @return Category
     */
    public function findAllCategories();

    /**
     * Return a single category.
     *
     * @param  int $id Identifier of the category to return.
     * @return Category
     */
    public function findCategory($id);
}