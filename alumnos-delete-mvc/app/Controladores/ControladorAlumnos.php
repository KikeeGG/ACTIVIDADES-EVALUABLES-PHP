<?php
    require_once __DIR__.'/../Modelos/RepositorioAlumnos.php';

    class ControladorAlumnos{
        public function listar(){
            $repo=new RepositorioAlumnos(); // Crea el repositorio
            $alumnos=$repo->obtenerTodos(); // Obtener alumnos de la BD
            $mensaje=$_GET['msg'] ?? null; // Mensaje tras borrar

            $this->renderizar('alumnos/listar.php',[
                'alumnos'=>$alumnos,
                'mensaje'=>$mensaje
            ]);
        }

        public function borrar(){
            $id=$_GET['id'] ?? null; // Obtener id por URL
            if(!is_numeric($id)){ // Validar ID
                throw new Exception("ID inválido");
            }
            try{
                $repo=new RepositorioAlumnos();
                $repo->borrarPorId($id);
                header("Location: index.php?msg=Alumno borrado correctamente!");
                exit; // Redirección tras borrar
            }catch(Exception $e){ // Guardar los errores en log
                $this->registrarError("BORRAR", $e->getMessage());
                header("Location: index.php?msg=Error al borrar alumno");
            }
        }

        private function registrarError($contexto, $mensaje){ // Guarda errores en fichero
            $ruta=__DIR__.'/../../storage/errores.log';
            $fecha=date("Y-m-d H:i:s");
            file_put_contents($ruta, "$fecha | $contexto | $mensaje".PHP_EOL,FILE_APPEND);
        }

        private function renderizar($vista, $datos=[]){ // Funcion que pinta la pagina con los datos
            extract($datos);
            $vistaContenido=__DIR__.'/../Vistas/'.$vista;
            require __DIR__.'/../Vistas/layout.php';
        }
    }
?>