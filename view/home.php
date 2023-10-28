
<?php
include('public/header.php');
include('public/menu.php');
?>
















<div class="home container"  data-aos="fade-right" data-aos-duration="1500">


   
<div class="registrarse">


<h5>Ingrese los siguientes datos para poder continuar y subir tus documentos</h5>

<div class="registrarse_form">

  <h4>Ingresa tus datos</h4>

  <form id="registarMotocicleta">

    <div class="txt_field_registrarse">
      <input type="text" name="nombre" id="nombre">
      <span></span>
      <label>Nombre:</label>
    </div>
    
    <div class="txt_field_registrarse">
      <input type="text" name="apellidos" id="apellidos">
      <span></span>
      <label>Apellidos:</label>
    </div>

    <div class="txt_field_registrarse">
      <input type="text" name="institucion" id="institucion">
      <span></span>
      <label>Institución:</label>
    </div>

    <div class="txt_field_registrarse">
      <input type="email" name="reply_to" id="reply_to">
      <span></span>
      <label>Correo:</label>
    </div>

    <div class="txt_field_registrarse">
      <input type="password" id="password">
      <span></span>
      <label>Contraseña:</label>
    </div>

    <div class="txt_field_registrarse">
      <input name="password" id="confirm_password" type="password">
      <span></span>
      <label>Confirmar Contraseña:</label>
    </div>

    <input type="submit" value="Registrarse" id="button">

  </form>

</div>

</div>

            

</div>












<script>
  const btn = document.getElementById('button');

  document.getElementById('registarMotocicleta')
    .addEventListener('submit', function(event) {
      event.preventDefault();

      //aqui debo  de quitar este de la contrasenia y verificar que solo se escriban numeros en el input de la placa
      if ($('#password').val() === $('#confirm_password').val()) {
        var form_data = {
          email: $('#reply_to').val(),
          password: $('#password').val(),
          nombre: $('#nombre').val(),
          apellidos: $('#apellidos').val(),
          institucion: $('#institucion').val(),
        
        };


       

        $.ajax({
          type: "POST",
          url: "?controlador=Index&accion=InsertarMotocicleta",
          data: form_data,
          dataType: "json",
          success: function(response) {

            console.log(response);

            
            /*
            if (response[0].resultado !== "0") {
              Swal.fire({
                icon: 'success',
                title: 'Se registro con exito, verifique su correo para activar la cuenta'
              })

              btn.value = 'Sending...';

              const serviceID = 'default_service';
              const templateID = 'template_2sapvvh';

              emailjs.sendForm(serviceID, templateID, document.getElementById('signin-form'))
                .then(() => {
                  btn.value = 'Send Email';
                  alert('Sent!');
                }, (err) => {
                  btn.value = 'Send Email';
                  alert(JSON.stringify(err));
                });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Ocurrio un error'
              })
            }
            */
          },
          error: function(xhr, status, error) {
            console.log(error, xhr, status)
          }
        });
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: 'Las contraseñas no coinciden'
        })
      }
    });
</script>










<?php
include('public/footer.php');
?>