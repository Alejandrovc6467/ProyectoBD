CREATE DATABASE motoCRUD;


----------------- Tables ---------------------------------------------------------------------------------------------------------

CREATE TABLE motocicleta (
    placa INT PRIMARY KEY,
    marca VARCHAR(500),
    modelo VARCHAR(500),
    anio INT,
    activo BOOLEAN DEFAULT true
);


CREATE TABLE detalles_motor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motocicleta_placa INT,
    cilindraje INT,
    tipo_motor VARCHAR(500),
    FOREIGN KEY (motocicleta_placa) REFERENCES motocicleta(placa) ON DELETE CASCADE
);


CREATE TABLE detalles_propietario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    motocicleta_placa INT,
    propietario_nombre VARCHAR(500),
    propietario_direccion VARCHAR(500),
    FOREIGN KEY (motocicleta_placa) REFERENCES motocicleta(placa) ON DELETE CASCADE
);





---------------- PROCEDURE ------------------------------------------------------------------------------------------------------


--------------- insertar ------------------------------

DELIMITER //

CREATE PROCEDURE InsertarMotocicleta(
    IN p_placa INT,
    IN p_marca VARCHAR(500),
    IN p_modelo VARCHAR(500),
    IN p_anio INT,
    IN p_cilindraje INT,
    IN p_tipo_motor VARCHAR(500),
    IN p_propietario_nombre VARCHAR(500),
    IN p_propietario_direccion VARCHAR(500)
)
BEGIN
    DECLARE placa_existente INT;
    
    -- Verificar si la placa ya está registrada
    SELECT COUNT(*) INTO placa_existente
    FROM motocicleta
    WHERE placa = p_placa;
    
    IF placa_existente > 0 THEN
        -- La placa ya está registrada, retornar un mensaje de error
        SELECT "Placa ya registrada" AS Mensaje;
    ELSE
        -- Insertar la motocicleta
        INSERT INTO motocicleta (placa, marca, modelo, anio)
        VALUES (p_placa, p_marca, p_modelo, p_anio);
        
       
        -- Insertar detalles del motor
        INSERT INTO detalles_motor (motocicleta_placa, cilindraje, tipo_motor)
        VALUES (p_placa, p_cilindraje, p_tipo_motor);

        -- Insertar detalles del propietario
        INSERT INTO detalles_propietario (motocicleta_placa, propietario_nombre, propietario_direccion)
        VALUES (p_placa, p_propietario_nombre, p_propietario_direccion);
        
        -- Retornar un mensaje de éxito
        SELECT "Motocicleta registrada exitosamente" AS Mensaje;
    END IF;
END //

DELIMITER ;


----------------- obtener Motocicletas, si tiene borrado logico no me los trae ------------

DELIMITER //

CREATE PROCEDURE ObtenerMotocicletasActivasConDetalles()
BEGIN
    SELECT
        m.placa,
        m.marca,
        m.modelo,
        m.anio,
        dm.cilindraje,
        dm.tipo_motor,
        dp.propietario_nombre,
        dp.propietario_direccion
    FROM motocicleta AS m
    LEFT JOIN detalles_motor AS dm ON m.placa = dm.motocicleta_placa
    LEFT JOIN detalles_propietario AS dp ON m.placa = dp.motocicleta_placa
    WHERE m.activo = 1;
END //

DELIMITER ;




----------------- actualizar ----------------------

----------------- borrar logico -------------------

----------------- borrar fisico -------------------


