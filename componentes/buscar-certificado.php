<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "../database/conexion.php";

// Obtiene el ID del certificado desde el formulario
$certificate_id = $_POST['certificate_id'];

// Crea la consulta para obtener los datos del certificado con el ID especificado, junto con el nombre del usuario y el nombre del curso
$query = "SELECT c.id, DATE_FORMAT(c.emision, '%d-%m-%Y') AS emision, c.id_curso, c.id_usuario, u.nombre as nombre, u.apellido as apellido, cr.nombre_curso
FROM certificados c
INNER JOIN usuarios u ON c.id_usuario = u.id
INNER JOIN cursos cr ON c.id_curso = cr.id
WHERE (c.id = '$certificate_id' OR u.id = '$certificate_id')";

// Ejecuta la consulta y guarda el resultado en una variable
$result = mysqli_query($conexion, $query);

// Verifica si se han encontrado resultados
if (mysqli_num_rows($result) > 0) {
    // Muestra los resultados debajo del ID del certificado
?>
<span style="text-align:center;color:white;display: flex;justify-content: center;margin: 15px 0;font-weight: 500;">Código o DNI Buscado: <?php echo $certificate_id; ?></span>
        <div class="card">
            <div class="card-body"> 
               <div class="table-responsive">
                                <?php
                                echo '<table id="miTabla" class="table align-items-center mb-0">';
                                echo '<thead>
                                  <tr>
                                    <th scope="col" width="240px">Codigo de Certificado</th>
                                    <th scope="col">Estudiante</th>
                                    <th scope="col">Curso Finalizado</th>
                                    <th scope="col">Emisión</th>
                                    <th scope="col" width="250px">Descargar Certificado</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                  while ($row = mysqli_fetch_assoc($result)) {
                                    $id_cert = $row['id'];
                                    $user_name = $row['nombre'] . " " . $row['apellido'];
                                    $course_name = $row['nombre_curso'];
                                    $emision = $row ['emision'];
                                    echo '<tr>';
                                    echo '<td>' . $id_cert . '</td>';
                                    echo '<td>' . $user_name . '</td>';
                                    echo '<td>' . $course_name . '</td>';
                                    echo '<td>' . $emision . '</td>';
                                    echo '<td><a href="/componentes/generar-certificado.php?id=' . $id_cert . '" class="btn btn-primary" target="_blank">Descargar certificado</a></td>';
                                    echo '</tr>';
                                  }
                                echo '</tbody>
                                </table>';
                                ?>
                </div>
            </div>
        </div>
        <?php
        } else {
          // Si no se han encontrado resultados, muestra un mensaje de error
          ?>
        <div class="card">
            <div class="card-body">
            <figure class="text-center">
                <blockquote class="blockquote">
                    <p style="padding-top:20px;color:black;font-weight:400">No se han encontrado resultados para el ID del certificado o DNI del estudiante ingresado.</p>
                </blockquote>
            </figure>
            </div>
        </div>
        <?php
        }
        
        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
    
?>    
