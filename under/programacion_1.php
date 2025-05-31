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
<!-- Start unitys -->
<!-- Primer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseFirstCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseFirstCut">
        <h6 class="m-0 font-weight-bold text-primary">
            <i class="fas fa-code mr-2"></i>Primer Corte - Introducción al Lenguaje de Programación
        </h6>
    </a>
    <div class="collapse show" id="collapseFirstCut">
        <div class="card-body">
            <div class="list-group">
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Solución de Problemas usando un lenguaje de programación</h5>
                    <p class="mb-1">Proceso de análisis y resolución de problemas mediante código.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Características y estructura del lenguaje</h5>
                    <p class="mb-1">Elementos clave del lenguaje de programación y su organización.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Sintaxis del lenguaje</h5>
                    <p class="mb-1">Reglas que definen cómo deben escribirse las instrucciones.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Operadores</h5>
                    <p class="mb-1">Tipos de operadores y su uso en expresiones.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">5. Declaración de constantes</h5>
                    <p class="mb-1">Cómo definir valores constantes en el programa.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">6. Declaración de una variable</h5>
                    <p class="mb-1">Asignación de nombres a datos manipulables.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">7. Sentencias de asignación</h5>
                    <p class="mb-1">Asignación de valores a variables.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">8. Sentencias de Entrada/Salida</h5>
                    <p class="mb-1">Cómo interactuar con el usuario mediante entradas y salidas.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">9. Ejercicios de aplicación</h5>
                    <p class="mb-1">Prácticas para reforzar los conceptos aprendidos.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Segundo Corte -->
<div class="card shadow mb-4">
    <a href="#collapseSecondCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseSecondCut">
        <h6 class="m-0 font-weight-bold text-success">
            <i class="fas fa-project-diagram mr-2"></i>Segundo Corte - Sentencias Condicionales y Repetitivas
        </h6>
    </a>
    <div class="collapse" id="collapseSecondCut">
        <div class="card-body">
            <div class="list-group">
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Estructuras de control por condición</h5>
                    <p class="mb-1">Toma de decisiones usando sentencias condicionales.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Contadores</h5>
                    <p class="mb-1">Uso de variables para contar eventos o repeticiones.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Acumuladores</h5>
                    <p class="mb-1">Acumulación de valores en variables.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Banderas</h5>
                    <p class="mb-1">Variables booleanas para controlar el flujo del programa.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">5. Estructuras de control por iteración</h5>
                    <p class="mb-1">Repetición de bloques de código mediante bucles.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">6. Ejercicios de aplicación</h5>
                    <p class="mb-1">Resolución de problemas utilizando condicionales e iteraciones.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Tercer Corte -->
<div class="card shadow mb-4">
    <a href="#collapseThirdCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseThirdCut">
        <h6 class="m-0 font-weight-bold text-warning">
            <i class="fas fa-database mr-2"></i>Tercer Corte - Métodos (Procedimientos)
        </h6>
    </a>
    <div class="collapse" id="collapseThirdCut">
        <div class="card-body">
            <div class="list-group">
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">1. Concepto de métodos</h5>
                    <p class="mb-1">Qué son los métodos y su importancia en la programación.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">2. Definición de métodos tipo procedimientos</h5>
                    <p class="mb-1">Sintaxis, parámetros, variables y literales usados en métodos.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">3. Ámbito global y local</h5>
                    <p class="mb-1">Diferencia entre variables accesibles en todo el programa o solo en ciertas partes.</p>
                </a>
                <a class="list-group-item list-group-item-action">
                    <h5 class="mb-1">4. Ejercicios de aplicación</h5>
                    <p class="mb-1">Prácticas para implementar y usar métodos.</p>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Cuarto Corte -->
<div class="card shadow mb-4">
    <a href="#collapseFourthCut" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseFourthCut">
        <h6 class="m-0 font-weight-bold text-info">
            <i class="fas fa-th-list mr-2"></i>Cuarto Corte - Arreglos con Funciones
        </h6>
    </a>
    <div class="collapse" id="collapseFourthCut">
        <div class="card-body">
            <div class="list-group">
                <!-- Métodos (Funciones) -->
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">1. Concepto de función</h5>
                    <p class="mb-1">Introducción a las funciones en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">2. Definición de funciones (sintaxis)</h5>
                    <p class="mb-1">Cómo definir funciones en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">3. Parámetros, variables, literales</h5>
                    <p class="mb-1">Uso de parámetros y variables en funciones. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">4. Ámbito global y local</h5>
                    <p class="mb-1">Diferencia entre variables globales y locales. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">5. Concepto de biblioteca de funciones</h5>
                    <p class="mb-1">Uso de bibliotecas de funciones en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">6. Invocación de funciones</h5>
                    <p class="mb-1">Cómo llamar funciones en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=zvzjaqMBEso" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">7. Ejercicios de aplicación</h5>
                    <p class="mb-1">Práctica de funciones en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <!-- Arreglos -->
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">8. Definición de Arreglos</h5>
                    <p class="mb-1">Introducción a los arreglos en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">9. Arreglos Unidimensionales</h5>
                    <p class="mb-1">Uso de arreglos unidimensionales en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">10. Arreglos Multidimensionales</h5>
                    <p class="mb-1">Uso de arreglos multidimensionales en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">11. Implementación</h5>
                    <p class="mb-1">Cómo implementar arreglos en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <!-- Arreglos con funciones -->
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">12. Arreglos y funciones</h5>
                    <p class="mb-1">Uso de funciones con arreglos en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">13. Ordenamiento y búsquedas en arreglos</h5>
                    <p class="mb-1">Cómo ordenar y buscar en arreglos en Python. <span class="badge badge-primary">Video</span></p>
                </a>
                <a href="https://www.youtube.com/watch?v=Rldzskbnjgo" class="list-group-item list-group-item-action" target="_blank">
                    <h5 class="mb-1">14. Ejercicios de aplicación</h5>
                    <p class="mb-1">Práctica de arreglos y funciones en Python. <span class="badge badge-primary">Video</span></p>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- Bibliografias -->
<!-- Referencias Bibliográficas -->
<div class="card shadow mb-4">
    <a href="#collapseReferences" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="collapseReferences">
        <h6 class="m-0 font-weight-bold text-secondary">
            <i class="fas fa-book mr-2"></i>Referencias Bibliográficas
        </h6>
    </a>
    <div class="collapse" id="collapseReferences">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>Eric Matthes</strong>, <em>Python Crash Course: A Hands-On, Project-Based Introduction to Programming</em>, 2019, Editorial: No Starch Press, ISBN: 978-1593279288.
                </li>
                <li class="list-group-item">
                    <strong>Robert C. Martin</strong>, <em>Clean Code: A Handbook of Agile Software Craftsmanship</em>, 2008, Editorial: Prentice Hall, ISBN: 978-0132350884.
                </li>
                <li class="list-group-item">
                    <strong>Brian W. Kernighan, Dennis M. Ritchie</strong>, <em>The C Programming Language</em>, 1988, Editorial: Prentice Hall, ISBN: 978-0131103627.
                </li>
                <li class="list-group-item">
                    <strong>Martin Fowler</strong>, <em>Refactoring: Improving the Design of Existing Code</em>, 1999, Editorial: Addison-Wesley Professional, ISBN: 978-0201485677.
                </li>
                <li class="list-group-item">
                    <strong>Steve McConnell</strong>, <em>Code Complete: A Practical Handbook of Software Construction</em>, 1993, Editorial: Microsoft Press, ISBN: 978-0735619678.
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- End unitys -->
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