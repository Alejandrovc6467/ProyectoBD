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


    


   
    

<script>

 

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
                    .text("Delete Físico")
                    .attr("class", "delete-fisico-button")
                    .data("placa", motocicleta.placa);

                var buttonDeleteLogico = $("<button>")
                    .text("Delete Lógico")
                    .attr("class", "delete-logico-button")
                    .data("placa", motocicleta.placa);

                var buttonUpdate = $("<button>")
                    .text("Update")
                    .attr("data-bs-toggle", "modal")
                    .data("placa", motocicleta.placa)
                    .data("marca", motocicleta.marca)
                    .data("modelo", motocicleta.modelo)
                    .data("anio", motocicleta.anio)
                    .data("cilindraje", motocicleta.cilindraje)
                    .data("tipo_motor", motocicleta.tipo_motor)
                    .data("propietario_nombre", motocicleta.plpropietario_nombreaca)
                    .data("propietario_direccion", motocicleta.propietario_direccion)
                    .attr("data-bs-target", "#modalupdate");//atributo para que me abra el modal de bootstrap

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





// Agregar manejador de eventos para el botón "Delete Físico" que muestra una alerta
$("#containertabla").on("click", ".delete-fisico-button", function() {


    // Mostrar una alerta con información sobre la fila
    var placaDefila = $(this).data("placa");
    alert("Borrado Físico para la Placa: " + placa);



    var form_data = {
      placa: placaDefila
    };


    $.ajax({
      type: "POST",
      url: "?controlador=Index&accion=borradoMotocicletafisico",
      data: form_data,
      dataType: "json",
      success: function(response) {

        console.log(response);

            
            
        if (response[0].Mensaje  === 'No se encontró ninguna motocicleta con la placa especificada') {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                title: 'No se encontró ninguna motocicleta con la placa especificada',
                confirmButtonColor: '#5A7099'
              })

             
        } else if(response[0].Mensaje  === 'Borrado realizado con éxito') {



              Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: 'Borrado realizado con éxito',
                confirmButtonColor: '#5A7099'
              })

              obtenerMotocicletas();
        }


            
        },
          error: function(xhr, status, error) {
          console.log(error, xhr, status)
        }

    });




});

// Agregar manejador de eventos para el botón "Delete Lógico" que muestra una alerta
$("#containertabla").on("click", ".delete-logico-button", function() {

    // Mostrar una alerta con información sobre la fila
    var placa = $(this).data("placa");
    alert("Borrado Lógico para la Placa: " + placa);



    var form_data = {
      placa: placaDefila
    };


    $.ajax({
      type: "POST",
      url: "?controlador=Index&accion=BorradoMotocicletaLogico",
      data: form_data,
      dataType: "json",
      success: function(response) {

        console.log(response);

            
            
        if (response[0].Mensaje  === 'No se encontró ninguna motocicleta con la placa especificada') {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                title: 'No se encontró ninguna motocicleta con la placa especificada',
                confirmButtonColor: '#5A7099'
              })

             
        } else if(response[0].Mensaje  === 'Borrado realizado con éxito') {



              Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: 'Borrado realizado con éxito',
                confirmButtonColor: '#5A7099'
              })

              obtenerMotocicletas();
        }


            
        },
          error: function(xhr, status, error) {
          console.log(error, xhr, status)
        }

    });


});





obtenerMotocicletas();




 
        

</script>










<?php
include('public/footer.php');
?>