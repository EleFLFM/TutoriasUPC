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
    <title>Estudiantes / Tutorias UPC-SA</title>
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
        <?php 
            include "sidebar.php"
        ?>
        <!-- Sidebar End -->


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

             

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4"> 
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0" style="color: #4fa570;"><em><u>Estudiantes</u></em></h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-hover mb-0">
                            <thead>
                                <tr  style="color: #4fa570;">
                                    <th scope="col"><u>Documento</u></th>
                                    <th scope="col"><u>Nombre</u></th>
                                    <th scope="col"><u>Usuario</u></th>
                                    <th scope="col"><u>Cargo</u></th>
                                    <th scope="col"><u>Estado</u></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roles";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//con la condicion que no muestre cuando idcargo = 1 (admin)
$consulta_usuario = "SELECT * FROM usuarios WHERE idcargo <> 1 AND idcargo=2";
$resultado = $conn->query($consulta_usuario);

if ($resultado) {
    while ($row = $resultado->fetch_array()) {
        $documento = $row["documento"];
        if ($documento == null) {
            $documento = 1;
        }
        $nombre = $row["nombre"];
        $usuario = $row["usuario"];
        $id_cargo = $row["idcargo"];
        if ($id_cargo == 2) {
            $id_cargo = "Estudiante";
        } elseif ($id_cargo == 3) {
            $id_cargo = "Docente";
        }
        $id_estado = $row["id_estado"];
        if ($id_estado == 1) {
            $id_estado = "ACTIVO";
        } elseif ($id_estado == 2) {
            $id_estado = "INACTIVO";
        }
        ?>
        <tr>
            <td><?php echo $documento ?></td>
            <td><?php echo $nombre ?></td>
            <td><?php echo $usuario ?></td>
            <td><?php echo $id_cargo ?></td>
            <td><?php echo $id_estado ?></td>
        </tr>
    <?php
    }
}
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            <!-- Recent Sales End -->
            
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