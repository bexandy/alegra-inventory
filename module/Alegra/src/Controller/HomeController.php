<?php

namespace Alegra\Controller;

use Alegra\Filter\TaxFilter;
use Alegra\Hydrator\TaxHydrator;
use Alegra\Model\Tax;
use Zend\Config\Config;
use Zend\Config\Writer\PhpArray;
use Zend\Filter\ToInt;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class HomeController extends AbstractRestfulController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }

    public function testAction()
    {
        

        //$reader = new \Zend\I18n\Translator\Loader\PhpArray();

        //$data = $reader->load('en_US', '../../language/en_US.lang.php');

        $config = new Config(include '../../language/en_US.lang.php', true);
        $config->production = array();

        $config->production->webhost = 'www.example.com';
        $config->production->database = array();
        $config->production->database->params = array();
        $config->production->database->params->host = 'localhost';
        $config->production->database->params->username = 'production';
        $config->production->database->params->password = 'secret';
        $config->production->database->params->dbname = 'dbproduction';

        $writer = new PhpArray();

        $data = $writer->toString($config);

        $json = new JsonModel([
            'success' => true,
            'data' => $data
        ]);

        return $json;




        $data = "{'success':true, 'data': [{ 'id' : '1', 'name': 'IVA' , 'percentage' : '21.00' ,
'description' : 'Value Added Tax', 'type' : 'OTHER' , 'status' : 'active' }]}";

        $data = json_decode($data);

        $price = '20000.84';

        $formatter = new \NumberFormatter('en_US', \NumberFormatter::IGNORE);

        $a = number_format($price,2,'.','');
        $b = $formatter->format($price);

        return $b;

        $data = [
                'id' => 'hola',
                'name' => null,
                'percentage' => '21.5',
                'type' => '',
                'status' => 'active'
        ];

        $filter = new ToInt();

        $prueba = $filter->filter('-4 is less than 0');

        $hydrator = new  TaxHydrator();
        $tax = $hydrator->hydrate( $data, new Tax());


        if ($tax instanceof Tax) {
            $array = $tax->toArray();
            $data = $this->translator()->toEnglish($array);
            $data = $this->array_filter_recursive($data);
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

    function array_filter_recursive($input)
    {
        foreach ($input as &$value)
        {
            if (is_array($value))
            {
                if (empty($value))
                    $value = null;
                else
                    $value = $this->array_filter_recursive($value);
            }
        }

        $filter = array_filter($input, function($v){ return is_null($v) || $v != '' ;});
        return $filter;
    }
}