<?php
    require_once __DIR__.'/ConexionBD.php';
    class RepositorioAlumnos{
        private $conexion;
        public function __construct(){
            $this->conexion=ConexionBD::obtenerConexion();
        }

        public function obtenerTodos(){
            $sql="SELECT * FROM alumnos ORDER BY id DESC"; // La consulta SELECT
            return $this->conexion->query($sql)->fetchALL(PDO::FETCH_ASSOC);
        }

        public function borrarPorId($id){
            $sql="DELETE FROM alumnos WHERE id=:id";
            $stmt=$this->conexion->prepare($sql); // Consulta preparada
            $stmt->execute([':id'=>$id]); // Ejecutar con parámetro
        }
    }
?>