<?php
    require_once __DIR__.'/ConexionBD.php';

    class RepositorioAlumnos{
        private $db;
        function __construct(){
            $this->db=ConexionBD::obtenerConexion();
        }

        // Para listar, obtener todos los alumnos
        function obtenerTodos(){
            $sql="SELECT * FROM alumnos ORDER BY id DESC"; // sentencia SQL
            $stmt=$this->db->query($sql); // querry 
            $alumnos=[];
            while ($fila=$stmt->fetch(PDO::FETCH_ASSOC)){
                $alumnos[]=new Alumno(
                    $fila["id"],
                    $fila["nombre"],
                    $fila["email"],
                    $fila["edad"],
                    $fila["fecha_creacion"]
                );
            }
            return $alumnos;
        }

        // Para actualziar, actualizar alumno
        function actualizarAlumno($alumno){
            $sql="UPDATE alumnos 
                    SET nombre=:nombre, email=:email, edad=:edad
                    WHERE id=:id";
            $stmt=$this->db->prepare($sql); // sentencia preparada
            $stmt->execute([
                ":nombre"=>$alumno->nombre,
                ":email"=>$alumno->email,
                ":edad"=>$alumno->edad,
                ":id"=>$alumno->id
            ]);
        }
    }
?>