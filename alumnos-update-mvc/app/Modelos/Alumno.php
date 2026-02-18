<?php
    // Estructura de las tablas alumnos y su consturctor
    class Alumno{
        public $id;
        public $nombre;
        public $email;
        public $edad;
        public $fecha_creacion;

        public function __construct($id, $nombre, $email, $edad, $fecha_creacion=null){
            $this->id=$id;
            $this->nombre=$nombre;
            $this->email=$email;
            $this->edad=$edad;
            $this->fecha_creacion=$fecha_creacion;
        }
    }
?>