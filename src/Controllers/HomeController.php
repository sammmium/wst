<?php

namespace App\Controllers;

use App\Controllers\CoreController;

class HomeController extends CoreController
{
    public function index()
    {
        return $this->view->render('home/index.twig', ['huhhdjf']);
    }
}
