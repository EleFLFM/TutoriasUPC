
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
            include "sidebar_admin.php"
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
                                    $id = $_GET['id'];
include "../conexion.php";

if (isset($_POST['enviar'])) {
      // Recupera los valores del formulario
      $id_usuario = $_POST['id'];
      $course_code = $_POST['course_code'];
  
      // Verifica si el usuario ya está registrado en el curso
      $sql_verificar = "SELECT * FROM usuario_curso WHERE course_code = '$course_code' AND usuario_id = '$id_usuario'";
      $resultado_verificar = $conn->query($sql_verificar);
  
      if ($resultado_verificar->num_rows > 0) {
          // El usuario ya está registrado en el curso, muestra un mensaje de alerta
          echo '<script>alert("El usuario ya está matriculado en este curso.");
          location.href = "asign_student.php";</script>';
      } else {
          // El usuario no está registrado, procede con la matriculación
          $sql_matricular = "INSERT INTO usuario_curso (course_code, usuario_id) VALUES ('$course_code', '$id_usuario')";
          $resultado_matricular = $conn->query($sql_matricular);
  
          if ($resultado_matricular) {
              // Matriculación exitosa, redirige a asign_student.php
              echo '<script>alert("El usuario ha sido matriculado en el curso correctamente.");</script>';
              echo '<script>location.href = "asign_student.php";</script>';
          } else {
              // Error al matricular al usuario en el curso
              echo '<script>alert("Error al matricular al usuario en el curso: ' . $conn->error . '");
              location.href = "asign_student.php";</script>';
          }
      
      }
} else {
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        $row = $resultado->fetch_array();
        $id = $row["id"];
        $nombre = $row["nombre"];
        $usuario = $row["usuario"];
    }
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <div class="row mb-3">
        <h3 style="color: #4fa570;"><em><u>Nombre</u></em></h3>                                        
        <h4 style="color: rgb(184, 184, 184);"><?php echo $nombre?></h4>
    </div>
    <div class="row mb-3">
        <h3 style="color: #4fa570;"><em><u>Usuario</u></em></h3>    
        <h4 style="color: rgb(184, 184, 184);"><?php echo $usuario?></h4>                                    
    </div>

    <!-- Select con los nombres de los cursos desde la base de datos -->
    <div class="row mb-3">
        <h3 style="color: #4fa570;"><em><u>Cursos</u></em></h3>
        <select name="course_code">
            <?php
            // Consulta para obtener los cursos desde la base de datos
            $sql_cursos = "SELECT * FROM courses";
            $resultado_cursos = $conn->query($sql_cursos);

            if ($resultado_cursos) {
                while ($fila_curso = $resultado_cursos->fetch_assoc()) {
                    $code_curso = $fila_curso["code"];
                    $descripcion_curso = $fila_curso["descripcion"];
                    echo "<option value=\"$code_curso\">$descripcion_curso</option>";
                }
            }
            ?>
        </select>
    </div>

    <hr>
    <button type="submit" class="btn btn-primary" name="enviar">Matricular</button>
    <input type="hidden" name="id" value="<?php echo $id;?>">
</form>

<?php
}

// Cierra la conexión a la base de datos después de utilizarla
$conn->close();
?>

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