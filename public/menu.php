

<header>

   

    <nav class="navbar fixed-top navbar-expand-lg bg-light" id="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">MotoCRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
               
               <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Actions
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="?controlador=Index&accion=mostrar">Exit</a></li>
                    </ul>
                </li>

               
            </ul>
           
            </div>
        </div>
    </nav>

</header>




<script>

/*
//objectivo: mantener fijada el navbar una vez que el banner se oculte (esto era en el proyecto de horas, aqui no lo necesito)
//sin este codigo eso no sucedia

document.addEventListener("DOMContentLoaded", function() {
    const navbar = document.getElementById("navbar");
    const banner = document.getElementById("banner");

    // Función para verificar si el banner está oculto
    function isBannerHidden() {
        const rect = banner.getBoundingClientRect();
        return rect.bottom <= 0;
    }

    // Función para fijar o soltar la barra de navegación y agregar margen al banner
    function fixNavbarAndMargin() {
        if (isBannerHidden()) {
            // Banner está oculto, fija la barra de navegación
            navbar.style.position = "fixed";
            navbar.style.top = "0";
            navbar.style.width = "100%";
            navbar.style.zIndex = "70";

            // Agrega margen inferior al banner para que tenga la misma altura que la navbar (esto para que no haga ese salto)
            banner.style.marginBottom = navbar.offsetHeight + "px";
        } else {
            // Banner es visible, restaura la posición normal de la barra de navegación y elimina el margen inferior
            navbar.style.position = "static"; // Opcionalmente, puedes usar "relative" u otra posición según tus necesidades
            banner.style.marginBottom = "0";
        }
    }

    // Escucha el evento scroll y llama a la función
    window.addEventListener("scroll", fixNavbarAndMargin);
});
*/

</script>