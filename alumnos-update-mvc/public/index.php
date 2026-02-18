<?php
    //Errores
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    //Dependencias
    require_once __DIR__."/../app/Controladores/ControladorAlumnos.php";

    $controlador=new ControladorAlumnos(); // nuevo controlador
    $accion=$_GET['accion'] ?? 'listar'; // recoger informacion URL por metodo GET
    // El switch y sus acciones
    switch($accion){
        case 'listar':
            $controlador->listar();
            break;
        case 'editar':
            $controlador->editar();
            break;
        case 'actualizar':
            $controlador->actualizar();
            break;
        default:
            $controlador->listar();
    }
?>