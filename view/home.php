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
          <input type="text"  name="tipo_motor" id="tipo_motor" placeholder="Ingresa el Tipo de motor"  autocomplete required >
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
        <input type="submit" value="Registrar" id="buttonregistrar" class="botonRegistrar" >
      </div>
      
            
    </form>

        
      
  </div>


  <div class="buscar">

    <div class="buscar_form_container">
      <div class="componentesFormulario_buscar">
        <label>Placa a buscar</label><br>
        <input type="text"  name="placa_a_buscar" id="placa_a_buscar" placeholder="Ingresa la placa"  autocomplete required >
      </div>

      <div class="botonesFormulario_buscar" id="botonesFormulario_buscar">
        <button value="Buscar" id="buttonbuscar" class="botonBuscar">Buscar</button>
      </div>
    </div>

    <div class="botonesFormulario_mostrar_todo" id="botonesFormulario_mostrar_todo">
      <button value="Mostrar" id="butonmostrar_todo" class="butonmostrar_todo">Mostrar todo</button>
    </div>
  
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
            


          <form id="updateMotocicleta">

            <div class="componentesFormulario">
                
              <p>
                <label>Placa</label><br>
                <input type="text"  name="placa_update" id="placa_update" placeholder="Ingresa la placa"  autocomplete required >
              </p>

              <p>
                <label>Marca</label><br>
                <input type="text"  name="marca_update" id="marca_update" placeholder="Ingresa la marca"  autocomplete required >
              </p>

              <p>
                <label>Modelo</label><br>
                <input type="text"  name="modelo_update" id="modelo_update" placeholder="Ingresa el modelo"  autocomplete required >
              </p>


              <p>
                <label>Año</label><br>
                <input type="text"  name="anio_update" id="anio_update" placeholder="Ingresa el año"  autocomplete required >
              </p>

              <p>
                <label>Cilindraje</label><br>
                <input type="text"  name="cilindraje_update" id="cilindraje_update" placeholder="Ingresa el cilindraje"  autocomplete required >
              </p>

              <p>
                <label>Tipo motor</label><br>
                <input type="text"  name="tipo_motor_update" id="tipo_motor_update" placeholder="Ingresa el Tipo de motor"  autocomplete required >
              </p>

              <p>
                <label>Propietario nombre</label><br>
                <input type="text"  name="propietario_nombre_update" id="propietario_nombre_update" placeholder="Ingresa el nombre"  autocomplete required >
              </p>

              <p>
                <label>Propietario direccion</label><br>
                <input type="text"  name="propietario_direccion_update" id="propietario_direccion_update" placeholder="Ingresa la direccion"  autocomplete required >
              </p>

            </div>


            <div class="botonesFormulario">
              <input type="submit" value="Actulizar" id="buttonactualizar" class="botonRegistrar">
            </div>

                  
          </form>




          </div>
         
        </div>
      </div>

</div>





   
   











  <!--mis js, podria llamarlas en el footer, pero en realidad solo necesito que se carguen estos .js solo cuando estoy en esta pagina no en todas, si fuera un .js que si necesito para todas las paginas pues ese si seria la mejor opcion ponerlo ahi-->
  <script src="public/js/registrarMotocicleta.js?578784"></script>
  <script src="public/js/deleteFisco_deleteLofico_update.js?9578784"></script>
  <script src="public/js/obtenerMotocicletas.js?1"></script>
  <script src="public/js/buscar.js?2"></script>






<?php
include('public/footer.php');
?>