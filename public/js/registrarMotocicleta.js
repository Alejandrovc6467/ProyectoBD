

  document.getElementById('registarMotocicleta')
    .addEventListener('submit', function(event) {
      event.preventDefault();//necesario cuando es un formulario


      //verifico que solo se ingresen valores numericos en cilindraje y anio
      if (/^\d*$/.test($('#placa').val()) && /^\d*$/.test($('#cilindraje').val()) && /^\d*$/.test($('#anio').val()) ) {

        console.log("si es un numero");

        var form_data = {
          placa: $('#placa').val(),
          marca: $('#marca').val(),
          modelo: $('#modelo').val(),
          anio: $('#anio').val(),
          cilindraje: $('#cilindraje').val(),
          tipo_motor: $('#tipo_motor').val(),
          propietario_nombre: $('#propietario_nombre').val(),
          propietario_direccion: $('#propietario_direccion').val(),
        
        };


       

        $.ajax({
          type: "POST",
          url: "?controlador=Index&accion=InsertarMotocicleta",
          data: form_data,
          dataType: "json",
          success: function(response) {

            console.log(response);

            
            
            if (response[0].Mensaje  === 'Placa ya registrada') {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                title: 'Placa ya registrada',
                confirmButtonColor: '#5A7099'
              })

             
            } else if(response[0].Mensaje  === 'Motocicleta registrada exitosamente') {

              obtenerMotocicletas();
              
              Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: 'Motocicleta registrada exitosamente',
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
          text: 'Debes ingresar valores numéricos en los campos Placa, Cilindraje y Año'
        })
      }
    });
