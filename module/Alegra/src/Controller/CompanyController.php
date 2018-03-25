<?php

namespace Alegra\Controller;

use Alegra\Model\Company;
use Alegra\Model\CompanyRepositoryInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Zend\Json\Json as Json;

class CompanyController extends AbstractRestfulController
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
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
        $company = $this->companyRepository->findCompany();
        $array = $company->toArray();
        $json = new JsonModel([
            'success' => true,
            'data' => $array
        ]);

        return $json;
    }


    public function get($id)
    {

        $company = $this->companyRepository->findCompany();

        if ($company instanceof Company) {
            $array = $company->toArray();
            return new JsonModel([
                'success' => true,
                'data' => $array
            ]);
        }
        else {
            return $this->notFound(); // Return a 404 if the company is not found
        }
    }

}