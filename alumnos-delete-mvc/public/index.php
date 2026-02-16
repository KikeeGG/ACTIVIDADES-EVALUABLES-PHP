<?php
    ini_set('display_errors', 1); // Activa errores en desarrollo
    error_reporting(E_ALL);
    require_once __DIR__.'/../app/Controladores/ControladorAlumnos.php'; // Carga el controlador principal

    $controlador=new ControladorAlumnos();
    $accion=$_GET['accion'] ?? 'listar'; // Acción por URL, por defecto listar

    switch($accion){ // switch case sencillo
        case 'borrar':
            $controlador->borrar();
            break;
        default:
            $controlador->listar();
    }
?>