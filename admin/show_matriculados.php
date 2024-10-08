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

            <div class="container-fluid pt-4 px-4"> 
                <div class="bg-secondary text-center rounded p-4">
                    <div class="table-responsive">
                    <?php
include "../conexion.php";

// Obtener el código del curso desde la URL
if (isset($_GET['code'])) {
    $code_curso = $_GET['code'];

    // Consulta para obtener la lista de estudiantes matriculados en el curso
    $consulta_matriculados = "SELECT usuarios.id, usuarios.nombre, usuarios.usuario, usuarios.id_estado
                              FROM usuarios
                              INNER JOIN usuario_curso ON usuarios.id = usuario_curso.usuario_id
                              WHERE usuario_curso.course_code = '$code_curso'";
    
    $resultado_matriculados = $conn->query($consulta_matriculados);

    if ($resultado_matriculados->num_rows > 0) {
?>
        <table class="table text-start align-middle table-hover mb-0">
            <thead>
                <tr style="color: #4fa570;">
                    <th scope="col"><u>Nombre</u></th>
                    <th scope="col"><u>Usuario</u></th>
                    <th scope="col"><u>Estado</u></th>
                    <th scope="col"><u>Detalles</u></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($fila_matriculado = $resultado_matriculados->fetch_assoc()) {
                    $id_estudiante = $fila_matriculado["id"];
                    $nombre = $fila_matriculado["nombre"];
                    $usuario = $fila_matriculado["usuario"];
                    $id_estado = $fila_matriculado["id_estado"];
                ?>
                    <tr>
                        <td><?php echo $nombre ?></td>
                        <td><?php echo $usuario ?></td>
                        <td><?php echo ($id_estado == 1) ? "Activo" : "Inactivo"; ?></td>
                        <td>
                            <a href="delete_student_course.php?id=<?php echo $id_estudiante ?>&code=<?php echo $code_curso ?>">
                                <button style="background-color: rgb(141, 142, 138);">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
<?php
    } else {
        echo "No existen matriculas de estudiantes.";
    }
} else {
    echo "Error: Falta el código del curso en la URL.";
}
?>
<br><br>
<a href="home_teach.php" class="">Regresar</a>

                    </div>
                </div>
            </div>
             


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