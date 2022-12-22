<?php
namespace App\Models;
use CodeIgniter\Model;

class registroCuenta extends Model{


    protected $table      = 'usuario_sistema';
    protected $primaryKey = 'usuario';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['usuario', 'password','inst_centro','nombre','apellidoP'
    ,'apellidoM','email','telefono','rol'];









}