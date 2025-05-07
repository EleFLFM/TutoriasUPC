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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
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
                <div class="col-lg-7" >
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Creación de Curso</h1>
                            </div>

                            <div  >
                            <form class="user" action="add_course.php" method="POST">
    <!-- Campo para el código del curso -->
    <div class="col-sm-6 mb-3 mb-sm-0" style="left: 25%; position: relative;">
        <input type="text" class="form-control form-control-user" name="code" placeholder="Código del Curso" required>
    </div>
    <br>

    <!-- Campo para el nombre del curso -->
    <div class="col-sm-6 mb-3 mb-sm-0" style="left: 25%; position: relative;">
        <input type="text" class="form-control form-control-user" name="nombre_curso" placeholder="Nombre del Curso" required>
    </div>
    <br>

    <!-- Campo para el semestre -->
    <div class="col-sm-6" style="left: 25%; position: relative;">
        <input type="text" class="form-control form-control-user" name="semestre" placeholder="Semestre" required>
    </div>
    <br>

    <!-- Selector para el docente -->
    <div class="col-sm-6 mb-3" style="left: 25%; position: relative;">
        <select class="form-control form-control-user" name="docente_id">
            <option value="">Seleccione un docente (opcional)</option>
            <?php
            // Código PHP para obtener y listar los docentes desde la base de datos
            include "../conexion.php";
            $query = "SELECT id, nombre FROM usuarios WHERE idcargo = 3"; // Suponiendo que `idcargo = 3` corresponde a docentes
            $result = $conn->query($query);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['nombre']}</option>";
            }
            ?>
        </select>
    </div>
    <br>

    <hr>
    <a href="index_docente.php" class="btn btn-secondary btn-icon-split">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Regresar</span>
    </a>
    <button type="submit" class="btn btn-success btn-icon-split" style="left: 68%; position: relative;">
        <span class="icon text-white-50">
            <i class="fas fa-check"></i>
        </span>
        <span class="text">Guardar</span>
    </button>
</form>

                            </div>                            
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
    

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
    

</body>

</html>