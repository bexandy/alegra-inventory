<?php

namespace Alegra\Controller;

use Alegra\Model\Warehouses;
use Alegra\Model\WarehousesRepositoryInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class WarehousesController extends AbstractRestfulController
{
	/**
     * @var WarehousesRepositoryInterface
     */
    private $warehousesRepository;

    public function __construct(WarehousesRepositoryInterface $warehousesRepository)
    {
        $this->warehousesRepository = $warehousesRepository;
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
        $warehouses = $this->warehousesRepository->findAllWarehouses();
        if ($warehouses instanceof HydratingResultSet)
        {
            $array = $warehouses->toArray();
            $data = $this->translator()->toEnglish($array);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($warehouses);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }


    public function get($id)
    {

        $warehouse = $this->warehousesRepository->findWarehouse($id);

        if ($warehouse instanceof Warehouses) {
            $array = $warehouse->toArray();
            $data = $this->translator()->toEnglish($array);
            $json = new JsonModel([
                'success' => true,
                'data' => $array
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($warehouse);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }

}