
function obtenerMotocicletas() {
    $.ajax({
        type: "POST",
        url: "?controlador=Index&accion=obtenerMotocicletas",
        dataType: "json",
        success: function(response) {
            // Limpiar la tabla antes de agregar nuevos datos
            $("#containertabla tbody").empty();

            // Recorrer la respuesta y agregar los datos a la tabla
            $.each(response, function(index, motocicleta) {
                var row = $("<tr>");
                row.append($("<td>").text(motocicleta.placa));
                row.append($("<td>").text(motocicleta.marca));
                row.append($("<td>").text(motocicleta.modelo));
                row.append($("<td>").text(motocicleta.anio));
                row.append($("<td>").text(motocicleta.cilindraje));
                row.append($("<td>").text(motocicleta.tipo_motor));
                row.append($("<td>").text(motocicleta.propietario_nombre));
                row.append($("<td>").text(motocicleta.propietario_direccion));

                var buttonDeleteFisico = $("<button>")
                    .text("Delete Físico ")
                    .attr("class", "delete-fisico-button")
                    .data("placa", motocicleta.placa)
                    .append('<i class="fa-solid fa-trash fa-sm" style="color: #ffffff;"></i>');

                var buttonDeleteLogico = $("<button>")
                    .text("Delete Lógico ")
                    .attr("class", "delete-logico-button")
                    .data("placa", motocicleta.placa)
                    .append('<i class="fa-solid fa-trash fa-sm" style="color: #ffffff;"></i>');

                var buttonUpdate = $("<button>")
                    .text("Update ")
                    .attr("class", "update-button")
                    .attr("data-bs-toggle", "modal")
                    .data("placa", motocicleta.placa)//le paso todos los datos de esa fila a mi boton y con los demas igual
                    .data("marca", motocicleta.marca)
                    .data("modelo", motocicleta.modelo)
                    .data("anio", motocicleta.anio)
                    .data("cilindraje", motocicleta.cilindraje)
                    .data("tipo_motor", motocicleta.tipo_motor)
                    .data("propietario_nombre", motocicleta.propietario_nombre)
                    .data("propietario_direccion", motocicleta.propietario_direccion)
                    .attr("data-bs-target", "#modalupdate")
                    .append('<i class="fa-solid fa-pen-to-square fa-sm" style="color: #ffffff;"></i>');//atributo para que me abra el modal de bootstrap

                   

                var tdButtons = $("<td>").append(buttonUpdate, buttonDeleteFisico, buttonDeleteLogico);

                // Agregar los botones a la fila
                row.append(tdButtons);

                $("#containertabla tbody").append(row);
            });
        },
        error: function(xhr, status, error) {
            console.log(error, xhr, status);
        }
    });
}




// aqui la llamo para que al cargar la pagina se cargue la tabla
obtenerMotocicletas();

