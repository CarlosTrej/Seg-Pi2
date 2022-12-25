<?php

namespace App\Controllers\dashboard;

use App\Controllers\BaseController;
use App\Models\registroCuenta;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


class piController extends BaseController
{
    public function tablero()
    {
        echo view('dashboard/templates/header');
        echo view('dashboard/adminInvestigador');
        echo view('dashboard/templates/footer');
    }

    public function contrasenaPerdida()
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
            
            $mail = new PHPMailer(true);
            $nombre = $_POST["nombreR"];
            $apellidoP = $_POST["paternoR"];
            $apellidoM = $_POST["maternoR"];
            $rol = $_POST["rolR"];
            $emailDestino = $_POST["correoR"];
            $nombreCompleto = $nombre . " " . $apellidoP . " " . $apellidoM;
            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   
                $mail->isSMTP();                                            
                $mail->Host       = 'mail.rhsac.com';                    
                $mail->SMTPAuth   = true;                                   
                $mail->Username   = 'sistemapatentestecnm@rhsac.com';                   
                $mail->Password   = 'holaquease';                             
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           
                $mail->Port       = 465;                                   
                //Recipients
                $mail->setFrom('sistemapatentestecnm@rhsac.com', 'TecNM');
                $mail->addAddress($emailDestino);     
                //Content
                $mail->isHTML(true);                                  
                $mail->Subject = 'Confirmacion de la cuenta en el Sistema Seg Pi';
                $mail->Body    = 'Bienvenid@  <b>' . $nombreCompleto . '</b>, gracias por completar tu registro con nosotros.<br>
                <br><b>Tus datos de contacto:<b><br><b>Correo de registro: </b>' . $emailDestino . 
                    '<br><b>Rol o Cargo Administrativo: </b>' . $rol . '</b><br><b></b>' . '
                <html>
                    <head>
                        <title>Inicia Sesión</title>
                    </head>
                    <body style="margin:30px 2px; padding: 160px 8px;border: PowderBlue 5px double; border-top-left-radius: 20px;border-bottom-right-radius: 20px; background: linear-gradient(225deg, #183862 0%, #355dbb 100%)">
                        <center><a class="enlace" href="http://localhost/Seg-Pi2/public/" style="border:9px outset #addbff; background-color:#addbff; text-decoration: none; font-weight: 700; color: black;">INICIAR SESIÓN</a></center>
                    </body>
                </html>';
            
                $mail->send();
                echo "<script>
                        alert('informacion enviada');
                        setTimeout(()=>{
                            alert('Registro exitoso');
                            window.location.href ='/Seg-Pi2/public/'
                        },500);
                      </script>";
            } catch (Exception $e) {
                echo "<script>    
                        alert('Ha surgido un error al enviar un correo. Detalles -->{$mail->ErrorInfo}');
                        setTimeout(()=>{ window.location.href ='/Seg-Pi2/public/' },1000);
                    </script>";
            }
        }

        if ($userModel->insert($data) === false) {
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

    public function correo()
    {
        echo view('dashboard/Correos');
    }
}
