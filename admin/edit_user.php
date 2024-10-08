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
    <link href="css/style2.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
       
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

            <!-- Form Start -->
                <div style="padding-left: 20%">
                    <div  style="width: 100%; height: 50%;">
                        <div class="row g-4">
                            <div class="col-sm-12 col-xl-6">
                                <div class="bg-secondary rounded h-100 p-4">
                                    <h4 class="mb-4" style="color: black;">
                                        <center>
                                            <strong><em>Datos Usuario</em></strong>
                                        </center>
                                    </h4>
                                    <?php
include "../conexion.php";

if (isset($_POST['enviar'])) {
    $id = $_POST["id"];
    $documento = $_POST["documento"];
    $nombre = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];
    $idcargo = $_POST['idcargo'];  // Agregado
    $id_estado = $_POST['id_estado'];  // Agregado
    $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios
            SET documento = '$documento', nombre = '$nombre', usuario = '$usuario', contraseña = '$hash_contraseña', idcargo = '$idcargo',id_estado = '$id_estado' 
            WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
                alert("Se actualizaron los datos");
                location.assign("Gestion.php");
            </script>';
    } else {
        echo '<script>
                alert("Error al actualizar los datos: ' . $conn->error . '");
                location.assign("Gestion.php");
            </script>';
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $resultado = $conn->query($sql);

    if ($resultado) {
        $row = $resultado->fetch_array();
        $documento = $row["documento"];
        $nombre = $row["nombre"];
        $usuario = $row["usuario"];
        $contraseña = $row["contraseña"];
        $idcargo = $row["idcargo"];  // Agregado
        $id_estado = $row["id_estado"];  // Agregado
    }

    mysqli_close($conn);
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="row mb-3">
            <h3 style="color: #4fa570;"><em><u>Número de Documento</u></em></h3>
            <input type="text" name="documento" value="<?php echo $documento ?>">
        </div>
        <div class="row mb-3">
            <h3 style="color: #4fa570;"><em><u>Nombre</u></em></h3>
            <input type="text" name="nombre" value="<?php echo $nombre ?>">
        </div>
        <div class="row mb-3">
            <h3 style="color: #4fa570;"><em><u>Usuario</u></em></h3>
            <input type="text" name="usuario" value="<?php echo $usuario ?>">
        </div>
        <!-- <div class="row mb-3">
            <h3 style="color: #4fa570;"><em><u>Contraseña actual</u></em></h3>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="contraseña_actual">
            </div>
        </div> -->
        <div class="row mb-3">
            <h3 style="color: #4fa570;"><em><u> Contraseña Nueva </u></em></h3>
            <div class="col-sm-10">
                <input type="password" class="form-control" value="<?php echo $contraseña ?>" name="contraseña">
            </div>
        </div>

        <!-- Radio Buttom Roll -->
        <fieldset class="row mb-3">
        <!-- Cargo -->
<h3 style="color: #4fa570;"><em><u> Cargo </u></em></h3>
<div class="col-sm-10">
    <label>
        <input type="radio" name="idcargo" value="2" <?php echo ($idcargo == 2) ? 'checked' : ''; ?>>
        Estudiante
    </label>
    <br>
    <label>
        <input type="radio" name="idcargo" value="3" <?php echo ($idcargo == 3) ? 'checked' : ''; ?>>
        Docente
    </label>


                <br>
                <br>
                
               <h3 style="color: #4fa570;"><em><u> Estado de usuario </u></em></h3>

    <label>
        <input type="radio" name="id_estado" value="1" <?php echo ($id_estado == 1) ? 'checked' : ''; ?>>
        Activo
    </label>
    <br>
    <label>
        <input type="radio" name="id_estado" value="2" <?php echo ($id_estado == 2) ? 'checked' : ''; ?>>
        Inactivo
    </label>
</div>
               
            
        </fieldset>
        <hr>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit" class="btn btn-primary" name="enviar">Guardar</button>
    </form>
    <?php
}
?>

    <a href="Gestion.php">Regresar</a>

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