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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">1. Repaso de Programación Orientada a Objetos</h5>
                                                </div>
                                                <p class="mb-1">Clases, objetos, herencia, polimorfismo y encapsulamiento.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">2. Estructuras de Datos Básicas</h5>
                                                </div>
                                                <p class="mb-1">Arrays multidimensionales, listas, pilas y colas.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">3. Manejo de Excepciones</h5>
                                                </div>
                                                <p class="mb-1">Try-catch, excepciones personalizadas y manejo de errores.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">4. Archivos y Serialización</h5>
                                                </div>
                                                <p class="mb-1">Lectura/escritura de archivos, formatos JSON y XML.</p>
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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">1. Árboles y Grafos</h5>
                                                </div>
                                                <p class="mb-1">Implementación y recorridos (pre-order, in-order, post-order).</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">2. Tablas Hash</h5>
                                                </div>
                                                <p class="mb-1">Funciones hash, manejo de colisiones y aplicaciones.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">3. Algoritmos de Ordenamiento</h5>
                                                </div>
                                                <p class="mb-1">QuickSort, MergeSort, HeapSort y análisis de complejidad.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">4. Algoritmos de Búsqueda</h5>
                                                </div>
                                                <p class="mb-1">Búsqueda binaria, BFS, DFS y Dijkstra.</p>
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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">1. Patrones de Diseño</h5>
                                                </div>
                                                <p class="mb-1">Singleton, Factory, Observer, Strategy y otros patrones comunes.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">2. Programación Concurrente</h5>
                                                </div>
                                                <p class="mb-1">Hilos, sincronización y problemas de concurrencia.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">3. Introducción a Bases de Datos</h5>
                                                </div>
                                                <p class="mb-1">Modelo relacional, SQL básico y conexión desde código.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">4. Desarrollo de Proyecto Integrador</h5>
                                                </div>
                                                <p class="mb-1">Aplicación de todos los conceptos aprendidos en un proyecto real.</p>
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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Bibliografía Recomendada</h5>
                                                </div>
                                                <p class="mb-1">Libros y artículos para profundizar en los temas.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Ejercicios Prácticos</h5>
                                                </div>
                                                <p class="mb-1">Problemas y desafíos para practicar.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Proyectos de Ejemplo</h5>
                                                </div>
                                                <p class="mb-1">Código fuente de proyectos completos.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Enlaces Útiles</h5>
                                                </div>
                                                <p class="mb-1">Tutoriales, documentación y herramientas.</p>
                                            </a>
                                        </div>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesión</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">¿Está seguro que desea cerrar sesión?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="login.html">Cerrar</a>
                </div>
            </div>
        </div>
    </div>

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
    
</body>
</html>