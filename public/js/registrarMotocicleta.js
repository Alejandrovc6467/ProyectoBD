

  document.getElementById('registarMotocicleta')
    .addEventListener('submit', function(event) {
      event.preventDefault();


      //verifico que en el input placa solo se ingresen numeros
      if (/^\d*$/.test($('#placa').val())) {

        console.log("si es un numero");

        var form_data = {
          placa: $('#placa').val(),
          marca: $('#marca').val(),
          modelo: $('#modelo').val(),
          anio: $('#anio').val(),
          cilindraje: $('#cilindraje').val(),
          tipomotor: $('#tipomotor').val(),
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
          text: 'Debes ingresar un valor numérico en la placa'
        })
      }
    });
