<?php

namespace App\Controllers\dashboard;

use App\Controllers\BaseController;
use App\Models\registrarCuenta;
use App\Models\registroCuenta;
use CodeIgniter\Exceptions\AlertError;
use SebastianBergmann\Environment\Console;

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


    //-----------------------------------------------------------------------------------
//funciones de registrar cuenta

public function registrarCuenta()
{

    echo view('dashboard/templates/header');
    echo view('dashboard/registroCuenta');
    echo view('dashboard/templates/footer');

}



public function insertar()
{

    $userModel = new registroCuenta();
    $request = \Config\Services::request();

    $data = array(
       'password' => $request->getPost('passwordC'),
        'inst_centro' => $request->getPost('tecR'),
        'nombre' => $request->getPost('nombreR'),
        'apellidoP' => $request->getPost('paternoR'),
        'apellidoM' => $request->getPost('maternoR'),
        'email' => $request->getPost('correoR'),
        'telefono' => $request->getPost('telefonoR'),
         'rol' => $request->getPost('rolR')
    );

    if ($_POST) {
        print_r($_POST);

    }

    if ( $userModel->insert($data)===false) {
         print_r($userModel->errors());
    }
   

 

}





//------------------------------------------------------------------------------------

public function registrarPatente()
{
    echo view('dashboard/templates/header');
    echo view('dashboard/registroP');
    echo view('dashboard/templates/footer');

}

}