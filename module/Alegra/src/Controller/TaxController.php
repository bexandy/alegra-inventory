<?php

namespace Alegra\Controller;

use Alegra\Model\Tax;
use Alegra\Model\TaxRepositoryInterface;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

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
        if ($taxes instanceof HydratingResultSet) {
            $array = $taxes->toArray();
            $data = $this->translator()->toEnglish($array);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($taxes);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }


    public function get($id)
    {

        $tax = $this->taxRepository->findTax($id);

        if ($tax instanceof Tax) {
            $array = $tax->toArray();
            $data = $this->translator()->toEnglish($array);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            $this->getResponse()->setStatusCode(200);
            return $json;
        } else {
            $message = $this->translator()->translate($tax);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }

}