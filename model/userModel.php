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



    public function login($nombre, $contrasenia)
    {
        $consulta = $this->db->prepare('call sp_login(?, ?)');
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $contrasenia);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function signin($email, $nombre, $apellidos, $institucion, $password)
    {
        $consulta = $this->db->prepare('call InsertarNuevoUsuario(?,?,?,?,?)');
        $consulta->bindParam(1, $email);
        $consulta->bindParam(2, $password);
        $consulta->bindParam(3, $nombre);
        $consulta->bindParam(4, $apellidos);
        $consulta->bindParam(5, $institucion);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    public function activar($email)
    {
        $consulta = $this->db->prepare('call sp_activar_cuenta(?)');
        $consulta->bindParam(1, $email);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }


    
    
    public function obtenerUsuarios()
    {
        $consulta = $this->db->query('CALL ObtenerUsuarios()');
        $resultado = $consulta->fetchAll();
        return $resultado;
    }
    

    public function actualizarRolUsuario($email, $rol)
    {
        $consulta = $this->db->prepare('CALL ActualizarRolUsuario(?, ?)');
        $consulta->bindParam(1, $email);
        $consulta->bindParam(2, $rol);
        $consulta->execute();
        $consulta->closeCursor();
    }

    public function actualizarRol($email, $nuevoRol)
    {
        $consulta = $this->db->prepare('CALL UpdateUserRole(?, ?)');
        $consulta->bindParam(1, $email, PDO::PARAM_STR);
        $consulta->bindParam(2, $nuevoRol, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        $consulta->execute();
        
        // Cerrar la consulta
        $consulta->closeCursor();
    }


    //mio Alejandro
    public function guardarDocumentoBD($url_documento, $email_user, $temadocumento)
    {
        $consulta = $this->db->prepare('call InsertarDocumento(?,?,?)');
        $consulta->bindParam(1, $url_documento);
        $consulta->bindParam(2, $email_user);
        $consulta->bindParam(3, $temadocumento);
        $consulta->execute();
        $resultado = $consulta->fetchAll();
        $consulta->closeCursor();
        return $resultado;
    }

    

    public function ObtenerInformacionDocumento($temadocumento)
    {
        $consulta = $this->db->prepare('CALL ObtenerInformacionDocumento(?)');
        $consulta->bindParam(1, $temadocumento, PDO::PARAM_STR);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }

 


}