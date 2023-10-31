<?php

class userModel
{

    private $db;

    public function __construct()
    {
        require './libs/SPDO.php';
        $this->db = SPDO::getInstance();
    }


    //inicio proyecto bd  -------------------------------------------------------


    public function InsertarMotocicleta($placa, $marca, $modelo, $anio, $cilindraje, $tipo_motor, $propietario_nombre, $propietario_direccion)
    {
        $consulta = $this->db->prepare('call InsertarMotocicleta(?,?,?,?,?,?,?,?)');
        $consulta->bindParam(1, $placa);
        $consulta->bindParam(2, $marca);
        $consulta->bindParam(3, $modelo);
        $consulta->bindParam(4, $anio);
        $consulta->bindParam(5, $cilindraje);
        $consulta->bindParam(6, $tipo_motor);
        $consulta->bindParam(7, $propietario_nombre);
        $consulta->bindParam(8, $propietario_direccion);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    
    public function ActualizarMotocicleta($placa, $marca, $modelo, $anio, $cilindraje, $tipo_motor, $propietario_nombre, $propietario_direccion)
    {
        $consulta = $this->db->prepare('call ActualizarMotocicleta(?,?,?,?,?,?,?,?)');
        $consulta->bindParam(1, $placa);
        $consulta->bindParam(2, $marca);
        $consulta->bindParam(3, $modelo);
        $consulta->bindParam(4, $anio);
        $consulta->bindParam(5, $cilindraje);
        $consulta->bindParam(6, $tipo_motor);
        $consulta->bindParam(7, $propietario_nombre);
        $consulta->bindParam(8, $propietario_direccion);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }


    public function obtenerMotocicletas()
    {
        $consulta = $this->db->query('CALL ObtenerMotocicletasActivasConDetalles()');
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function obtenerMotocicletasEnmascarado()
    {
        $consulta = $this->db->query('CALL ObtenerMotocicletasActivasConDetallesEnmascarado()');
        $resultado = $consulta->fetchAll();
        return $resultado;
    }

    public function BuscarMotocicletaPorPlaca($placa)
    {
        $consulta = $this->db->prepare('call BuscarMotocicletaPorPlaca(?)');
        $consulta->bindParam(1, $placa);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function borradoMotocicletafisico($placa)
    {
        $consulta = $this->db->prepare('call borradoMotocicletafisico(?)');
        $consulta->bindParam(1, $placa);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    

    public function BorradoMotocicletaLogico($placa)
    {
        $consulta = $this->db->prepare('call BorradoMotocicletaLogico(?)');
        $consulta->bindParam(1, $placa);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }



    //fin proyecto bd  -----------------------------------------------------------------


}