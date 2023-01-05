<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/logoap.png">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Verificación de Certificados | Acreditaciones Profesionales</title>
</head>
<body>
    <div class="menu">
        <a href="login" id="login"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M20.5,15.1a1,1,0,0,0-1.34.45A8,8,0,1,1,12,4a7.93,7.93,0,0,1,7.16,4.45,1,1,0,0,0,1.8-.9,10,10,0,1,0,0,8.9A1,1,0,0,0,20.5,15.1ZM21,11H11.41l2.3-2.29a1,1,0,1,0-1.42-1.42l-4,4a1,1,0,0,0-.21.33,1,1,0,0,0,0,.76,1,1,0,0,0,.21.33l4,4a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42L11.41,13H21a1,1,0,0,0,0-2Z"/></svg> Acceder</a>
    </div>
    <div class="container">  
        <div class="search-certificated">
            <img class="logo" src="assets/img/logo-ap-white.png"/>
            <h1>Verificación de Certificados</h1><br>     
            <p>Busca tu certificado solo con tu Código de certificado o tu DNI</p>
            <form id="search-form" method="post">
                <div class="input-group mb-3 form-search">
                    <input type="text" class="form-control" name="certificate_id" id="certificate_id" placeholder="Ingresar codigo de certificado" aria-label="Ingresar codigo de certificado" aria-describedby="button-addon2" required>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>                    
                </div>
            </form>
            <div id="results"></div>
        </div>
        <div class="copy">
            <p> Copyright© 2022 Acreditaciones Profesionales | Todos los derechos reservados</p>
        </div>            
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        // Obtiene el formulario de búsqueda
        const form = document.getElementById("search-form");

        // Agrega un manejador de evento al formulario para procesar la búsqueda cuando se envíe
        form.addEventListener("submit", function(event) {
            // Evita que se recargue la página
            event.preventDefault();

        // Obtiene el ID del certificado desde el formulario
        const certificateId = document.getElementById("certificate_id").value;

        // Realiza una llamada AJAX al archivo PHP de procesamiento de la búsqueda
        fetch("componentes/buscar-certificado.php", {
        method: "POST",
        body: new URLSearchParams("certificate_id=" + certificateId)
        })
        .then(response => response.text())
        .then(data => {
            // Muestra los resultados en el elemento con id "results"
            document.getElementById("results").innerHTML = data;
        });
        });
        });
    </script>
</body>
</html>