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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">1. Concepto de Antiderivación</h5>
                                                </div>
                                                <p class="mb-1">Antidiferenciación o Integración.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">2. Fórmulas básicas de integración</h5>
                                                </div>
                                                <p class="mb-1">Reglas fundamentales de integración.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">3. Aplicación de fórmulas básicas</h5>
                                                </div>
                                                <p class="mb-1">Ejercicios prácticos con fórmulas básicas.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">4. Integrales básicas de funciones trigonométricas</h5>
                                                </div>
                                                <p class="mb-1">Integración de seno, coseno, tangente, etc.</p>
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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">1. Integración por sustitución</h5>
                                                </div>
                                                <p class="mb-1">Método de cambio de variable.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">2. Integración por partes</h5>
                                                </div>
                                                <p class="mb-1">Aplicación de la fórmula ∫u dv = uv - ∫v du.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">3. Integrales de potencias de funciones trigonométricas</h5>
                                                </div>
                                                <p class="mb-1">Casos 1 al 5 con diferentes exponentes.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">4. Sustitución trigonométrica (con radical)</h5>
                                                </div>
                                                <p class="mb-1">Casos 1, 2 y 3 con expresiones radicales.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">5. Sustitución trigonométrica (sin radical)</h5>
                                                </div>
                                                <p class="mb-1">Casos 1, 2 y 3 sin expresiones radicales.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">6. Integrales con ax²+bx+c</h5>
                                                </div>
                                                <p class="mb-1">Técnicas para este tipo de expresiones.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">7. Fracciones parciales</h5>
                                                </div>
                                                <p class="mb-1">Descomposición de funciones racionales.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">8. Integrales de funciones racionales de senx y cosx</h5>
                                                </div>
                                                <p class="mb-1">Técnicas especiales para estas funciones.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">9. Integrales impropias</h5>
                                                </div>
                                                <p class="mb-1">Límites de integración infinitos o discontinuidades.</p>
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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">1. Introducción a la integral definida</h5>
                                                </div>
                                                <p class="mb-1">Concepto y propiedades fundamentales.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">2. Integral de Riemann</h5>
                                                </div>
                                                <p class="mb-1">Definición formal y ejemplos.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">3. Áreas por suma de Riemann</h5>
                                                </div>
                                                <p class="mb-1">Aproximación del área bajo curvas.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">4. Teorema fundamental del cálculo</h5>
                                                </div>
                                                <p class="mb-1">Relación entre derivación e integración.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">5. Área de una región plana</h5>
                                                </div>
                                                <p class="mb-1">Cálculo de áreas con integrales.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">6. Área bajo una curva</h5>
                                                </div>
                                                <p class="mb-1">Técnicas específicas para este cálculo.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">7. Área entre dos curvas</h5>
                                                </div>
                                                <p class="mb-1">Determinación del área entre funciones.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">8. Volumen de sólidos de revolución</h5>
                                                </div>
                                                <p class="mb-1">Método de discos y arandelas.</p>
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
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Leithold, L. (1998)</h5>
                                                </div>
                                                <p class="mb-1">Matemáticas previas al cálculo. 3a ed. Harla, México.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Edward y Penney (2002)</h5>
                                                </div>
                                                <p class="mb-1">Cálculo con Geometría analítica. Prentice Hall.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Purcell, E. (2007)</h5>
                                                </div>
                                                <p class="mb-1">Cálculo. 9a ed. Prentice Hall, México.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Takeuchi, Y. et al. (1983)</h5>
                                                </div>
                                                <p class="mb-1">Hacia la matemática: un enfoque estructurado. Grupo Editorial Andino.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Leithold, L. (2008)</h5>
                                                </div>
                                                <p class="mb-1">El cálculo con geometría analítica. 7a ed. Oxford University, México.</p>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">Apostol, T. (1988)</h5>
                                                </div>
                                                <p class="mb-1">Cálculo, tomo I. Editorial Reverte S.A., España.</p>
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