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
    header("Location: programacion_3.php?code=$code");
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
    <meta name="description" content="Tutorías UPC - Programación 3">
    <meta name="author" content="">

    <title>Programación 3 | Tutorias UPC</title>

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
                                <h1 class="h4 text-gray-900 mb-4">¡Bienvenido a Programación 3!</h1>
                                <div class="copyright text-center my-auto">
                                    <span> 
                                        Aquí encontrarás todos los elementos y temas de las clases. ¡Aprende y diviértete!
                                    </span>
                                </div>
                            </div>
                            <br>
<!-- Start unitys -->
<!-- Unidad 1 -->
<div class="card shadow mb-4">
    <a href="#collapseUnidad1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseUnidad1">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-terminal mr-2"></i>Unidad 1 - Elementos del Lenguaje
        </h6>
    </a>
    <div class="collapse show" id="collapseUnidad1">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Elementos del Lenguaje C#</h5>
                    <p class="mb-1">Sintaxis, tipos de datos, estructuras de control, operadores.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Unidad 2 -->
<div class="card shadow mb-4">
    <a href="#collapseUnidad2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad2">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-cogs mr-2"></i>Unidad 2 - Aplicaciones de Consola
        </h6>
    </a>
    <div class="collapse" id="collapseUnidad2">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Repaso POO</h5>
                    <p class="mb-1">Programación Orientada a Objetos: clases, objetos, herencia, etc.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Clases, Enumeraciones e Interfaces</h5>
                    <p class="mb-1">Definición de tipos personalizados y contratos.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Archivos de Texto</h5>
                    <p class="mb-1">Lectura y escritura en archivos externos.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Manejo de Cadenas</h5>
                    <p class="mb-1">Manipulación de strings en C#.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Unidad 3 -->
<div class="card shadow mb-4">
    <a href="#collapseUnidad3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad3">
        <h6 class="m-0 font-weight-bold text-warning">
            <i class="fas fa-desktop mr-2"></i>Unidad 3 - Aplicaciones con GUI
        </h6>
    </a>
    <div class="collapse" id="collapseUnidad3">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. BCL Objetos Comunes</h5>
                    <p class="mb-1">Uso de la Base Class Library en C#.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Objetos Contenedores</h5>
                    <p class="mb-1">Paneles, formularios, grupos.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Menús y Barras de Herramientas</h5>
                    <p class="mb-1">Diseño de menús desplegables y toolbars.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Controles Dinámicos</h5>
                    <p class="mb-1">Creación y manipulación en tiempo de ejecución.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">5. Librerías de Objetos Dinámicos</h5>
                    <p class="mb-1">Uso y creación de bibliotecas reutilizables.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">6. Interfaces SDI y MDI</h5>
                    <p class="mb-1">Diseño de interfaces de documento único y múltiple.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Unidad 4 -->
<div class="card shadow mb-4">
    <a href="#collapseUnidad4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad4">
        <h6 class="m-0 font-weight-bold text-danger">
            <i class="fas fa-database mr-2"></i>Unidad 4 - Acceso Desconectado a Datos
        </h6>
    </a>
    <div class="collapse" id="collapseUnidad4">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. MDI y Acceso Desconectado</h5>
                    <p class="mb-1">Acceso a datos sin conexión y uso de formularios MDI.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Caché de Datos</h5>
                    <p class="mb-1">Gestión y almacenamiento temporal de datos.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. DataSet, DataColumn y DataRow</h5>
                    <p class="mb-1">Manipulación de estructuras de datos en memoria.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. DataGridView y Binding</h5>
                    <p class="mb-1">Visualización y vinculación de datos a la interfaz.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Unidad 5 -->
<div class="card shadow mb-4">
    <a href="#collapseUnidad5" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad5">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-tasks mr-2"></i>Unidad 5 - Aplicaciones con Hilos
        </h6>
    </a>
    <div class="collapse" id="collapseUnidad5">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Thread</h5>
                    <p class="mb-1">Uso de hilos en programación multihilo.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Async y Await</h5>
                    <p class="mb-1">Programación asíncrona en C# con tareas.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Referencias Bibliográficas -->
<div class="card shadow mb-4">
    <a href="#collapseReferencias" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseReferencias">
        <h6 class="m-0 font-weight-bold text-secondary">
            <i class="fas fa-book mr-2"></i>Referencias Bibliográficas
        </h6>
    </a>
    <div class="collapse" id="collapseReferencias">
        <div class="card-body">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Microsoft C#: Lenguaje y Aplicaciones</h5>
                    <p class="mb-1">Ceballos Sierra, Francisco Javier. 2ª ed. RA-MA Editorial, 2007. ProQuest ebrary.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Enciclopedia de Microsoft Visual C#</h5>
                    <p class="mb-1">Ceballos Sierra, Francisco Javier. 4ª ed. RA-MA Editorial, 2012. ProQuest ebrary.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Introducción a .NET</h5>
                    <p class="mb-1">Editorial UOC, 2010. ProQuest ebrary.</p>
                </a>
                <a href="#" class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Visual Basic: Interfaces Gráficas y Aplicaciones para Internet</h5>
                    <p class="mb-1">Ceballos Sierra, Francisco Javier. RA-MA Editorial, 2012. ProQuest ebrary.</p>
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
                                    
                                    <form method="POST" action="programacion_3.php?code=<?= $code ?>">
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