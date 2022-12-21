<?php

namespace App\Controllers\dashboard;

use App\Controllers\BaseController;

class piController extends BaseController
{
    public function tablero()
    {
        echo view('dashboard/templates/header');
        echo view('dashboard/adminInvestigador');
        echo view('dashboard/templates/footer');

    }

    public function contrasenaPerdida ()
    {
        echo view('dashboard/templates/header');
        echo view('dashboard/olvidarContraseña');
        echo view('dashboard/templates/footer');

    }

    public function registrarCuenta ()
    {
        echo view('dashboard/templates/header');
        echo view('dashboard/registroCuenta');
        echo view('dashboard/templates/footer');

    }

    public function registrarPatente ()
    {
        echo view('dashboard/templates/header');
        echo view('dashboard/registroP');
        echo view('dashboard/templates/footer');

    }
    
}
