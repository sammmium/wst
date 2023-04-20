<?php

namespace App\Controllers;

use App\Controllers\CoreController;

require_once __DIR__ . '/CoreController.php';

class DefaultController extends CoreController
{
    public function index()
    {
        return $this->view->render('default/index.twig', ['huhhdjf']);
    }
}
