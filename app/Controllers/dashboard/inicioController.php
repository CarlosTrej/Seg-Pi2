<?php

namespace App\Controllers\dashboard;

use App\Controllers\BaseController;

class inicioController extends BaseController
{
    public function index()
    {
        echo view('dashboard/templates/header');
        echo view('dashboard/index');
        echo view('dashboard/templates/footer');

    }
}
