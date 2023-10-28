
  $(document).ready(function() {
      $("#formsubirdocumento").on("submit", function(e) {
        e.preventDefault(); // Evita el comportamiento predeterminado de enviar el formulario.

        // Recopila los datos del formulario.
        var formData = new FormData(this);

        
        // Obtén el valor del campo de entrada con ID "nombre".
        var temadocumento = $("#temadocumento").val();
        var email_user = $("#email_user").val();


        // Agrega el valor a formData con una clave específica.
        formData.append("temadocumento", temadocumento);
        formData.append("email_user", email_user);


        // Realiza la solicitud AJAX para procesar el formulario.
        $.ajax({
          url: "?controlador=Index&accion=subirdocumento", // Ruta al archivo PHP que maneja el formulario.
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {

            console.log(response);

            if(response.message === "1"){

                $('#inputfile').val('');//si todo sale bien reseteo el input del file

                Swal.fire({
                    icon: 'success',
                    title: '¡Genial!',
                    text: 'Documento subido correctamente',
                    confirmButtonColor: '#2980B9',
                });


            }else if (response.message === "2") {

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'El archivo no es de un tipo permitido como los siguientes (.pdf, .doc, .docx, .odt)',
                    confirmButtonColor: '#2980B9',
                });

               
            } else{

                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Ha ocurrido un error, intenta de nuevo.',
                    confirmButtonColor: '#2980B9',
                });

            }
            

        } 

        });
      });
  });

