<?php

namespace Alegra\Controller;

use Alegra\Model\Category;
use Alegra\Model\CategoryRepositoryInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class CategoryController extends AbstractRestfulController
{
	/**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    private function notFound()
    {
        $this->getResponse()->setStatusCode(404);
        return new JsonModel([
            'success' => false,
            'message' => 'Not found'
        ]);
    }


    public function getList()
    {
        $categories = $this->categoryRepository->findAllCategories();
        //var_dump($categories);
        $array = $categories->toArray();
        $json = new JsonModel([
            'success' => true,
            'data' => $array
        ]);
        //var_dump($json);
        return $json;
    }


    public function get($id)
    {

        $category = $this->categoryRepository->findCategory($id);

        if ($category instanceof Category) {
            $array = $category->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $array
            ]);
        }
        else {
            return $this->notFound(); // Return a 404 if the category is not found
        }
    }

}