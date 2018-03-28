<?php

namespace Alegra\Controller;

use Alegra\Model\PriceList;
use Alegra\Model\PriceListRepositoryInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;


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
        $prueba = '';
        $prueba = $this->translator()->translate('Lista de Precios de Prueba');

        $priceLists = $this->priceListRepository->findAllPriceLists();

        if ($priceLists instanceof HydratingResultSet)
        {

            $test = $priceLists->toArray();
            $data = $this->translator()->toEnglish($test);

            $this->getResponse()->setStatusCode(200);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            return $json;
        } else {
            $message = $this->translator()->translate($priceLists);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }

    }


    public function get($id)
    {

        $priceList = $this->priceListRepository->findPriceList($id);

        if ($priceList instanceof PriceList) {
            $arreglo = $priceList->toArray();
            $data = $this->translator()->toEnglish($arreglo);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            return $json;
        } else {
            $message = $this->translator()->translate($priceList);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
            'success' => false,
            'message' => $message
            ]);
        }
    }


}