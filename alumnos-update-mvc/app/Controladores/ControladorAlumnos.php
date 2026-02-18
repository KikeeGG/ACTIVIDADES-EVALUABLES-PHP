<?php
    require_once __DIR__.'/../Modelos/RepositorioAlumnos.php';
    require_once __DIR__.'/../Modelos/Alumno.php';

    class ControladorAlumnos{
        private $repositorio;
        public function __construct(){
            $this->repositorio=new RepositorioAlumnos();
        }
        // Funcion listar
        function listar(){
            try{
                $alumnos=$this->repositorio->obtenerTodos();
                $mensaje=$_GET['msg'] ?? ''; // Para enseñar el futuro mensaje verde de "actualizado"
                $this->renderizar('alumnos/listar',[
                    'alumnos'=>$alumnos,
                    'mensaje'=>$mensaje
                ]);
            }catch(Exception $e){
                $this->registrarError("LISTAR", $e); // llamamos a registrarError
                $this->renderizar('alumnos/listar',[ // llamamos a renderizar
                    'alumnos'=>[],
                    'error'=>"Error al cargar los alumnos."
                ]);
            }
        }
        // Funcion para editar (GET)
        function editar(){
            try{ // Recoge el id enviado por GET (desde el enlace "Editar")
                $id=$_GET['id'] ?? null; // sin o existe asigna null
                if(!$id){
                    header("Location: index.php?accion=listar");
                    exit;
                }
                $alumnos=$this->repositorio->obtenerTodos();
                $alumnoEncontrado=null;
                foreach($alumnos as $alumno){
                    if($alumno->id==$id){
                        $alumnoEncontrado=$alumno;
                        break;
                    }
                }
                if(!$alumnoEncontrado){
                    header("Location: index.php?accion=listar");
                    exit;
                }
                $this->renderizar('alumnos/actualizar',[
                    'alumno'=>$alumnoEncontrado
                ]);
            }catch(Exception $e){
                $this->registrarError("EDITAR", $e);
                header("Location: index.php?accion=listar");
            }
        }

        // Funcion para actualizar (POST) y sus validaciones
        function actualizar(){
            try{
                // Solo permitir método POST
                if($_SERVER['REQUEST_METHOD']!=='POST'){
                    header("Location: index.php?accion=listar");
                    exit;
                }
                // Recoger datos
                $id=$_POST['id'] ?? null;
                $nombre=trim($_POST['nombre'] ?? '');
                $email=trim($_POST['email'] ?? '');
                $edad=$_POST['edad'] ?? null;
                // ID numérico
                if(!$id || !is_numeric($id)){
                    throw new Exception("ID inválido.");
                }
                // Nombre mínimo 2 caracteres
                if(strlen($nombre) <2){
                    throw new Exception("El nombre debe tener al menos 2 caracteres.");
                }
                // Edad numérica
                if(!$edad || !is_numeric($edad)){
                    throw new Exception("La edad debe ser numérica.");
                }
                // Email válido si se rellena
                if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)){
                    throw new Exception("El email no tiene un formato válido.");
                }
                // Crear objeto Alumno
                $alumno=new Alumno(
                    $id,
                    $nombre,
                    $email,
                    $edad,
                    null // Apartado de la fecha_creacion, no veo util cambiar la fecha original
                );
                // Ejecutar update
                $this->repositorio->actualizarAlumno($alumno);
                header("Location: index.php?accion=listar&msg=Alumno actualizado correctamente");
                exit;
            }catch(Exception $e){
                $this->registrarError("ACTUALIZAR", $e);
                header("Location: index.php?accion=listar&msg=Error al actualizar el alumno");
                exit;
            }
        }

        // Funcion renderizar
        function renderizar($vista, $datos=[]){ // Carga una vista dentro del layout principal
            extract($datos);
            $archivoVista=__DIR__.'/../Vistas/'.$vista.'.php';
            if (!file_exists($archivoVista)){
                throw new Exception("Vista no encontrada: ".$vista);
            }
            try{
                $vistaContenido=$archivoVista;
                require __DIR__.'/../Vistas/layout.php';
            }catch(Exception $e){
                $this->registrarError("RENDERIZAR",$e);
                header("Location: index.php?accion=listar");
            }
        }

        // Funcion para registrar en el .log de errores
        function registrarError($contexto, $e){
            $rutaLog=__DIR__.'/../../storage/errores.log'; // ruta del .log
            $fecha=date('Y-m-d H:i:s'); // formato hora
            $linea=$fecha." | ".$contexto." | ".$e->getMessage()." | ".$e->getFile()." | ".$e->getLine()."\n"; //formato
            file_put_contents($rutaLog, $linea, FILE_APPEND); // registra las lineas
        }
    }
?>