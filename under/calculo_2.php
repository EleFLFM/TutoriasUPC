<?php
session_start();
require_once "../conexion.php";

// Verificar parámetros GET (solo para identificar el curso)
$code = isset($_GET['code']) ? intval($_GET['code']) : 0;
if($code === 0) {
    header('Location: show_cursos.php');
    exit();
}

// Verificar usuario logueado
if(!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit();
}
$usuario_id = $_SESSION['usuario_id'];

// Procesar comentario si se envió el formulario
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    $comentario = trim($_POST['comentario']);
    
    // Validar comentario
    if(strlen($comentario) >= 10) {
        // Verificar matrícula del usuario en el curso
        $sql_verificar = "SELECT 1 FROM estudiante_curso WHERE usuario_id = ? AND course_code = ?";
        $stmt_verificar = $conn->prepare($sql_verificar);
        $stmt_verificar->bind_param("ii", $usuario_id, $code);
        $stmt_verificar->execute();
        $puede_comentar = $stmt_verificar->get_result()->num_rows > 0;
        
        if($puede_comentar) {
            // Insertar comentario
            $sql = "INSERT INTO comentarios_cursos (usuario_id, course_code, comentario, fecha_creacion) 
                    VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $usuario_id, $code, $comentario);
            
            if($stmt->execute()) {
                $_SESSION['comentario_exito'] = "¡Gracias! Tu comentario ha sido registrado.";
            } else {
                $_SESSION['comentario_error'] = "Error al guardar el comentario. Intenta nuevamente.";
            }
        } else {
            $_SESSION['comentario_error'] = "No estás matriculado en este curso.";
        }
    } else {
        $_SESSION['comentario_error'] = "El comentario debe tener al menos 10 caracteres.";
    }
    
    // Redirigir para evitar reenvío del formulario
    header("Location: calculo_2.php?code=$code");
    exit();
}

// Mostrar mensajes de éxito/error
$mensaje_exito = isset($_SESSION['comentario_exito']) ? $_SESSION['comentario_exito'] : '';
$mensaje_error = isset($_SESSION['comentario_error']) ? $_SESSION['comentario_error'] : '';
unset($_SESSION['comentario_exito'], $_SESSION['comentario_error']);
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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                                    <span>Domina las técnicas de integración y sus aplicaciones en problemas reales.</span>
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
                                    <h5 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-comments mr-2"></i>Envía tu retroalimentación
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if($mensaje_exito): ?>
                                        <div class="alert alert-success"><?= $mensaje_exito ?></div>
                                    <?php endif; ?>
                                    
                                    <?php if($mensaje_error): ?>
                                        <div class="alert alert-danger"><?= $mensaje_error ?></div>
                                    <?php endif; ?>
                                    
                                    <form method="POST" action="calculo_2.php?code=<?= $code ?>">
                                        <div class="form-group">
                                            <label for="comentario" class="font-weight-bold">Tu comentario:</label>
                                             <textarea class="form-control" id="comentario" name="comentario"
              style="min-height: 150px; width: 100%; padding: 15px; font-size: 16px; line-height: 1.6; resize: vertical;"
              placeholder="Escribe tu retroalimentación sobre este curso..."
              required minlength="10"></textarea>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-paper-plane mr-1"></i> Enviar Comentario
                                        </button>
                                    </form>
                                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
    // Mostrar alertas si hay mensajes
    $(document).ready(function() {
        <?php if($mensaje_exito): ?>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?= addslashes($mensaje_exito) ?>',
                confirmButtonColor: '#3085d6'
            });
        <?php endif; ?>
        
        <?php if($mensaje_error): ?>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '<?= addslashes($mensaje_error) ?>',
                confirmButtonColor: '#3085d6'
            });
        <?php endif; ?>
    });
    </script>
</body>
</html>