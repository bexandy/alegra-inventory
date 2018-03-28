<?php

namespace Alegra\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractRestfulController;

class HomeController extends AbstractRestfulController
{
    public function indexAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        return $viewModel;
    }
}