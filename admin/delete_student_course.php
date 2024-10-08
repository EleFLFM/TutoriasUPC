<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Datos Usuario / Tutorias UPC-SA</title>
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
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style2.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php 
            include "sidebar_teach.php"
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
                            <span class="d-none d-lg-inline-flex">Docente</span>
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
                                            <strong><em>Ficha del Estudiante</em></strong>
                                        </center>
                                    </h4>
                                    <?php
include "../conexion.php";

if (isset($_POST["delete"])) {
    // Lógica para procesar la eliminación cuando se presiona el botón con name "delete"
    if (isset($_POST['usuario_id']) && isset($_POST['code_curso'])) {
        $usuario_id = $_POST['usuario_id'];
        $code_curso = $_POST['code_curso'];

        // Eliminar al estudiante del curso
        $sql_eliminar = "DELETE FROM usuario_curso WHERE course_code = '$code_curso' AND usuario_id = '$usuario_id'";
        $resultado_eliminar = $conn->query($sql_eliminar);

        if ($resultado_eliminar) {
            echo '<script>alert("El estudiante ha sido eliminado de el curso correctamente.");</script>';
            echo '<script>location.href = "home_teach.php";</script>';
        } else {
            echo '<script>alert("Error al eliminar al estudiante del curso: ");</script>'. $conn->error;;
            echo '<script>location.href = "home_teach.php";</script>';
        }
    } else {
        echo '<script>alert("Error: Faltan parámetros en el formulario.");</script>';
        echo '<script>location.href = "home_teach.php";</script>';
        
    }
} else {
    if (isset($_GET['id']) && isset($_GET['code'])) {
        $usuario_id = $_GET['id'];
        $code_curso = $_GET['code'];

        // Consulta para obtener la información del estudiante
        $consulta_estudiante = "SELECT nombre, usuario FROM usuarios WHERE id = '$usuario_id'";
        $resultado_estudiante = $conn->query($consulta_estudiante);

        if ($resultado_estudiante->num_rows > 0) {
            $fila_estudiante = $resultado_estudiante->fetch_assoc();
            $nombre_estudiante = $fila_estudiante["nombre"];
            $usuario_estudiante = $fila_estudiante["usuario"];
?>
            <form action="delete_student_course.php" method="post">
                <div class="row mb-3">
                    <h3 style="color: #4fa570;"><em><u>Nombre</u></em></h3>
                    <h4 style="color: rgb(184, 184, 184);"><?php echo $nombre_estudiante; ?></h4>
                </div>
                <div class="row mb-3">
                    <h3 style="color: #4fa570;"><em><u>Usuario</u></em></h3>
                    <h4 style="color: rgb(184, 184, 184);"><?php echo $usuario_estudiante; ?></h4>
                </div>

                <!-- Input oculto para enviar el usuario_id y el código del curso -->
                <input type="hidden" name="usuario_id" value="<?php echo $usuario_id; ?>">
                <input type="hidden" name="code_curso" value="<?php echo $code_curso; ?>">

                <hr>
                <input type="submit" name="delete" class="btn btn-primary" value="Eliminar del curso">
            </form>
<?php
        } else {
            echo "Error: No se encontró la información del estudiante.";
        }
    } else {
        echo "Error: Faltan parámetros en la URL.";
    }
}
?>
<br><br>
<a href="home_teach.php" class="">Regresar</a>



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