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
    header("Location: calculo_1.php?code=$code");
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
    <meta name="description" content="Tutorías UPC - Cálculo 1">
    <meta name="author" content="">

    <title>Cálculo 1 | Tutorias UPC</title>

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
                                <h1 class="h4 text-gray-900 mb-4">¡Bienvenido a Cálculo 1!</h1>
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
            <i class="fas fa-square-root-alt mr-2"></i>Primer Corte - Conjuntos Numéricos y Álgebra Básica
        </h6>
    </a>
    <div class="collapse show" id="collapseFirstCut">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Conjuntos Numéricos</h5>
                    <p class="mb-1">Clasificación y propiedades básicas.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Álgebra Básica</h5>
                    <p class="mb-1">Potenciación, radicación, logaritmación y operaciones algebraicas.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Factorización y productos notables</h5>
                    <p class="mb-1">Técnicas comunes y división sintética.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Inecuaciones e identidades trigonométricas</h5>
                    <p class="mb-1">Aplicaciones y simplificación.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Segundo Corte -->
<div class="card shadow mb-4">
    <a href="#collapseSecondCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSecondCut">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-chart-line mr-2"></i>Segundo Corte - Funciones, Límites y Continuidad
        </h6>
    </a>
    <div class="collapse" id="collapseSecondCut">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Funciones reales y sus gráficas</h5>
                    <p class="mb-1">Dominio, rango y operaciones con funciones.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Composición de funciones</h5>
                    <p class="mb-1">Teoría y ejemplos aplicados.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Introducción a los límites</h5>
                    <p class="mb-1">Teoremas, continuidad, y límites laterales.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Técnicas para límites indeterminados</h5>
                    <p class="mb-1">Límites infinitos, trigonométricos y aplicaciones prácticas.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Tercer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseThirdCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseThirdCut">
        <h6 class="m-0 font-weight-bold text-warning">
            <i class="fas fa-pen-ruler mr-2"></i>Tercer Corte - Derivadas y Aplicaciones
        </h6>
    </a>
    <div class="collapse" id="collapseThirdCut">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Concepto y reglas de derivación</h5>
                    <p class="mb-1">Regla de la cadena, derivadas trigonométricas y logarítmicas.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Derivadas implícitas y de orden superior</h5>
                    <p class="mb-1">Aplicaciones geométricas y analíticas.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Aplicaciones de la derivada</h5>
                    <p class="mb-1">Máximos y mínimos, optimización, análisis de curva.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Regla de l'Hôpital y resolución de problemas</h5>
                    <p class="mb-1">Formas indeterminadas y su interpretación.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Recursos Adicionales -->
<div class="card shadow mb-4">
    <a href="#collapseResources" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseResources">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-book mr-2"></i>Referencias Bibliográficas
        </h6>
    </a>
    <div class="collapse" id="collapseResources">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">LEITHOLD, Louis</h5>
                    <p class="mb-1">Matemáticas previas al cálculo, HARLA, 1998.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">EDWARDS y PENNEY</h5>
                    <p class="mb-1">Cálculo con geometría analítica, Prentice Hall, 2002.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">ZILL, D. y otros</h5>
                    <p class="mb-1">Álgebra y Trigonometría, McGraw Hill, 1999.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">T. APOSTOL</h5>
                    <p class="mb-1">Cálculo, Tomo I, Editorial Reverté, 1988.</p>
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
                                    
                                    <form method="POST" action="calculo_1.php?code=<?= $code ?>">
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