<!-- Aqui va lo principal -->

<?php

    $txtNombreProyecto=(isset($_POST['txtNombreProyecto']))?$_POST['txtNombreProyecto']:"";
    $txtEntidad=(isset($_POST['txtEntidad']))?$_POST['txtEntidad']:"";
    $txtCurp=(isset($_POST['txtCurp']))?$_POST['txtCurp']:"";
    $txtTipoRegistro=(isset($_POST['txtTipoRegistro']))?$_POST['txtTipoRegistro']:"";
    $numContacto=(isset($_POST['numContacto']))?$_POST['numContacto']:"";
    $txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
    $txtRFC=(isset($_POST['txtRFC']))?$_POST['txtRFC']:"";
    $txtRegion=(isset($_POST['txtRegion']))?$_POST['txtRegion']:"";
    $txtIne=(isset($_FILES['txtIne']))?$_FILES['txtIne']['name']:"";

    include(" "); //Esta es la ruta para la conexión a la base de datos


    //Buscamos la carpeta /htdocs/Seg-Pi2/database
    $ruta_padre = dirname(dirname(dirname(__FILE__)));
    //Ingresamos a la carpeta archivos que es donde se crearan los nuevos expedientes
    //IMPORTANTE, CREAR LA CARPETA EXPEDIENTES DENTRO DE LA CARPETA PADRE
    $ruta_carpeta = "$ruta_padre/expedientes";

    $nombre_carpeta = "$txtCurp - $txtNombreProyecto";
    $ruta_nueva_carpeta = "$ruta_carpeta"/"$nombre_carpeta";
    $nueva_carpeta = mkdir($ruta_nueva_carpeta);

    $sentenciaSQL= $conexion->prepare("
    INSERT INTO /*NombreDeLaBaseDeDatos*/(/*Estos los nombres en la base de datos, separados por comas*/) 
    VALUES (
        :nombreProyecto, 
        :entidad,
        :curp,
        :tipoRegistro,
        :contacto,
        :correo,
        :rfc,
        :region,
        :ine
    );");
                $sentenciaSQL->bindParam(':nombreProyecto', $txtNombreProyecto);
                $sentenciaSQL->bindParam(':entidad', $txtEntidad);
                $sentenciaSQL->bindParam(':curp', $txtCurp);
                $sentenciaSQL->bindParam(':tipoRegistro', $txtTipoRegistro);
                $sentenciaSQL->bindParam(':contacto', $numContacto);
                $sentenciaSQL->bindParam(':correo', $txtCorreo);
                $sentenciaSQL->bindParam(':rfc', $txtRFC);
                $sentenciaSQL->bindParam(':region', $txtRegion);

                $fecha= new DateTime();
                $nombreArchivo=($txtImagen!="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpeg";

                $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

                if ($tmpImagen!="") {
                    move_uploaded_file($tmpImagen,"$ruta_carpeta/$nombreCarpeta".$nombreArchivo); //Se debe cambiar la ruta en la que se almacenaran los datos
                }

                $sentenciaSQL->bindParam(':ine', $nombreArchivo);
                $sentenciaSQL->execute();

?>

<div class="formulario-registro">
    <form method="POST" enctype="multipart/form-data">
        <div class="formulario">
            <div class="formulario-registro-datos">
                <br>
                <label for="txtNombreProyecto">Escribe tu nombre: </label><br><br>
                <input 
                    type="text" 
                    name="txtNombreProyecto" 
                    id="txtNombreProyecto"
                    placeholder="Escribe aquí tu nombre" 
                    required
                >
                <br><br>
                <label for="txtEntidad">Instituto o Empresa: </label><br><br>
                <input 
                    type="text" 
                    name="txtEntidad" 
                    id="txtEntidad"
                    placeholder="Escribe aquí tu entidad" 
                    required
                >
                <br><br>
                <label for="txtCurp">Curp: </label><br><br>
                <input 
                    type="text" 
                    name="txtCurp"
                    id="txtCurp"
                    placeholder="Ingresa tu CURP" 
                    minlength=18
                    maxlength=18
                    required
                >
                <br><br>
                <label for="txtTipoRegistro">Tipo de registro: </label><br><br>
                <select name="txtTipoRegistro" id="txtTipoRegistro required">
                    <option value="Marcas">Marcas</option>
                    <option value="Patentes">Patentes</option>
                    <option value="Obras">Obras</option>
                    <option value="Reservas de derechos">Reservas de derechos</option>
                </select>
                <br>
                <a href="#">¿No sabes que tipo de registro es tu patente?</a>
                <br><br>
            </div>
            <div class="formulario-registro-datos">
                <br>
                <label for="numContacto">Numero de contacto:</label><br><br>
                <input 
                    type = "number"
                    name = "numContacto"
                    id="numContacto"
                    placeholder="Escribe aquí tu numero de contacto" 
                    required
                >
                <br><br>
                <label for="txtCorreo">Correo Electrónico:</label><br><br>
                <input 
                    type="Email"
                    name="txtCorreo"
                    id="txtCorreo"
                    placeholder="Ingresa solo correos institucionales"
                    required
                >
                <br><br>
                <label for="txtRFC">RFC:</label><br><br>
                <input 
                    type="text"
                    id="txtRFC"
                    placeholder="Ingresa tu RFC aquí"
                    minlength=12
                    maxlength=13
                    required
                >
                <br><br>
                <label for="txtRegion">Región:</label><br><br>
                <select name="txtRegion" id="txtRegion">
                    <option value="Baja California">Baja California</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                </select>
                <br><br>
                <label for="txtIne">Por favor sube una foto de tu INE</label>
                <br><br>
                <input 
                    type="file"
                    name="txtIne"
                    id = "txtIne"
                >
                <br><br>
            </div>
        </div>
        <div class="opciones">
            <input type="submit" name ="accion" value="Enviar registro">
        </div>
    </form>


</div>