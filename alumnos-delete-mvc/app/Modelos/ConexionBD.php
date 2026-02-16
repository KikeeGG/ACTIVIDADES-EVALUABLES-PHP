<?php
    //crear clase ConexionBD
    class ConexionBD{
        private static $conexion=null;
        public static function obtenerConexion(){
            if(self::$conexion===null){
                $host="localhost";
                $bd="centro";
                $user="root";
                $pass="curso";
                try{
                    $dsn="mysql:host=$host;dbname=$bd;charset=utf8mb4";
                    self::$conexion=new PDO($dsn,$user,$pass);
                    //lanzamiento excepciones
                    self::$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                }catch (PDOException $e){
                    die("Error de conexión con la base de datos");
                }
            }
            return self::$conexion;
        }
    }
?>