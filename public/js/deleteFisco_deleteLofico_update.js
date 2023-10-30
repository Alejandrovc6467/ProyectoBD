
// Entra en accion cuando se presiona el botón "Update boton"
$("#containertabla").on("click", ".update-button", function() {


  //seteo los input de mi modal con la data que viene con el boton update, por eso el $(this).data("propietario_direccion") dentro del .val()
  $('#placa_update').val($(this).data("placa"));
  $('#marca_update').val($(this).data("marca"));
  $('#modelo_update').val($(this).data("modelo"));
  $('#anio_update').val($(this).data("anio"));
  $('#cilindraje_update').val($(this).data("cilindraje"));
  $('#tipo_motor_update').val($(this).data("tipo_motor"));
  $('#propietario_nombre_update').val($(this).data("propietario_nombre"));
  $('#propietario_direccion_update').val($(this).data("propietario_direccion"));

  $('#placa_update').prop('readonly', true);  // Establece el atributo "readonly" para hacer el campo no editable, (No quiero qu se edite la placa en mi modal)


});




//funcion que entra en accion cuando se presiona el boton submit de actualizar
document.getElementById('updateMotocicleta')
    .addEventListener('submit', function(event) {
      event.preventDefault();//necesario cuando es un formulario


      //verifico que solo se ingresen valores numericos en cilindraje y anio
      if (/^\d*$/.test($('#cilindraje').val()) && /^\d*$/.test($('#anio').val()) ) {

        
        var form_data = {
          placa: $('#placa_update').val(),
          marca: $('#marca_update').val(),
          modelo: $('#modelo_update').val(),
          anio: $('#anio_update').val(),
          cilindraje: $('#cilindraje_update').val(),
          tipo_motor: $('#tipo_motor_update').val(),
          propietario_nombre: $('#propietario_nombre_update').val(),
          propietario_direccion: $('#propietario_direccion_update').val(),
        
        };


       

        $.ajax({
          type: "POST",
          url: "?controlador=Index&accion=ActualizarMotocicleta",
          data: form_data,
          dataType: "json",
          success: function(response) {

            console.log(response);

            
            
            if (response[0].Mensaje  === 'Ha ocurrido un error al actualizar') {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                title: 'Ha ocurrido un error al actualizar',
                confirmButtonColor: '#5A7099'
              })

             
            } else if(response[0].Mensaje  === 'Actualización realizada con éxito') {

              obtenerMotocicletas();
              
              Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: 'Actualización realizada con éxito',
                confirmButtonColor: '#5A7099'
              })
            }


            
          },
          error: function(xhr, status, error) {
            console.log(error, xhr, status)
          }
        });

      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Debes ingresar valores numéricos en los campos Cilindraje y Año'
        })
      }


});





// Entra en accion cuando se presiona el botón "Delete Físico"
$("#containertabla").on("click", ".delete-fisico-button", function() {


    
    var placaDefila = $(this).data("placa");



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




// Entra en accion cuando se presiona el botón "Delete Lógico" 
$("#containertabla").on("click", ".delete-logico-button", function() {

  
  var p = $(this).data("placa");


  var form_datalogico = {
    placa: p
  };


  $.ajax({
    type: "POST",
    url: "?controlador=Index&accion=BorradoMotocicletaLogico",
    data: form_datalogico,
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
