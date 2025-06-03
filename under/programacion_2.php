<?php
session_start();
require_once "../conexion.php";

// Verificar parámetros GET (solo para identificar el curso)
$code = isset($_GET['code']) ? intval($_GET['code']) : 0;
if ($code === 0) {
    header('Location: show_cursos.php');
    exit();
}

// Verificar usuario logueado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit();
}
$usuario_id = $_SESSION['usuario_id'];

// Procesar comentario si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comentario'])) {
    $comentario = trim($_POST['comentario']);

    // Validar comentario
    if (strlen($comentario) >= 10) {
        // Verificar matrícula del usuario en el curso
        $sql_verificar = "SELECT 1 FROM estudiante_curso WHERE usuario_id = ? AND course_code = ?";
        $stmt_verificar = $conn->prepare($sql_verificar);
        $stmt_verificar->bind_param("ii", $usuario_id, $code);
        $stmt_verificar->execute();
        $puede_comentar = $stmt_verificar->get_result()->num_rows > 0;

        if ($puede_comentar) {
            // Insertar comentario
            $sql = "INSERT INTO comentarios_cursos (usuario_id, course_code, comentario, fecha_creacion) 
                    VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iis", $usuario_id, $code, $comentario);

            if ($stmt->execute()) {
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
    header("Location: programacion_2.php?code=$code");
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
                            <!-- Start unitys -->

                            <!-- Unidad 1 -->
                            <div class="card shadow mb-4"> <a href="#collapseUnidad1" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseUnidad1">
                                    <h6 class="m-0 font-weight-bold text-primary"> <i class="fas fa-code mr-2"></i>Unidad 1 - Elementos del Lenguaje </h6>
                                </a>
                                <div class="collapse show" id="collapseUnidad1">
                                    <div class="card-body">
                                        <div class="list-group"> <a href="https://www.youtube.com/watch?v=kZfuJvkdcHU&ab_channel=Cegamer" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">1. Elementos del lenguaje y declaración de variables</h5>
                                                <p class="mb-1">Incluye operadores, sentencias y métodos de entrada/salida. <span class="badge badge-primary">Video</span></p>
                                            </a> 
                                            <a href="https://youtu.be/5m9xSRVfEYM?si=dxezqrr8pN4PTeX9" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">2. Estructuras condicionales y cíclicas</h5>
                                                <p class="mb-1">Uso de estructuras if, switch, for, while y do-while. <span class="badge badge-primary">Video</span></p>
                                            </a> 
                                            <a href="https://youtu.be/SXIOxvxWf7A?si=dOfrawnOG1iNUKpF" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">3. Introducción a NetBeans</h5>
                                                <p class="mb-1">IDE para desarrollo en Java. <span class="badge badge-primary">Video</span></p>
                                            </a>
                                             <a href="https://www.youtube.com/watch?v=kXZBe0OdD1A&pp=ygUyRGVjbGFyYWNpw7NuIHkgdXNvIGRlIG3DqXRvZG9zLCByZXRvcm5vIGRlIHZhbG9yZXM%3D" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">4. Métodos: prototipos, con y sin retorno</h5>
                                                <p class="mb-1">Declaración y uso de métodos, retorno de valores. <span class="badge badge-primary">Video</span></p>
                                            </a>
                                             <a href="https://youtu.be/Oho0tsVKaMU?si=9GyKFJ16yInUsU6u" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">5. Utilidades del lenguaje</h5>
                                                <p class="mb-1">Uso de la biblioteca estándar, clase Math y clase String. <span class="badge badge-primary">Video</span></p>
                                            </a>
                                             <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">6. Recursividad</h5>
                                                <p class="mb-1">Introducción al concepto y ejemplos básicos. <span class="badge badge-primary">Video</span></p>
                                            </a>
                                         </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Unidad 2 -->
                            <div class="card shadow mb-4"> <a href="#collapseUnidad2" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad2">
                                    <h6 class="m-0 font-weight-bold text-success"> <i class="fas fa-layer-group mr-2"></i>Unidad 2 - Arrays y ArrayList </h6>
                                </a>
                                <div class="collapse" id="collapseUnidad2">
                                    <div class="card-body">
                                        <div class="list-group"> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">1. Arrays unidimensionales y multidimensionales</h5>
                                                <p class="mb-1">Vectores, matrices y arrays irregulares. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">2. Operaciones con arrays</h5>
                                                <p class="mb-1">Acceso, recorrido, modificación y métodos con arrays como parámetros. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">3. Uso de listas - ArrayList</h5>
                                                <p class="mb-1">Creación y manipulación dinámica de listas. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">4. Uso de diccionarios - HashMap</h5>
                                                <p class="mb-1">Almacenamiento clave-valor en Java. <span class="badge badge-primary">Video</span></p>
                                            </a> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Unidad 3 -->
                            <div class="card shadow mb-4"> <a href="#collapseUnidad3" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad3">
                                    <h6 class="m-0 font-weight-bold text-warning"> <i class="fas fa-cubes mr-2"></i>Unidad 3 - Programación Orientada a Objetos (POO) </h6>
                                </a>
                                <div class="collapse" id="collapseUnidad3">
                                    <div class="card-body">
                                        <div class="list-group"> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">1. Fundamentos de POO</h5>
                                                <p class="mb-1">Abstracción, encapsulación y polimorfismo. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">2. Objetos, atributos y métodos</h5>
                                                <p class="mb-1">Definición de clases, métodos y uso de getters/setters. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">3. Constructores y modificadores</h5>
                                                <p class="mb-1">Constructores con y sin parámetros, uso de static y final. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">4. Relaciones entre clases</h5>
                                                <p class="mb-1">Herencia, asociación, composición y clases abstractas. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">5. Interfaces y métodos abstractos</h5>
                                                <p class="mb-1">Diseño flexible usando interfaces. <span class="badge badge-primary">Video</span></p>
                                            </a> </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Unidad 4 -->
                            <div class="card shadow mb-4"> <a href="#collapseUnidad4" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseUnidad4">
                                    <h6 class="m-0 font-weight-bold text-info"> <i class="fas fa-desktop mr-2"></i>Unidad 4 - Manejo de Swing y MVC </h6>
                                </a>
                                <div class="collapse" id="collapseUnidad4">
                                    <div class="card-body">
                                        <div class="list-group"> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">1. Componentes comunes y contenedores</h5>
                                                <p class="mb-1">Botones, etiquetas, paneles, cuadros de texto y más. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">2. Menús y barras de herramientas</h5>
                                                <p class="mb-1">Creación de menús desplegables y barras de acceso rápido. <span class="badge badge-primary">Video</span></p>
                                            </a> <a href="https://www.youtube.com/watch?v=32DLasxoOiM" class="list-group-item list-group-item-action" target="_blank">
                                                <h5 class="mb-1">3. Patrón de diseño Modelo-Vista-Controlador (MVC)</h5>
                                                <p class="mb-1">Separación de lógica, vista y controlador para aplicaciones organizadas ::contentReference[oaicite:0]{index=0}
                                                    <!-- Recursos Adicionales -->
                                                    <div class="card shadow mb-4">
                                                        <a href="#collapseResources" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseResources">
                                                            <h6 class="m-0 font-weight-bold text-info">
                                                                <i class="fas fa-book mr-2"></i>Referencias Bibliográficas
                                                            </h6>
                                                        </a>
                                                        <div class="collapse" id="collapseResources">
                                                            <div class="card-body">
                                                                <div class="list-group">

                                                                    <!-- Python Crash Course -->
                                                                    <a href="https://es.scribd.com/document/806380998/Instant-Access-to-Python-Crash-Course-3rd-Edition-Eric-Matthes-ebook-Full-Chapters" target="_blank" class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="mb-1">Matthes, E. (2019)</h5>
                                                                        </div>
                                                                        <p class="mb-1">Python Crash Course: A Hands-On, Project-Based Introduction to Programming. No Starch Press. <span class="badge badge-info">Libro</span></p>
                                                                    </a>

                                                                    <!-- Clean Code -->
                                                                    <a href="https://pdfcoffee.com/clean-code-espaol-robert-c-martin-2-pdf-free.html" target="_blank" class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="mb-1">Martin, R. C. (2008)</h5>
                                                                        </div>
                                                                        <p class="mb-1">Clean Code: A Handbook of Agile Software Craftsmanship. Prentice Hall. <span class="badge badge-info">Libro</span></p>
                                                                    </a>

                                                                    <!-- The C Programming Language -->
                                                                    <a href="https://ia903407.us.archive.org/35/items/the-ansi-c-programming-language-by-brian-w.-kernighan-dennis-m.-ritchie.org/The%20ANSI%20C%20Programming%20Language%20by%20Brian%20W.%20Kernighan%2C%20Dennis%20M.%20Ritchie.pdf" target="_blank" class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="mb-1">Kernighan, B. W., & Ritchie, D. M. (1988)</h5>
                                                                        </div>
                                                                        <p class="mb-1">The C Programming Language. Prentice Hall. <span class="badge badge-info">Libro</span></p>
                                                                    </a>

                                                                    <!-- Refactoring -->
                                                                    <a href="https://pdfcoffee.com/refactoring-improving-the-design-of-existing-code-2-pdf-free.html" target="_blank" class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="mb-1">Fowler, M. (1999)</h5>
                                                                        </div>
                                                                        <p class="mb-1">Refactoring: Improving the Design of Existing Code. Addison-Wesley Professional. <span class="badge badge-info">Libro</span></p>
                                                                    </a>

                                                                    <!-- Code Complete -->
                                                                    <a href="https://pdfcoffee.com/code-complete-a-practical-handbook-of-software-construction-2nd-edition-pdf-free.html" target="_blank" class="list-group-item list-group-item-action">
                                                                        <div class="d-flex w-100 justify-content-between">
                                                                            <h5 class="mb-1">McConnell, S. (1993)</h5>
                                                                        </div>
                                                                        <p class="mb-1">Code Complete: A Practical Handbook of Software Construction. Microsoft Press. <span class="badge badge-info">Libro</span></p>
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
                                                            <?php if ($mensaje_exito): ?>
                                                                <div class="alert alert-success"><?= $mensaje_exito ?></div>
                                                            <?php endif; ?>

                                                            <?php if ($mensaje_error): ?>
                                                                <div class="alert alert-danger"><?= $mensaje_error ?></div>
                                                            <?php endif; ?>

                                                            <form method="POST" action="programacion_2.php?code=<?= $code ?>">
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
                            <?php if ($mensaje_exito): ?>
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Éxito!',
                                    text: '<?= addslashes($mensaje_exito) ?>',
                                    confirmButtonColor: '#3085d6'
                                });
                            <?php endif; ?>

                            <?php if ($mensaje_error): ?>
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