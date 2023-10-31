// Entra en accion cuando se presiona el botón "buscar"
$("#botonesFormulario_buscar").on("click", ".botonBuscar", function() {


    //hago las cosas solo si el input no esta vacio
    if($('#placa_a_buscar').val().trim() !== ''){
       
  
      //verifico que solo se ingresen valores numericos en placa
      if (/^\d*$/.test($('#placa_a_buscar').val()) ) {
  
        var databuscar = {
          placa:  $('#placa_a_buscar').val()
        };
  
  
        $.ajax({
          type: "POST",
          url: "?controlador=Index&accion=BuscarMotocicletaPorPlaca",
          data: databuscar,
          dataType: "json",
          success: function(response) {
  
            console.log(response);
  
            if (response[0].Mensaje  === 'No hay ninguna motocicleta activa con esa placa') {
  
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                title: 'No hay ninguna motocicleta activa con esa placa',
                confirmButtonColor: '#088cff'
              })
   
            } else {
  
              //limpio la tabla antes de agregar
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
                  .attr("data-bs-target", "#modalupdate");//atributo para que me abra el modal de bootstrap
  
                var tdButtons = $("<td>").append(buttonUpdate, buttonDeleteFisico, buttonDeleteLogico);
  
                  // Agregar los botones a la fila
                  row.append(tdButtons);
  
                  $("#containertabla tbody").append(row);
                });
                
             
            }//else
  
  
                
          },
            error: function(xhr, status, error) {
            console.log(error, xhr, status)
          }
  
  
        });
  
  
  
      } else {
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Ingresa solo valores numéricos para buscar',
      confirmButtonColor: '#088cff'
      })
      }
  
  
    }//if
  
    
    
  
  
  });
  
  // Entra en accion cuando se presiona el boton "mostrar todo"
  $("#botonesFormulario_mostrar_todo").on("click", ".butonmostrar_todo", function() {
  
    obtenerMotocicletas();
  
  });
  