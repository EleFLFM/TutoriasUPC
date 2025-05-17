<?php
session_start();
require_once "../conexion.php";
// Verificar primero si viene por GET
if(isset($_GET['code'])) {
    $code = intval($_GET['code']);
    $_SESSION['current_course_code'] = $code; // Guardar en sesión para futuras cargas
} 
// Si no, verificar si está en sesión
elseif(isset($_SESSION['current_course_code'])) {
    $code = $_SESSION['current_course_code'];
} 
// Si no hay código, redirigir
else {
    header('Location: show_cursos.php');
    exit();
}
// Verificar si el estudiante ha visto todos los videos
$sql_videos = "SELECT COUNT(DISTINCT v.video_url) as total_videos 
               FROM (
                   SELECT video_url FROM video_views WHERE course_code = ?
                   UNION
                   SELECT video_url FROM videos_curso WHERE course_code = ?
               ) as v";
$stmt_videos = $conn->prepare($sql_videos);
$stmt_videos->bind_param("ii", $code, $code);
$stmt_videos->execute();
$total_videos = $stmt_videos->get_result()->fetch_assoc()['total_videos'];

$sql_vistos = "SELECT COUNT(DISTINCT video_url) as vistos 
               FROM video_views 
               WHERE course_code = ? AND usuario_id = ? AND visto = TRUE";
$stmt_vistos = $conn->prepare($sql_vistos);
$stmt_vistos->bind_param("ii", $code, $_SESSION['usuario_id']);
$stmt_vistos->execute();
$videos_vistos = $stmt_vistos->get_result()->fetch_assoc()['vistos'];

// Obtener docente del curso - Versión corregida
$docente_id = 0;
$docente_nombre = "Docente no asignado"; // Valor por defecto

$sql_docente = "SELECT u.id, u.nombre FROM docente_curso dc
                JOIN usuarios u ON dc.docente_id = u.id
                WHERE dc.course_code = ? LIMIT 1";
$stmt_docente = $conn->prepare($sql_docente);

if ($stmt_docente) {
    $stmt_docente->bind_param("i", $code);
    if ($stmt_docente->execute()) {
        $result_docente = $stmt_docente->get_result();
        if ($result_docente->num_rows > 0) {
            $docente = $result_docente->fetch_assoc();
            $docente_id = $docente['id'];
            $docente_nombre = $docente['nombre'];
        }
    }
    $stmt_docente->close();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tutorías UPC - Cálculo 2">
    <meta name="author" content="">

    <title>Cálculo 2 | Tutorias UPC</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php include "sidebar_student.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "topbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="left: 5%; position: relative;">
                    <div class="col-lg-9">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">¡Bienvenido a Cálculo 2!</h1>
                                <div class="copyright text-center my-auto">
                                    <span> 
                                        Domina las técnicas de integración y sus aplicaciones en problemas reales.
                                    </span>
                                </div>
                            </div>
                            <br>

                            <!-- Unidad 1: La Integral -->
                            <div class="card shadow mb-4">
                                <a href="#collapseUnit1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseUnit1">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-calculator mr-2"></i>Unidad 1: La Integral
                                    </h6>
  </a>
  <div class="collapse show" id="collapseUnit1">
      <div class="card-body">
    <div class="list-group">
        <a href="https://www.youtube.com/watch?v=kdtdn5_iAhI" 
        target="_blank" 
        class="list-group-item list-group-item-action video-link"
        data-video-id="kdtdn5_iAhI"
        data-course-code="<?= $code ?>">
                                           <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">1. Concepto de Antiderivación</h5>
  </div>
  <p class="mb-1">Antidiferenciación o Integración. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=JCIpAbNXiYk" 
   target="" 
   class="list-group-item list-group-item-action video-link"
   data-video-id="JCIpAbNXiYk"
   data-course-code="<?= $code ?>">
   <div class="d-flex w-100 justify-content-between align-items-center">
       <div>
           <h5 class="mb-1">2. Fórmulas básicas de integración</h5>
           <p class="mb-1">Reglas directas para integrar funciones elementales.</p>
       </div>
       <span class="video-status badge badge-light" style="display: none;">
           <i class="fas fa-check-circle text-success"></i> Visto
       </span>
   </div>
</a>

<a href="https://www.youtube.com/watch?v=v4OvY0eiZjQ" 
class="list-group-item list-group-item-action"
  data-video-id="v4OvY0eiZjQ"
  data-course-code="<?= $code ?>">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">3. Aplicación de fórmulas básicas</h5>
  </div>
  <p class="mb-1">Ejercicios con fórmulas básicas. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://youtu.be/Zaxr2cf5ACk?si=bdUMaX_CQNOPYmcO" 
 class="list-group-item list-group-item-action"
target="_blank"
  data-video-id="Zaxr2cf5ACk"
  data-course-code="<?= $code ?>">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">4. Integrales de funciones trigonométricas</h5>
  </div>
  <p class="mb-1">Seno, coseno, tangente y más. <span class="badge badge-primary">Video</span></p>
</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Unidad 2: Técnicas de Integración -->
                            <div class="card shadow mb-4">                             
                                <a href="#collapseUnit2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseUnit2">
                                    <h6 class="m-0 font-weight-bold text-success">
                                        <i class="fas fa-square-root-alt mr-2"></i>Unidad 2: Técnicas de Integración
                                    </h6>
                                </a>
                                <div class="collapse" id="collapseUnit2">
                                    <div class="card-body">
                                        <div class="list-group">
                                            <a href="https://www.youtube.com/watch?v=YrxsRJFifi8" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">1. Integración por sustitución</h5>
  </div>
  <p class="mb-1">Cambio de variable para simplificar la integral. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=19fPZdHnKzE" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">2. Integración por partes</h5>
  </div>
  <p class="mb-1">Técnica basada en la regla del producto. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=jb_zEZPEPSY" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">3. Potencias de funciones trigonométricas</h5>
  </div>
  <p class="mb-1">Ejemplos con sen²(x), cos³(x), etc. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=or5zBGwjW2s" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">4. Sustitución trigonométrica (con radical)</h5>
  </div>
  <p class="mb-1">Usos de identidades trigonométricas con raíces. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=jxDgqXEnOak&list=PL9SnRnlzoyX0xKKJEF2C3KQQnL3zT0ne0" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">5. Sustitución trigonométrica (sin radical)</h5>
  </div>
  <p class="mb-1">Casos donde no aparecen raíces explícitas. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=46W5iFX3uIk&list=PL9SnRnlzoyX2kl9anjMt84Dhoi3QRdoJW" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">6. Integrales con ax²+bx+c</h5>
  </div>
  <p class="mb-1">Integración de funciones racionales con polinomios cuadráticos. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=6pFmUh41jsQ&list=PLeySRPnY35dFylo7SabLBjsAx5MoepZyY" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">7. Fracciones parciales</h5>
  </div>
  <p class="mb-1">Descomposición de funciones racionales. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=LBGnVmYTAVQ" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">8. Funciones racionales de senx y cosx</h5>
  </div>
  <p class="mb-1">Técnicas específicas para sen/cos. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=JYpBv9jMLOk" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">9. Integrales impropias</h5>
  </div>
  <p class="mb-1">Integración en intervalos infinitos o con discontinuidades. <span class="badge badge-primary">Video</span></p>
</a>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Unidad 3: Integral Definida y Aplicaciones -->
                            <div class="card shadow mb-4">
                                <a href="#collapseUnit3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseUnit3">
                                    <h6 class="m-0 font-weight-bold text-warning">
                                        
                                        <i class="fas fa-chart-area mr-2"></i>Unidad 3: Integral Definida y Aplicaciones
                                    </h6>
                                </a>
                                <div class="collapse" id="collapseUnit3">
                                    <div class="card-body">
                                        <div class="list-group">
                                            <a href="https://www.youtube.com/watch?v=TocqVkBzDrA" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">1. Introducción a la integral definida</h5>
  </div>
  <p class="mb-1">Base teórica de las integrales definidas. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=zuo_qEBeZSM" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">2. Integral de Riemann</h5>
  </div>
  <p class="mb-1">Suma de Riemann y definición formal. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=kdtdn5_iAhI" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">3. Áreas por suma de Riemann</h5>
  </div>
  <p class="mb-1">Visualización del área bajo la curva. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://youtu.be/oJfipj5Oky4?si=LcN3mzKJIjwl_Lvd" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">4. Teorema fundamental del cálculo</h5>
  </div>
  <p class="mb-1">Relación entre derivada e integral. <span class="badge badge-primary">Video</span></p>
</a>
<a href="https://www.youtube.com/watch?v=U1vJ73VFz1E" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">5. Área de una región plana</h5>
  </div>
  <p class="mb-1">Usando integrales definidas para calcular áreas. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=s1BMqFdtZfM" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">6. Área bajo una curva</h5>
  </div>
  <p class="mb-1">Área bajo funciones continuas. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/watch?v=z-aYtb8_WJg" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">7. Área entre dos curvas</h5>
  </div>
  <p class="mb-1">Integral de la diferencia de funciones. <span class="badge badge-primary">Video</span></p>
</a>

<a href="https://www.youtube.com/playlist?list=PL9SnRnlzoyX0PTDHm5GXFN2a5K9vcH79h" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">8. Volumen de sólidos de revolución</h5>
  </div>
  <p class="mb-1">Método de discos y de casquillos. <span class="badge badge-primary">Video</span></p>
</a>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bibliografía -->
                            <div class="card shadow mb-4">
                                <a href="#collapseBibliography" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseBibliography">
                                    <h6 class="m-0 font-weight-bold text-info">
                                        <i class="fas fa-book mr-2"></i>Bibliografía Recomendada
                                    </h6>
                                </a>
                                <div class="collapse" id="collapseBibliography">
                                    <div class="card-body">
                                        <div class="list-group">
                                            <a href="https://universo-gratuito.blogspot.com/2013/03/matematicas-previas-al-calculo-3era.html" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Leithold, L. (1998)</h5>
  </div>
  <p class="mb-1">Matemáticas previas al cálculo. 3a ed. Harla, México. <span class="badge badge-info">Libro</span></p>
</a>

<a href="https://archive.org/details/CalculoConGeometriaAnaliticaEdwardsPenneySolucionario" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Edward y Penney (2002)</h5>
  </div>
  <p class="mb-1">Cálculo con Geometría analítica. Prentice Hall. <span class="badge badge-info">Libro</span></p>
</a>

<a href="https://www.academia.edu/15156764/Calculo_9na_Edicion_Purcell_Varberg_Rigdon" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Purcell, E. (2007)</h5>
  </div>
  <p class="mb-1">Cálculo. 9a ed. Prentice Hall, México. <span class="badge badge-info">Libro</span></p>
</a>

<a href="https://www.academia.edu/117885432/Hacia_la_matem%C3%A1tica_un_enfoque_estructurado" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Takeuchi, Y. et al. (1983)</h5>
  </div>
  <p class="mb-1">Hacia la matemática: un enfoque estructurado. Grupo Editorial Andino. <span class="badge badge-info">Libro</span></p>
</a>

<a href="#" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Leithold, L. (2008)</h5>
  </div>
  <p class="mb-1">El cálculo con geometría analítica. 7a ed. Oxford University, México. <span class="badge badge-info">Libro</span></p>
</a>

<a href="https://www.academia.edu/31719892/Calculo_Tom_Apostol_Vol_1" target="_blank" class="list-group-item list-group-item-action">
  <div class="d-flex w-100 justify-content-between">
    <h5 class="mb-1">Apostol, T. (1988)</h5>
  </div>
  <p class="mb-1">Cálculo, tomo I. Editorial Reverte S.A., España. <span class="badge badge-info">Libro</span></p>
</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
<!-- Sección de Comentarios -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-comments mr-2"></i>Valoración del Docente
        </h6>
    </div>
    <div class="card-body">
      <!-- En la sección donde muestras el progreso -->
<div class="alert alert-info">
    <h5>Progreso del Curso</h5>
    <div class="progress mb-2">
        <div class="progress-bar progress-bar-striped" role="progressbar" 
             style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <p class="progress-text mb-0">0/0 videos vistos</p>
</div>
<!-- Sección de Comentarios -->
<div id="seccion-comentarios" style="<?= ($videos_vistos >= $total_videos) ? '' : 'display: none;' ?>">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-comments mr-2"></i>Valoración del Docente
            </h5>
        </div>
        <div class="card-body">
            <?php
            if ($total_videos > 0 && $videos_vistos >= $total_videos) {
                // Verificar si ya ha comentado
                $sql_comentario = "SELECT * FROM comentarios_docentes 
                                 WHERE course_code = ? AND docente_id = ? 
                                 AND usuario_id = ?";
                $stmt_comentario = $conn->prepare($sql_comentario);
                $stmt_comentario->bind_param("iii", $code, $docente_id, $_SESSION['usuario_id']);
                $stmt_comentario->execute();
                $ya_comento = $stmt_comentario->get_result()->num_rows > 0;
                
                if ($ya_comento) {
                    echo '<div class="alert alert-success">¡Gracias por tu feedback! Tu comentario ha sido registrado de forma anónima.</div>';
                } else {
                    // Mostrar formulario para comentar
                    echo '<div class="mb-3">
                            <h5>Valora a tu docente: '.htmlspecialchars($docente_nombre).'</h5>
                            <p>Has completado todos los materiales del curso. Por favor, comparte tu experiencia.</p>
                          </div>
                          <form id="formComentario">
                            <input type="hidden" name="docente_id" value="'.$docente_id.'">
                            <input type="hidden" name="course_code" value="'.$code.'">
                            <input type="hidden" name="usuario_id" value="'.$_SESSION['usuario_id'].'">
                            
                            <div class="form-group">
                                <label>Calificación (1-5 estrellas)</label>
                                <div class="rating-stars mb-2">
                                    <i class="far fa-star" data-rating="1"></i>
                                    <i class="far fa-star" data-rating="2"></i>
                                    <i class="far fa-star" data-rating="3"></i>
                                    <i class="far fa-star" data-rating="4"></i>
                                    <i class="far fa-star" data-rating="5"></i>
                                    <input type="hidden" name="calificacion" id="calificacion" value="0">
                                </div>
                            </div>
                            
                            <div class="form-group">
    <label for="comentario" class="font-weight-bold">Comentario (opcional)</label>
    <textarea class="form-control" id="comentario" name="comentario"
              rows="6" placeholder="Escribe tu comentario aquí..."
              style="min-height: 150px; resize: vertical; font-size: 16px; line-height: 1.6;"></textarea>
</div>
                            
                            <button type="submit" class="btn btn-primary mt-3">
                                <i class="fas fa-paper-plane mr-1"></i> Enviar Valoración
                            </button>
                          </form>';
                }
            } else {
                $porcentaje = $total_videos > 0 ? round(($videos_vistos / $total_videos) * 100) : 0;
                echo '<div class="alert alert-info">
                        <h5>Progreso del Curso: '.$porcentaje.'% completado</h5>
                        <div class="progress mb-3">
                            <div class="progress-bar" role="progressbar" style="width: '.$porcentaje.'%" 
                                 aria-valuenow="'.$porcentaje.'" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p>Podrás valorar a tu docente cuando hayas visto todos los materiales del curso ('.$videos_vistos.'/'.$total_videos.' videos vistos).</p>
                      </div>';
            }
            ?>
        </div>
    </div>
</div>

<style>
.rating-stars { 
    font-size: 24px; 
    cursor: pointer; 
    color: #ddd;
}
.rating-stars .fas, 
.rating-stars .hover { 
    color: gold; 
}
</style>

<script>
$(document).ready(function() {
    // Manejar estrellas de calificación
    $(".rating-stars i").hover(
        function() {
            $(this).addClass('hover');
            $(this).prevAll().addClass('hover');
        },
        function() {
            $(".rating-stars i").removeClass('hover');
        }
    );
    
    $(".rating-stars i").click(function() {
        const rating = $(this).data("rating");
        $("#calificacion").val(rating);
        $(".rating-stars i").removeClass('fas far');
        
        $(".rating-stars i").each(function() {
            if ($(this).data("rating") <= rating) {
                $(this).addClass("fas");
            } else {
                $(this).addClass("far");
            }
        });
    });
    
    // Enviar formulario
    $("#formComentario").submit(function(e) {
        e.preventDefault();
        
        if ($("#calificacion").val() == "0") {
            Swal.fire({
                icon: "warning",
                title: "Calificación requerida",
                text: "Por favor selecciona una calificación",
                confirmButtonColor: "#3085d6"
            });
            return;
        }
        
        $.ajax({
            url: "guardar_comentario.php",
            method: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "¡Gracias!",
                        text: response.message || "Tu comentario ha sido registrado de forma anónima.",
                        confirmButtonColor: "#3085d6",
                        allowOutsideClick: false
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response.message || "Ocurrió un error al guardar tu comentario",
                        confirmButtonColor: "#3085d6"
                    });
                }
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Error de conexión",
                    text: "Ocurrió un problema al comunicarse con el servidor",
                    confirmButtonColor: "#3085d6"
                });
                console.error("Error:", xhr.responseText);
            }
        });
    });
});
</script>
        
</div>
                            <a href="show_cursos.php" class="btn btn-secondary btn-icon-split">
                                <span class="icon text-white-50">
                                    <i class="fas fa-arrow-left"></i>
                                </span>
                                
                                <span class="text">Regresar</span>
                            </a>
                        </div>
                        
                    </div>
                    
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php" ?>
                <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

  

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Verificar progreso al cargar la página
    checkProgress();

    // Manejar clic en videos - Versión mejorada
    $(document).on('click', '.video-link', function(e) {
        e.preventDefault();
        const $link = $(this);
        const videoUrl = $link.attr('href');
        
        // Crear elemento de estado si no existe
        let $status = $link.find('.video-status');
        if ($status.length === 0) {
            $status = $('<span class="video-status badge badge-light ml-2"></span>');
            $link.append($status);
        }
        
        $status.show().html('<i class="fas fa-spinner fa-spin"></i>');
        
        // Abrir el video inmediatamente en nueva pestaña
        const videoTab = window.open(videoUrl, '_blank');
        
        // Registrar la visualización
        $.ajax({
            url: 'registrar_video.php',
            method: 'POST',
            dataType: 'json', // Asegurar que esperamos JSON
            data: { 
                video_url: videoUrl, 
                video_id: $link.data('video-id'), 
                course_code: $link.data('course-code') 
            },
            success: function(response) {
                if (response && response.success) {
                    $status.html('<i class="fas fa-check-circle text-success"></i> Visto');
                    checkProgress();
                } else {
                    $status.html('<i class="fas fa-exclamation-circle text-warning"></i> No registrado');
                    console.error('Error en la respuesta:', response);
                }
            },
            error: function(xhr, status, error) {
                $status.html('<i class="fas fa-exclamation-circle text-danger"></i> Error');
                console.error('Error en la solicitud:', error);
                // Mostrar error al usuario si es necesario
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo registrar tu progreso, pero el video se abrió correctamente.',
                    confirmButtonColor: '#3085d6'
                });
            }
        });
    });

    // Función mejorada para verificar progreso
    function checkProgress() {
        const courseCode = <?= $code ?>;
        
        $.ajax({
            url: 'obtener_progreso_curso.php',
            method: 'POST',
            dataType: 'json',
            data: { course_code: courseCode },
            success: function(response) {
                if (response && response.success) {
                    // Calcular porcentaje con protección contra división por cero
                    const totalVideos = response.total || 1; // Evitar división por cero
                    const videosVistos = response.vistos || 0;
                    const porcentaje = Math.round((videosVistos / totalVideos) * 100);
                    
                    // Actualizar UI
                    $('.progress-bar')
                        .css('width', porcentaje + '%')
                        .attr('aria-valuenow', porcentaje)
                        .text(porcentaje + '%');
                    
                    $('.progress-text').html(
                        `<strong>Progreso:</strong> ${videosVistos}/${totalVideos} videos vistos (${porcentaje}%)`
                    );
                    
                    // Mostrar sección de comentarios si completó todos
                    if (videosVistos >= totalVideos && totalVideos > 0) {
                        $('#seccion-comentarios').fadeIn();
                    }
                } else {
                    console.error('Respuesta inválida:', response);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al verificar progreso:', error);
                $('.progress-text').html(
                    '<span class="text-danger">Error al cargar el progreso</span>'
                );
            }
        });
    }

     $(".rating-stars i").on('mouseenter', function() {
        const rating = $(this).data('rating');
        $(this).addClass('fas hover').prevAll().addClass('fas hover');
        $(this).nextAll().removeClass('fas hover').addClass('far');
    }).on('mouseleave', function() {
        updateStarsDisplay();
    }).on('click', function() {
        $("#calificacion").val($(this).data('rating'));
        updateStarsDisplay();
    });

    function updateStarsDisplay() {
        const rating = $("#calificacion").val();
        $(".rating-stars i").each(function() {
            $(this).removeClass('fas far hover');
            $(this).addClass($(this).data('rating') <= rating ? 'fas' : 'far');
        });
    }

    // Formulario mejorado con reintentos
    $("#formComentario").submit(function(e) {
        e.preventDefault();
        const form = $(this);
        const submitBtn = form.find('button[type="submit"]');
        
        if ($("#calificacion").val() == "0") {
            Swal.fire({
                icon: "warning",
                title: "Falta calificación",
                text: "Por favor selecciona una calificación con las estrellas",
                confirmButtonColor: "#4e73df"
            });
            return;
        }

        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Enviando...');

        // Función con reintento
        function submitForm(attempts = 3) {
            $.ajax({
                url: "guardar_comentario.php",
                method: "POST",
                data: form.serialize(),
                dataType: "json",
                timeout: 5000, // 5 segundos de timeout
                success: function(response) {
                    if (response && response.success) {
                        Swal.fire({
                            icon: "success",
                            title: "¡Gracias!",
                            text: "Tu valoración se guardó correctamente",
                            confirmButtonColor: "#4e73df"
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        showError(response?.message || "Error al guardar");
                    }
                },
                error: function(xhr, status, error) {
                    if (attempts > 1) {
                        submitForm(attempts - 1); // Reintentar
                    } else {
                        showError("No se pudo conectar con el servidor. Intenta más tarde.");
                    }
                }
            });
        }

        function showError(message) {
            submitBtn.prop('disabled', false).html('<i class="fas fa-paper-plane"></i> Enviar Valoración');
            Swal.fire({
                icon: "error",
                title: "Error",
                text: message,
                confirmButtonColor: "#e74a3b"
            });
        }

        submitForm(); // Primer intento
    });
});
</script>
</body>
</html>