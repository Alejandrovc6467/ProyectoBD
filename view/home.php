<?php
include('public/header.php');
include('public/menu.php');
?>





<div class="home container"  data-aos="fade-right" data-aos-duration="1500">

  <div class="titulo">
    <h2>Registro de Motocicletas</h2>
  </div>


  <div class="formulario">

        
    <form id="registarMotocicleta">

      <div class="componentesFormulario">
          
        <p>
          <label>Placa</label><br>
          <input type="text"  name="placa" id="placa" placeholder="Ingresa la placa"  autocomplete required >
        </p>

        <p>
          <label>Marca</label><br>
          <input type="text"  name="marca" id="marca" placeholder="Ingresa la marca"  autocomplete required >
        </p>

        <p>
          <label>Modelo</label><br>
          <input type="text"  name="modelo" id="modelo" placeholder="Ingresa el modelo"  autocomplete required >
        </p>


        <p>
          <label>Año</label><br>
          <input type="text"  name="anio" id="anio" placeholder="Ingresa el año"  autocomplete required >
        </p>

        <p>
          <label>Cilindraje</label><br>
          <input type="text"  name="cilindraje" id="cilindraje" placeholder="Ingresa el cilindraje"  autocomplete required >
        </p>

        <p>
          <label>Tipo motor</label><br>
          <input type="text"  name="tipomotor" id="tipomotor" placeholder="Ingresa el Tipo de motor"  autocomplete required >
        </p>

        <p>
          <label>Propietario nombre</label><br>
          <input type="text"  name="propietario_nombre" id="propietario_nombre" placeholder="Ingresa el nombre"  autocomplete required >
        </p>

        <p>
          <label>Propietario direccion</label><br>
          <input type="text"  name="propietario_direccion" id="propietario_direccion" placeholder="Ingresa la direccion"  autocomplete required >
        </p>

      </div>


      <div class="botonesFormulario">
        <input type="submit" value="Registrar" id="buttonregistrar" class="botonRegistrar">
      </div>

            
    </form>

        
      
  </div>





  <div class="motoclicletasTabla">

                        
    <div class="containertabla" id="containertabla">
        <table>
            <thead>
                <tr>
                    <th>Placa</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año</th>
                    <th>Cilindraje</th>
                    <th>Tipo Motor</th>
                    <th>Propietario Nombre</th>
                    <th>Propietario Direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aquí se llenarán los datos de los usuarios -->
            </tbody>
        </table>
    </div>

  </div>


            

</div>




    <!-- Modal update -->
    <div class="modal" id="modalupdate" tabindex="-1">

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Update Motocicleta</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            


          <form id="registarMotocicleta">

            <div class="componentesFormulario">
                
              <p>
                <label>Placa</label><br>
                <input type="text"  name="placa" id="placa" placeholder="Ingresa la placa"  autocomplete required >
              </p>

              <p>
                <label>Marca</label><br>
                <input type="text"  name="marca" id="marca" placeholder="Ingresa la marca"  autocomplete required >
              </p>

              <p>
                <label>Modelo</label><br>
                <input type="text"  name="modelo" id="modelo" placeholder="Ingresa el modelo"  autocomplete required >
              </p>


              <p>
                <label>Año</label><br>
                <input type="text"  name="anio" id="anio" placeholder="Ingresa el año"  autocomplete required >
              </p>

              <p>
                <label>Cilindraje</label><br>
                <input type="text"  name="cilindraje" id="cilindraje" placeholder="Ingresa el cilindraje"  autocomplete required >
              </p>

              <p>
                <label>Tipo motor</label><br>
                <input type="text"  name="tipomotor" id="tipomotor" placeholder="Ingresa el Tipo de motor"  autocomplete required >
              </p>

              <p>
                <label>Propietario nombre</label><br>
                <input type="text"  name="propietario_nombre" id="propietario_nombre" placeholder="Ingresa el nombre"  autocomplete required >
              </p>

              <p>
                <label>Propietario direccion</label><br>
                <input type="text"  name="propietario_direccion" id="propietario_direccion" placeholder="Ingresa la direccion"  autocomplete required >
              </p>

            </div>


            <div class="botonesFormulario">
              <input type="submit" value="Registrar" id="buttonregistrar" class="botonRegistrar">
            </div>

                  
          </form>




          </div>
         
        </div>
      </div>

    </div>


    


     <!-- Modal delete -->
    <div class="modal" id="modaldelete" tabindex="-1">

      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Delete Motocicleta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
           
              <div class="contendedor_botones_borrado">

                <form id="borrarMotocicleta">

                    <div class="componentesFormulario">
                        
                      <input type="hidden"  name="id_motocicleta_borrar" id="id_motocicleta_borrar" placeholder="Ingresa la placa"  autocomplete required >
                      
                    </div>


                    <div class="botonesFormulario">
                      <input type="submit" value="Borrado Lógico" id="borradoLogico" class="botonRegistrar">
                      <input type="submit" value="Borrado Físico" id="borradoFisico" class="botonRegistrar">
                    </div>

                          
                </form>


              </div>
          </div>
          
        </div>
      </div>

    </div>



   
    

<script>
        

        function obtenerUsuarios() {
            $.ajax({
                type: "POST",
                url: "?controlador=Index&accion=obtenerMotocicletas",
                dataType: "json",
                success: function(response) {

                    // Limpiar la tabla antes de agregar nuevos datos
                    $("#containertabla tbody").empty();

                    // Recorrer la respuesta y agregar los datos a la tabla
                    $.each(response, function(index, motocicleta) {
                      
                      console.log(response);
                      
                            var row = $("<tr>");

                            
                            row.append($("<td>").text(motocicleta.placa));
                            row.append($("<td>").text(motocicleta.marca));
                            row.append($("<td>").text(motocicleta.modelo));
                            row.append($("<td>").text(motocicleta.anio));
                            row.append($("<td>").text(motocicleta.cilindraje));
                            row.append($("<td>").text(motocicleta.tipo_motor));
                            row.append($("<td>").text(motocicleta.propietario_nombre));
                            row.append($("<td>").text(motocicleta.propietario_direccion));
                     

                            var buttonUpdate = $("<button>")
                            .text("Update")
                            .attr("data-bs-toggle", "modal")
                            .attr("data-bs-target", "#modalupdate");

                            var buttonDelete = $("<button>")
                            .text("Delete")
                            .attr("data-bs-toggle", "modal")
                            .attr("data-bs-target", "#modaldelete");
                           
                            var tdButtons = $("<td>").append(buttonUpdate, buttonDelete);

                            

                            // Agregar los botones a la fila
                            row.append(tdButtons);
                        /*
                            // Agregar un controlador de eventos change al select
                            select.on("change", function() {
                                var nuevoRol = $(this).val();
                                var userEmail = usuario.email; // Obtener el email del usuario

                                // Llamar a una función para actualizar el rol en el servidor
                                actualizarRolEnServidor(userEmail, nuevoRol);

                                console.log("Nuevo rol seleccionado: " + nuevoRol);
                            });
                            */

                            $("#containertabla tbody").append(row);
                        
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error, xhr, status);
                }
            });
        }



        function actualizarRolEnServidor(userEmail,  nuevoRol) {

            var form_data = {
                email: userEmail,
                rol: nuevoRol
            };

            $.ajax({
                type: "POST",
                url: "?controlador=Index&accion=actualizarRol",
                dataType: "json",
                data: form_data,
                success: function(response) {
                    console.log(response)
                if (response==1) {
                    console.log("se actualizo correctamente")
                }

                },
                error: function(xhr, status, error) {
                    console.log(error, xhr, status);
                }
            });

        }


        obtenerUsuarios();

        

    </script>





<script src="public/js/registrarMotocicleta.js"></script>





<?php
include('public/footer.php');
?>