<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tutorias UPC</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/style.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php
         include "sidebar_admin.php"
         ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php
                include "topbar.php"
                ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style=" left: 5%; position: relative;">
                    <br>
                    <h1 class="h4 text-gray-900 mb-4" style=" left: 25%; position: relative;">Lógica Matematica</h1>
                    <div class="row">
                        <div class="col-6">
                            <br>

                            <div class="card shadow mb-4" style="width: 80%;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Estudiantes</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr style="color: rgb(78, 115, 223);">
                                                    <th>Nombre</th>
                                                    <th>Usuario</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Tiger Nixon</td>
                                                    <td>User</td>
                                                    <td>Activo</td>
                                                </tr>
                                                <tr>
                                                    <td>Garrett Winters</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                                </tr>
                                                <tr>
                                                    <td>Ashton Cox</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                                </tr>
                                                <tr>
                                                    <td>Cedric Kelly</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                                </tr>
                                                <tr>
                                                    <td>Airi Satou</td>
                                                    <td>User</td>
                                                    <td>Activo</td>                                            
                                                </tr>
                                                <tr>
                                                    <td>Brielle Williamson</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                            
                                                </tr>
                                                <tr>
                                                    <td>Herrod Chandler</td>
                                                    <td>User</td>
                                                    <td>Activo</td>
                                            
                                                </tr>
                                                <tr>
                                                    <td>Rhona Davidson</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                            
                                                </tr>
                                                <tr>
                                                    <td>Colleen Hurst</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                           
                                                </tr>
                                                <tr>
                                                    <td>Sonya Frost</td>
                                                    <td>User</td>
                                                    <td>Activo</td>
                                            
                                                </tr>
                                                <tr>
                                                    <td>Jena Gaines</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                            
                                                </tr>
                                                <tr>
                                                    <td>Quinn Flynn</td>
                                                    <td>User</td>
                                                    <td>Activo</td>
                                                </tr>
                                                <tr>
                                                    <td>Charde Marshall</td>
                                                    <td>User</td>
                                                    <td>Inactivo</td>
                                            
                                                </tr>
                                                <tr>
                                                    <td>Haley Kennedy</td>
                                                    <td>User</td>
                                                    <td>Activo</td>
                                            
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <br>
                            <div class="card shadow mb-4" style="width: 30%;  left: 10%;">
                                <div class="card-header py-3" style="background-color: rgb(58, 162, 86);">
                                    <h6 class="m-0 font-weight-bold " style="color: black;"> Estado actual del curso</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <center>
                                                            Activo
                                                        </center>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="card shadow mb-4" style="width: 400px;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary"> Estado actual del curso</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr style="color: rgb(78, 115, 223);">
                                                    <!-- <th>Estado del curso</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>                                                    
                                                    <td>
                                                        <a href="#" class="btn btn-success btn-icon-split" >
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-check"></i>
                                                            </span>
                                                            <span class="text">Activar</span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                    <a href="#" class="btn btn-danger btn-icon-split" >
                                                        <span class="icon text-white-50">
                                                            <i class="fas fa-check"></i>
                                                        </span>
                                                        <span class="text">Desactivar</span>
                                                    </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <a href="gestion_cursos.php" class="btn btn-secondary btn-icon-split" style="left: 5%; position: relative;">
                    <span class="icon text-white-50">
                            <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Regresar</span>
                </a>
                <a href="#" class="btn btn-success btn-icon-split" style="left: 58%; position: relative;">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Guardar</span>
                </a> 
                
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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