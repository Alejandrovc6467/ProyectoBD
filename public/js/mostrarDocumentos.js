
function ObtenerInformacionDocumento(temadocu_requerido, id_tabla_modificar) {    
    

    var data_a_enviar = {
        temadocumento: temadocu_requerido,
    };

    $.ajax({
        type: "POST",
        url: "?controlador=Index&accion=ObtenerInformacionDocumento",
        data: data_a_enviar,
        dataType: "json",
        success: function(response) {

            //console.log(response);

            // Limpiar la tabla antes de agregar nuevos datos
           $("#" + id_tabla_modificar + " tbody").empty();
                                

            // Recorrer la respuesta y agregar los datos a la tabla
            $.each(response, function(index, usuario) {
                                
                var row = $("<tr>");

                row.append($("<td>").text(usuario.id));
                row.append($("<td>").text(usuario.email));
                row.append($("<td>").text(usuario.nombre));
                row.append($("<td>").text(usuario.apellidos));
                row.append($("<td>").text(usuario.institucion));
                //row.append($("<td>").text(usuario.url_documento)); // era solo con esta linea, lo del boton lo acaba de hacer

             //.append($("<i>").addClass("fa-solid fa-download"));
                // Creo un nuevo <td> para el botón de descarga
                 var descargaDocumento = $("<td>");
                 var button = $("<button>").addClass("descargabotonadminpage")
                    .text(" Descargar")
                    .click(function() {
                        // Redirigir o descargar el archivo al hacer clic en el botón
                        window.open(usuario.url_documento, "_blank");
                    });

                descargaDocumento.append(button);

                // Agregar el nuevo <td> a la fila
                row.append(descargaDocumento);

             

                //agrego todo lo hecho al tbody en una nueva fila
                $("#" + id_tabla_modificar + " tbody").append(row);
                                    
            });
                                
            },
                error: function(xhr, status, error) {
                    console.log(error, xhr, status);
                }
            });

}//fin funcion