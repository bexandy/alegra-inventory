<?php

namespace Alegra\Controller;

use Alegra\Model\Tax;
use Alegra\Model\TaxRepositoryInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class TaxController extends AbstractRestfulController
{
	/**
     * @var TaxRepositoryInterface
     */
    private $taxRepository;

    public function __construct(TaxRepositoryInterface $taxRepository)
    {
        $this->taxRepository = $taxRepository;
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
        $taxes = $this->taxRepository->findAllTaxes();
        $array = $taxes->toArray();
        $json = new JsonModel([
            'success' => true,
            'data' => $array
        ]);

        return $json;
    }


    public function get($id)
    {

        $tax = $this->taxRepository->findTax($id);

        if ($tax instanceof Warehouses) {
            $array = $tax->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $array
            ]);
        }
        else {
            return $this->notFound(); // Return a 404 if the tax is not found
        }
    }

}