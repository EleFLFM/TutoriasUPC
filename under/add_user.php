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
                <div class="col-lg-7" >
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Registro de Usuario</h1>
                            </div>

                            <div  >
                            <form action="agregar_usuario.php" method="post" class="user">
    <!-- Número de Documento -->
    <div class="col-sm-6 mb-3 mb-sm-0" style="left: 25%; position: relative;">
        <input name="documento" required type="number" class="form-control form-control-user" id="inputDoc" placeholder="Número de Documento">
    </div>
    <br>

    <!-- Nombre Completo -->
    <div class="col-sm-6" style="left: 25%; position: relative;">
        <input name="nombre" required type="text" class="form-control form-control-user" id="inputName" placeholder="Nombre Completo">
    </div>
    <br>

    <!-- Usuario -->
    <div class="col-sm-6 mb-3 mb-sm-0" style="left: 25%; position: relative;">
        <input name="usuario" required type="text" class="form-control form-control-user" id="inputUsuario" placeholder="Usuario">
    </div>
    <br>
    
    <!-- Contraseña -->
    <div class="col-sm-6" style="left: 25%; position: relative;">
        <input name="contraseña" required type="password" class="form-control form-control-user" id="inputPassword" placeholder="Contraseña" oninput="validarContraseña(this)">
        <small class="form-text text-muted" style="text-align: center;">
            Debe contener al menos 8 caracteres, incluyendo al menos una mayúscula, un número y un carácter especial.
        </small>
    </div>
    <br>
    <hr>

    <!-- Selección de Rol -->
    <fieldset style="text-align: center;">
        <legend>Seleccione Rol:</legend>
        <div>
            <input class="form-check-input" type="radio" id="docente" name="id_cargo" value="3" />
            <label class="form-check-label" for="docente">Docente / Tutor</label>
        </div>
        <div>
            <input class="form-check-input" type="radio" id="estudiante" name="id_cargo" value="2" checked />
            <label class="form-check-label" for="estudiante">Estudiante</label>
        </div>
    </fieldset>
    <hr>

    <!-- Botón de Enviar -->
    <button type="submit" class="btn btn-primary btn-user btn-block" style="width: 20%; left: 37%; position: relative;">
        Enviar
    </button>
</form>

<!-- <script>
function validarContraseña(input) {
    const regex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;
    if (!regex.test(input.value)) {
        input.setCustomValidity("La contraseña debe contener al menos 8 caracteres, incluyendo una mayúscula, un número y un carácter especial.");
    } else {
        input.setCustomValidity("");
    }
}
</script> -->

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