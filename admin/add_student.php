<?php
// session_start();
// // require 'connectDB.php';
// $usuario=$_SESSION['usuario'];
// if(!isset($usuario)){
// header("Location: ../login.html");
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registro Estudiante / Tutorias UPC-SA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style2.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Cargando...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <!-- Sidebar End -->
        <?php
        include "sidebar.php";
        ?>
        

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0" style="background-color: rgb(255, 255, 255);">
                    <img src="img/logo UPC.png" alt="" width="30px">
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="../cerrar_sesion.php" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Form Start -->
                <div style="padding-left: 20%">
                    <div  style="width: 100%; height: 50%;">
                        <div class="row g-4">
                            <div class="col-sm-12 col-xl-6">
                                <div class="bg-secondary rounded h-100 p-4">
                                    <h4 class="mb-4" style="color: black;">
                                        <center>
                                            <strong><em>Registro de usuarios</em></strong>
                                        </center>
                                    </h4>
                                    <form action="agregar_usuario.php" method="post">
                                        <div class="row mb-3">
                                            <h3 style="color: #4fa570;"><em><u>Número de Documento</u></em></h3>                                        <div class="col-sm-10">
                                                <input name="documento" required type="number" class="form-control" id="inputDoc">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <h3 style="color: #4fa570;"><em><u>Nombre</u></em></h3>                                        <div class="col-sm-10">
                                                <input name="nombre" required type="text" class="form-control" id="inputName">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <h3 style="color: #4fa570;"><em><u>Usuario</u></em></h3>                                        <div class="col-sm-10">
                                                <input name="usuario" required type="text" class="form-control" id="inputEmail3">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
    <h3 style="color: #4fa570;"><em><u>Password</u></em></h3>
    <div class="col-sm-10">
        <input name="contraseña" required type="password" class="form-control" id="inputPassword3" oninput="validarContraseña(this)">
        <small id="passwordHelp" class="form-text text-muted">Debe contener al menos 8 caracteres, incluyendo al menos una mayúscula, un número y un carácter especial.</small>
    </div>
</div>
                                        
                                        <!-- Radio Buttom Roll -->
                                        <fieldset class="row mb-3">
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="id_cargo" required
                                                        id="gridRadios1" value="2" checked>
                                                    <label class="form-check-label" for="gridRadios1">
                                                        Estudiante
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="id_cargo"
                                                        id="gridRadios2" value="3">
                                                    <label class="form-check-label" for="gridRadios2">
                                                        Docente
                                                    </label>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
    
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Form End -->
        </div>

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>