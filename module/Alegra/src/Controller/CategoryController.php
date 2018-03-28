<?php

namespace Alegra\Controller;

use Alegra\Model\Category;
use Alegra\Model\CategoryRepositoryInterface;
use Zend\Db\ResultSet\HydratingResultSet;
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
        if ($categories instanceof HydratingResultSet)
        {
            $array = $categories->toArray();
            $data = $this->translator()->toEnglish($array);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($categories);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }


    public function get($id)
    {

        $category = $this->categoryRepository->findCategory($id);

        if ($category instanceof Category) {
            $array = $category->toArray();
            $data = $this->translator()->toEnglish($array);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($category);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }

}