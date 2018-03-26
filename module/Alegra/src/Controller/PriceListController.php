<?php

namespace Alegra\Controller;

use Alegra\Model\PriceList;
use Alegra\Model\PriceListRepositoryInterface;
use Alegra\Utility\Translatable;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\ResultSet\ResultSet;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class PriceListController extends AbstractRestfulController
{
	/**
     * @var PriceListRepositoryInterface
     */
    private $priceListRepository;

    public function __construct(PriceListRepositoryInterface $priceListRepository)
    {
        $this->priceListRepository = $priceListRepository;
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
        $priceLists = $this->priceListRepository->findAllPriceLists();

        if ($priceLists instanceof HydratingResultSet)
        {

            $test = $priceLists->toArray();

            $traductor = new Translatable();
            $data = $traductor->toEnglish($test);

            $this->getResponse()->setStatusCode(200);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            //var_dump($json);
            return $json;
        } else {
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $priceLists
            ]);
        }

    }


    public function get($id)
    {

        $priceList = $this->priceListRepository->findPriceList($id);

        if ($priceList instanceof PriceList) {
            $arreglo = $priceList->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $priceList->toArray()
            ]);
        }
        else {
            return $this->notFound(); // Return a 404 if the priceList is not found
        }
    }

}