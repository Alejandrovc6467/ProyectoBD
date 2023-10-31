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
            $_POST['tipo_motor'],
            $_POST['propietario_nombre'],
            $_POST['propietario_direccion']


        );

        header('Content-Type: application/json');
        echo json_encode($resultado);
        exit;
    }

    public function ActualizarMotocicleta()
    {
        require 'model/userModel.php';
        $userModel = new userModel();


        $resultado = $userModel->ActualizarMotocicleta(
            $_POST['placa'],
            $_POST['marca'],
            $_POST['modelo'],
            $_POST['anio'],
            $_POST['cilindraje'],
            $_POST['tipo_motor'],
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


    public function BuscarMotocicletaPorPlaca()
    {
        require 'model/userModel.php';
        $userModel = new userModel();


        $resultado = $userModel->BuscarMotocicletaPorPlaca(
            $_POST['placa']
        );

        header('Content-Type: application/json');
        echo json_encode($resultado);
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


  

} // fin clase
