<?php

include "../database/conexion.php";

// Obtiene el ID del certificado desde el formulario
$certificate_id = $_POST['certificate_id'];

// Crea la consulta para obtener los datos del certificado con el ID especificado, junto con el nombre del usuario y el nombre del curso
$query = "SELECT c.id, c.id_curso, c.id_usuario, u.nombre as nombre, u.apellido as apellido, cr.nombre_curso
FROM certificados c
INNER JOIN usuarios u ON c.id_usuario = u.id
INNER JOIN cursos cr ON c.id_curso = cr.id
WHERE c.id = '$certificate_id'";

// Ejecuta la consulta y guarda el resultado en una variable
$result = mysqli_query($conexion, $query);

// Verifica si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
    // Muestra los resultados debajo del ID del certificado
    echo "<p style='font-weight: 600'>Codigo encontrado: $certificate_id</p>";
    while ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['nombre'] . " " . $row['apellido'];
        $course_name = $row['nombre_curso'];
        ?>
        <div class="card">
            <div class="card-body"> 
                <div class="table-responsive" >                   
                    <table class="table table-bordered" style="margin:0">
                            <thead>
                                <tr>
                                <th scope="col">Codigo de Certificado</th>
                                <th scope="col">Estudiante</th>
                                <th scope="col">Curso Finalizado</th>
                            </thead>
                            <tbody>
                                <?php                    
                                    echo '<tr>';
                                    echo '<td>' . $certificate_id . '</td>';
                                    echo '<td>' . $user_name . '</td>';
                                    echo '<td>' . $course_name . '</td>';
                                    echo '</tr>';
                                ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
          }
        } else {
          // Si no se han encontrado resultados, muestra un mensaje de error
          ?>
        <div class="card">
            <div class="card-body">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p style="padding-top:20px;color:black;font-weight:400">No se han encontrado resultados para el ID del certificado especificado.</p>
                </blockquote>
            </figure>
            </div>
        </div>
        <?php
        }
        
        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
    
?>    
