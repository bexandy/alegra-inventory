<?php

namespace Alegra\Controller;

use Alegra\Model\Company;
use Alegra\Model\CompanyRepositoryInterface;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

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

        if ($company instanceof Company)
        {
            $array = $company->toArray();
            $data = $this->translator()->toEnglish($array);
            $this->getResponse()->setStatusCode(200);
            $json = new JsonModel([
                'success' => true,
                'data' => $data
            ]);
            return $json;
        } else {
            $message = $this->translator()->translate($company);
            $this->getResponse()->setStatusCode(404);
            return new JsonModel([
                'success' => false,
                'message' => $message
            ]);
        }
    }

    public function get($id)
    {
        return $this->getList();
    }

}