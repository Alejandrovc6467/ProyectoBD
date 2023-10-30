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

DELIMITER //

CREATE PROCEDURE ActualizarMotocicleta(
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
    DECLARE v_error_occurred INT DEFAULT 0;
    
    -- Iniciar un manejador de excepciones
    DECLARE CONTINUE HANDLER FOR SQLEXCEPTION
    BEGIN
        SET v_error_occurred = 1;
    END;

    -- Actualizar la tabla 'motocicleta'
    UPDATE motocicleta
    SET marca = p_marca, modelo = p_modelo, anio = p_anio
    WHERE placa = p_placa;

    -- Si se produce un error, establecer la bandera de error
    IF v_error_occurred = 1 THEN
        SELECT "Ha ocurrido un error al actualizar" AS Mensaje;
    ELSE
        -- Actualizar la tabla 'detalles_motor'
        UPDATE detalles_motor
        SET cilindraje = p_cilindraje, tipo_motor = p_tipo_motor
        WHERE motocicleta_placa = p_placa;

        -- Actualizar la tabla 'detalles_propietario'
        UPDATE detalles_propietario
        SET propietario_nombre = p_propietario_nombre, propietario_direccion = p_propietario_direccion
        WHERE motocicleta_placa = p_placa;

        -- Si no se ha producido un error, mostrar mensaje de éxito
        SELECT "Actualización realizada con éxito" AS Mensaje;
    END IF;
END //

DELIMITER ;




----------------- buscar ----------------------------
DELIMITER //

CREATE PROCEDURE BuscarMotocicletaPorPlaca(
    IN p_placa INT
)
BEGIN
    DECLARE v_motocicleta_encontrada INT DEFAULT 0;
    
    SELECT
        m.placa,
        m.marca,
        m.modelo,
        m.anio,
        m.activo,
        dm.cilindraje AS cilindraje,
        dm.tipo_motor AS tipo_motor,
        dp.propietario_nombre AS propietario_nombre,
        dp.propietario_direccion AS propietario_direccion
    FROM motocicleta AS m
    LEFT JOIN detalles_motor AS dm ON m.placa = dm.motocicleta_placa
    LEFT JOIN detalles_propietario AS dp ON m.placa = dp.motocicleta_placa
    WHERE m.placa = p_placa AND m.activo = 1;
    
    -- Verificar si se encontró una motocicleta
    SELECT FOUND_ROWS() INTO v_motocicleta_encontrada;
    
    IF v_motocicleta_encontrada = 0 THEN
        SELECT "No hay ninguna motocicleta activa con esa placa" AS Mensaje;
    END IF;
END //

DELIMITER ;



----------------- borrar logico -------------------


DELIMITER //

CREATE PROCEDURE BorradoMotocicletaLogico(
    IN p_placa INT
)
BEGIN
    DECLARE v_rows_affected INT;
    
    -- Intentar actualizar la columna "activo" a 0 (inactivo) para realizar un borrado lógico
    UPDATE motocicleta SET activo = 0 WHERE placa = p_placa;
    
    -- Obtener el número de filas afectadas por la operación de actualización
    SET v_rows_affected = ROW_COUNT();
    
    IF v_rows_affected > 0 THEN
        -- El borrado lógico se realizó con éxito
        SELECT "Borrado realizado con éxito" AS Mensaje;
    ELSE
        -- No se encontró ninguna motocicleta con la placa especificada
        SELECT "No se encontró ninguna motocicleta con la placa especificada" AS Mensaje;
    END IF;
END //

DELIMITER ;





----------------- borrar fisico -------------------

DELIMITER //

CREATE PROCEDURE EliminarMotocicleta(
    IN p_placa INT
)
BEGIN
    DECLARE v_rows_affected INT;
    
    -- Intentar eliminar el registro de la motocicleta
    DELETE FROM motocicleta WHERE placa = p_placa;
    
    -- Obtener el número de filas afectadas por la operación de borrado
    SET v_rows_affected = ROW_COUNT();
    
    IF v_rows_affected > 0 THEN
        -- El borrado se realizó con éxito
        SELECT "Borrado realizado con éxito" AS Mensaje;
    ELSE
        -- No se encontró ninguna motocicleta con la placa especificada
        SELECT "No se encontró ninguna motocicleta con la placa especificada" AS Mensaje;
    END IF;
END //

DELIMITER ;



