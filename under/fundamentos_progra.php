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
    header("Location: fundamentos_progra.php?code=$code");
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
                                <h1 class="h4 text-gray-900 mb-4">¡Bienvenido a Fundamentos de Programación!</h1>
                                <div class="copyright text-center my-auto">
                                    <span> 
                                        Aquí encontrarás todos los elementos y temas de las clases. ¡Aprende y diviértete!
                                    </span>
                                </div>
                            </div>
                            <br>
<!-- Start unitys -->
<!-- Primer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseFirstCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseFirstCut">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-code mr-2"></i>Primer Corte - Fundamentos de Programación
        </h6>
    </a>
    <div class="collapse show" id="collapseFirstCut">
        <div class="card-body">
            <div class="list-group">
                <a href="https://www.youtube.com/watch?v=8PopR3x-VMY" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">1. Evolución histórica de la programación</h5>
                    <p class="mb-1">De los primeros lenguajes hasta la programación estructurada. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=K2q3o3pwwvM" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">2. Algoritmos, programas y lenguajes</h5>
                    <p class="mb-1">Conceptos básicos para empezar a programar. <span class="badge badge-primary">Video</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Segundo Corte -->
<div class="card shadow mb-4">
    <a href="#collapseSecondCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSecondCut">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-cogs mr-2"></i>Segundo Corte - Tipos de Datos y Expresiones
        </h6>
    </a>
    <div class="collapse" id="collapseSecondCut">
        <div class="card-body">
            <div class="list-group">
                <a href="https://www.youtube.com/watch?v=wfcWRAxRVBA" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">1. Tipos de datos y variables</h5>
                    <p class="mb-1">Enteros, reales, booleanos, caracteres y cadenas. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=cIo7aIGZBzM" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">2. Operadores y expresiones</h5>
                    <p class="mb-1">Aritméticos, relacionales, lógicos y acción de asignación. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=qz8aQGrU54A" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">3. Sentencias y acciones básicas</h5>
                    <p class="mb-1">Construcción de expresiones y sentencias simples. <span class="badge badge-primary">Video</span></p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Tercer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseThirdCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseThirdCut">
        <h6 class="m-0 font-weight-bold text-warning">
            <i class="fas fa-random mr-2"></i>Tercer Corte - Condicionales y Ciclos
        </h6>
    </a>
    <div class="collapse" id="collapseThirdCut">
        <div class="card-body">
            <div class="list-group">
                <a href="https://www.youtube.com/watch?v=MFk7Kz9-7nY" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">1. Estructuras condicionales</h5>
                    <p class="mb-1">Condición simple, doble y múltiples condiciones anidadas. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=x7X9w_GIm1s" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">2. Ciclos con while y for</h5>
                    <p class="mb-1">Repetición de instrucciones con control de flujo. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Cr5vd6cE3pA" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">3. Contadores y acumuladores</h5>
                    <p class="mb-1">Cómo contar y acumular valores en estructuras repetitivas. <span class="badge badge-primary">Video</span></p>
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

                <a href="https://aprendepython.es/_downloads/907b5202c1466977a8d6bd3a2641453f/aprendepython.pdf" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">Aprende Python - S. Delgado Quintero (2022)</h5>
                    <p class="mb-1">Material completo sobre fundamentos de Python. <span class="badge badge-info">PDF</span></p>
                </a>

                <a href="https://editorialeidec.com/libros/algoritmos-python" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">Algoritmos resueltos con Python - Condor Tinoco & De la Cruz Rocca (2020)</h5>
                    <p class="mb-1">Ejercicios resueltos paso a paso. <span class="badge badge-info">Libro</span></p>
                </a>

                <a href="https://www.uaa.mx/algoritmos-flujo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">Algoritmos con diagramas de flujo - Pinales & Velázquez (2014)</h5>
                    <p class="mb-1">Fundamentos con pseudocódigo y diagramas. <span class="badge badge-info">Libro</span></p>
                </a>

                <a href="https://www.escuelaing.edu.co/" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">Aprendiendo a programar desde cero - Patricia Salazar (2019)</h5>
                    <p class="mb-1">Guía de inicio para nuevos programadores. <span class="badge badge-info">Libro</span></p>
                </a>

            </div>
        </div>
    </div>
</div>


<!-- End -->
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
                                    
                                    <form method="POST" action="fundamentos_progra.php?code=<?= $code ?>">
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