<?php
    class ConexionBD{ // Establecer la class
        private static $conexion=null; // ponerla en null
        public static function obtenerConexion(){ // funcion privada establecer conexion
            if(self::$conexion===null){ //cuando la conex sea null, se le asignan valores
                $host="localhost";
                $bd="centrooo";
                $user="root";
                $pass="curso";
                try{ 
                    $dsn="mysql:host=$host;dbname=$bd;charset=utf8mb4";
                    self::$conexion=new PDO($dsn, $user, $pass); // crear PDO
                    self::$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); // atrbutos
                }catch(PDOException $e){
                    die("Error con la base de datos"); // si existiese error con la bd
                }
            }
            return self::$conexion; //devolvemos el valor
        }
    }
?>