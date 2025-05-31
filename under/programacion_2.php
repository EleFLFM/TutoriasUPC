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
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Tutorías UPC - Programación 2">
    <meta name="author" content="">

    <title>Programación 2 | Tutorias UPC</title>

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
                                <h1 class="h4 text-gray-900 mb-4">¡Bienvenido a Programación 2!</h1>
                                <div class="copyright text-center my-auto">
                                    <span> 
                                        Aquí encontrarás todos los elementos y temas de las clases. ¡Aprende y diviértete!
                                    </span>
                                </div>
                            </div>
                            <br>

                            <!-- Primer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseFirstCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseFirstCut">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-code mr-2"></i>Primer Corte - Fundamentos Avanzados
        </h6>
    </a>
    <div class="collapse show" id="collapseFirstCut">
        <div class="card-body">
            <div class="list-group">
                <a href="https://www.youtube.com/watch?v=SI7O81GMG2A" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">1. Repaso de Programación Orientada a Objetos</h5>
                    </div>
                    <p class="mb-1">Clases, objetos, herencia, polimorfismo y encapsulamiento. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Df-sgxGzyTg" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">2. Estructuras de Datos Básicas</h5>
                    </div>
                    <p class="mb-1">Arrays multidimensionales, listas, pilas y colas. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=DVY4S32zhiY" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">3. Manejo de Excepciones</h5>
                    </div>
                    <p class="mb-1">Try-catch, excepciones personalizadas y manejo de errores. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=OwStihBItEg" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">4. Archivos y Serialización</h5>
                    </div>
                    <p class="mb-1">Lectura/escritura de archivos, formatos JSON y XML. <span class="badge badge-primary">Video</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Segundo Corte -->
<div class="card shadow mb-4">                             
    <a href="#collapseSecondCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSecondCut">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-project-diagram mr-2"></i>Segundo Corte - Estructuras de Datos Avanzadas
        </h6>
    </a>
    <div class="collapse" id="collapseSecondCut">
        <div class="card-body">
            <div class="list-group">
                <a href="https://www.youtube.com/watch?v=2hk1Bvuoayo" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">1. Árboles y Grafos</h5>
                    </div>
                    <p class="mb-1">Implementación y recorridos (pre-order, in-order, post-order). <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=rCWVYKI8h6M" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">2. Tablas Hash</h5>
                    </div>
                    <p class="mb-1">Funciones hash, manejo de colisiones y aplicaciones. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=lIoJOxoUA3Y" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">3. Algoritmos de Ordenamiento</h5>
                    </div>
                    <p class="mb-1">QuickSort, MergeSort, HeapSort y análisis de complejidad. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=OfqrO2hUEZY" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">4. Algoritmos de Búsqueda</h5>
                    </div>
                    <p class="mb-1">Búsqueda binaria, BFS, DFS y Dijkstra. <span class="badge badge-primary">Video</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Tercer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseThirdCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseThirdCut">
        <h6 class="m-0 font-weight-bold text-warning">
            <i class="fas fa-database mr-2"></i>Tercer Corte - Programación Avanzada
        </h6>
    </a>
    <div class="collapse" id="collapseThirdCut">
        <div class="card-body">
            <div class="list-group">
                <a href="https://www.youtube.com/watch?v=3qTmBcxGlWk&list=PLJkcleqxxobUJlz1Cm8WYd-F_kckkDvc8" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">1. Patrones de Diseño</h5>
                    </div>
                    <p class="mb-1">Singleton, Factory, Observer, Strategy y otros patrones comunes. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://m.youtube.com/watch?v=RcNKe7F9-AQ" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">2. Programación Concurrente</h5>
                    </div>
                    <p class="mb-1">Hilos, sincronización y problemas de concurrencia. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=2jRnyJlKIZ0" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">3. Introducción a Bases de Datos</h5>
                    </div>
                    <p class="mb-1">Modelo relacional, SQL básico y conexión desde código. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=dTYlQfRhVHo" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">4. Desarrollo de Proyecto Integrador</h5>
                    </div>
                    <p class="mb-1">Aplicación de todos los conceptos aprendidos en un proyecto real. <span class="badge badge-primary">Video</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

                            <!-- Recursos Adicionales -->
                            <div class="card shadow mb-4">
    <a href="#collapseResources" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseResources">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-book mr-2"></i>Recursos Adicionales
        </h6>
    </a>
    <div class="collapse" id="collapseResources">
        <div class="card-body">
            <div class="list-group">

                <!-- Bibliografía -->
                <a href="https://eloquentjavascript.net/" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Bibliografía Recomendada</h5>
                    </div>
                    <p class="mb-1">Libro: *Eloquent JavaScript* (disponible en línea gratuitamente). <span class="badge badge-info">Web</span></p>
                </a>

                <!-- Ejercicios prácticos -->
                <a href="https://www.hackerrank.com/domains/tutorials/10-days-of-javascript" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Ejercicios Prácticos</h5>
                    </div>
                    <p class="mb-1">Desafíos diarios de programación en JavaScript. <span class="badge badge-success">Interactivo</span></p>
                </a>

                <a href="https://www.codewars.com/" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Retos por Niveles</h5>
                    </div>
                    <p class="mb-1">Practica resolviendo katas (retos) en varios lenguajes. <span class="badge badge-danger">Gamificado</span></p>
                </a>

                <!-- Juegos educativos -->
                <a href="https://codingame.com/start" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Juegos de Programación</h5>
                    </div>
                    <p class="mb-1">Desarrolla lógica jugando en tiempo real con otros programadores. <span class="badge badge-warning">Juego</span></p>
                </a>

                <a href="https://checkio.org/" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Aventuras Interactivas</h5>
                    </div>
                    <p class="mb-1">Explora islas resolviendo desafíos con Python o JS. <span class="badge badge-warning">Juego</span></p>
                </a>

                <!-- Proyectos de ejemplo -->
                <a href="https://github.com/florinpop17/app-ideas" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Proyectos de Ejemplo</h5>
                    </div>
                    <p class="mb-1">Colección de ideas de apps con niveles de dificultad. <span class="badge badge-dark">GitHub</span></p>
                </a>

                <!-- Enlaces útiles -->
                <a href="https://www.w3schools.com/" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Documentación W3Schools</h5>
                    </div>
                    <p class="mb-1">Referencia completa de HTML, CSS, JavaScript y más. <span class="badge badge-primary">Docs</span></p>
                </a>

                <a href="https://roadmap.sh/" class="list-group-item list-group-item-action" target="_blank">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Guías y Rutas de Aprendizaje</h5>
                    </div>
                    <p class="mb-1">Mapas de carrera para programadores front-end, back-end y más. <span class="badge badge-secondary">Guía</span></p>
                </a>

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
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Universidad Popular del Cesar - Seccional Aguachica 2024</span>
                    </div>
                </div>
            </footer>
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