<?php

namespace Alegra\Controller;

use Alegra\Model\PriceList;
use Alegra\Model\PriceListRepositoryInterface;
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
        //var_dump($priceLists);
        $test = $priceLists->toArray();
        $json = new JsonModel([
            'success' => true,
            'data' => $priceLists->toArray()
        ]);
        //var_dump($json);
        return $json;
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