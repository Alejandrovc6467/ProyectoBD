<?php
class IndexController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function mostrar()
    {
        $this->view->show("indexView.php");
    }

    public function mostrarHome()
    {
        $this->view->show("home.php");
    }



    //inicio proyecto bd --------------------------------------------------------------

    public function InsertarMotocicleta()
    {
        require 'model/userModel.php';
        $userModel = new userModel();


        $resultado = $userModel->InsertarMotocicleta(
            $_POST['placa'],
            $_POST['marca'],
            $_POST['modelo'],
            $_POST['anio'],
            $_POST['cilindraje'],
            $_POST['tipomotor'],
            $_POST['propietario_nombre'],
            $_POST['propietario_direccion']


        );

        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }


    public function obtenerMotocicletas()
    {
        require 'model/userModel.php';
        $userModel = new userModel();

        $lista = $userModel->obtenerMotocicletas();

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }


    public function borradoMotocicletafisico()
    {
        require 'model/userModel.php';
        $userModel = new userModel();


        $resultado = $userModel->borradoMotocicletafisico(
            $_POST['placa']
        );

        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }


    public function BorradoMotocicletaLogico()
    {
        require 'model/userModel.php';
        $userModel = new userModel();


        $resultado = $userModel->BorradoMotocicletaLogico(
            $_POST['placa']
        );

        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }


    //fin proyecto bd -------------------------------------------------------------------------------------


   

    public function signin()
    {

        require 'model/userModel.php';
        $userModel = new userModel();

        $resultado = $userModel->signin(
            $_POST['email'],
            $_POST['nombre'],
            $_POST['apellidos'],
            $_POST['institucion'],
            $_POST['password']


        );
        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }

    


    public function activar()
    {
        require 'model/userModel.php';
        $userModel = new userModel();

        $lista = $userModel->activar(
            $_POST['email']
        );

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }


    public function login()
    {

        if (isset($_POST['nombre'])  &&  isset($_POST['contrasena'])) {


            require 'model/userModel.php';
            $userModel = new userModel();

            $roles = $userModel->login(
                $_POST['nombre'],
                $_POST['contrasena']
            );

            if (empty($roles)) {
                $data['mensaje'] = 'Usuario inactivo o los datos estan incorrectos';
                $this->view->show("login.php", $data);
                return;
            } else {

                session_start(); 

                foreach ($roles as $value) {
                    $rol = $value[0];
                    $email = $value[1];
                    $nombre = $value[2];
                    $apellidos = $value[3];
                }

                $_SESSION['rol'] = $rol;
                $_SESSION['email'] = $email;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['apellidos'] = $apellidos;

                if ($rol == "usuario") {
                    return $this->view->show("userpage.php", $rol);
                } elseif ($rol != "usuario") {
                    return $this->view->show("adminpage.php", $rol);
                }
            }
        } else {
            $data['mensaje'] = 'Inicia sesion desde el login para ingresar correctamente';
            return $this->view->show("login.php", $data);
        }
    }


    public function obtenerUsuarios()
    {
        require 'model/userModel.php';
        $userModel = new userModel();

        $lista = $userModel->obtenerUsuarios();

        header('Content-Type: application/json');
        echo json_encode($lista);
        exit;
    }




    public function actualizarRol()
    {
        require 'model/userModel.php';
        $userModel = new userModel();


        $resultado =  $userModel->actualizarRol($_POST['email'], $_POST['rol']);

        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }



    //mio Alejandro

    public function subirdocumento()
    {
        // Verifica si se ha enviado una solicitud POST.
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        


            
            //nuevo
            $extension_permitida = ['pdf', 'doc', 'docx', 'odt'];

            $archivo = $_FILES['archivo'];

            $archivo_info = pathinfo($archivo['name']);
            $archivo_extension = strtolower($archivo_info['extension']);

            if (in_array($archivo_extension, $extension_permitida)) {
               
                    
                //realizar operaciones de guardado, validación u otras acciones aquí.

                $nombreArchivo = $_FILES['archivo']['name'];
                $rutaTemporal = $_FILES['archivo']['tmp_name'];
                $directorioDestino = 'uploads/';
                    
                
                $nombreBase = pathinfo($nombreArchivo, PATHINFO_FILENAME);
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                $nuevoNombre = $nombreBase;
                $contador = 1;
                    
                while (file_exists($directorioDestino . $nuevoNombre . '.' . $extension)) {
                    $nuevoNombre = $nombreBase . '_' . $contador;
                    $contador++;
                }
                    
                $nombreArchivo = $nuevoNombre . '.' . $extension;
                

            
                $rutaDestino = $directorioDestino . $nombreArchivo;
            
                if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                    

                    //una vez subido al servidor hago la insercion a la bd
                
                    //////////////////// guaradado en la base de datos
                    require 'model/userModel.php';
                    $userModel = new userModel();

                    $resultado = $userModel->guardarDocumentoBD(
                        $rutaDestino,
                        $_POST['email_user'],
                        $_POST['temadocumento']
                    );
                    //////////////////////// FIN guaradado en la base de datos

                    $mensaje = "1";
                
                } else {
                    $mensaje = "0";
                }



                // Despues de hacer todo el proceso de guardado prepararo una respuesta en formato JSON para enviarla al "subirdocumento.js" y el muestre la ventana de sweet Alert con el mensaje
               



                //echo 'El archivo se ha cargado exitosamente.';
            } else {
                $mensaje = "2";
                //echo 'El archivo no es de un tipo permitido (PDF, DOC o DOCX).';
            }
            //fin nuevo

            $response = array(
                'status' => 'success',
                'message' => $mensaje
            );
        
    
            // Envía la respuesta en formato JSON.
            header('Content-Type: application/json');
            echo json_encode($response);



        } else {
            // Manejo de solicitud no válida.
            $response = array(
                'status' => 'error',
                'message' => 'Ocurrio un error al enviar el documento, intente de nuevo'
            );
        
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
      
    }// subirdocumento


    //mio Alejandro
    public function ObtenerInformacionDocumento()
    {
        require 'model/userModel.php';
        $userModel = new userModel();

        $documentos = $userModel->ObtenerInformacionDocumento(
            $_POST['temadocumento']
        );
        

        header('Content-Type: application/json');
        echo json_encode($documentos);
        exit;
       
    }


  
  

} // fin clase
