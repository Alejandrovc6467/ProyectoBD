
<?php
include('public/header.php');
include('public/menu.php');
?>
















<div class="home container"  data-aos="fade-right" data-aos-duration="1500">


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
        <input type="submit" value="registrar" id="buttonregistrar" class="botonRegistrar">
      </div>

            
    </form>

        
      
  </div>

            

</div>












<script>
  
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
                title: 'Placa ya registrada'
                color:'#f2f2f2',
                confirmButtonColor: '#5A7099',
              })

             
            } else if(response[0].Mensaje  === 'Motocicleta registrada exitosamente') {
              Swal.fire({
                icon: 'success',
                title: '¡Genial!',
                text: 'Motocicleta registrada exitosamente'
                color:'#f2f2f2',
                confirmButtonColor: '#5A7099',
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
</script>










<?php
include('public/footer.php');
?>