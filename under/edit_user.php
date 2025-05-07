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
                <?php
include "../conexion.php";

// Función para mostrar Sweet Alert y redirigir
function showSweetAlert($title, $text, $icon, $redirectUrl) {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: '<?php echo $title; ?>',
            text: '<?php echo $text; ?>',
            icon: '<?php echo $icon; ?>',
            confirmButtonText: 'Continuar',
            confirmButtonColor: '<?php echo ($icon == 'success') ? '#28a745' : '#dc3545'; ?>'
        }).then((result) => {
            window.location.href = '<?php echo $redirectUrl; ?>';
        });
    </script>   
    <?php
    exit;
}

// Verificar si el parámetro "documento" está en la URL o en POST
$documento = isset($_GET['documento']) ? $_GET['documento'] : (isset($_POST['documento']) ? $_POST['documento'] : null);

if (!$documento) {
    showSweetAlert('Error', 'Documento no especificado', 'error', 'gestion_usuario.php');
}

// Si es una solicitud POST para actualizar
if (isset($_POST['enviar'])) {
    // Capturar los datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $contraseña = $_POST["contraseña"];
    $id_cargo = mysqli_real_escape_string($conn, $_POST["id_cargo"]);
    $id_estado = mysqli_real_escape_string($conn, $_POST["id_estado"]);
    
    // Cifrar la nueva contraseña
    $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta de actualización
    $sql = "UPDATE usuarios SET 
            nombre = ?,
            usuario = ?,
            contraseña = ?,
            idcargo = ?,
            id_estado = ?
            WHERE documento = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nombre, $usuario, $hash_contraseña, $id_cargo, $id_estado, $documento);

    if ($stmt->execute()) {
        showSweetAlert('¡Actualización Exitosa!', 'Los datos del usuario han sido actualizados correctamente', 'success', 'gestion_usuario.php');
    } else {
        showSweetAlert('¡Error!', 'Error al actualizar los datos: ' . $conn->error, 'error', 'javascript:history.back()');
    }

    $stmt->close();
} 

// Consultar la base de datos para obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE documento = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $documento);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    showSweetAlert('Error', 'Usuario no encontrado', 'error', 'gestion_usuario.php');
}

$row = $resultado->fetch_assoc();
$nombre = $row["nombre"];
$usuario = $row["usuario"];
$id_cargo = $row["idcargo"];
$estado = $row["id_estado"];
?>

<div class="container-fluid" style="left: 5%; position: relative;">
    <div class="col-lg-7">
        <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Edición de Usuario</h1>
            </div>
            
            <form class="user" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?documento=' . $documento; ?>">
                <div class="col-sm-6 mb-3 mb-sm-0" style="left: 25%; position: relative;">
                    <input type="text" class="form-control form-control-user" name="documento" value="<?php echo htmlspecialchars($documento); ?>" readonly>
                </div>
                <br>
                <div class="col-sm-6" style="left: 25%; position: relative;">
                    <input type="text" class="form-control form-control-user" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                </div>
                <br>
                <div class="col-sm-6 mb-3 mb-sm-0" style="left: 25%; position: relative;">
                    <input type="text" class="form-control form-control-user" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>" required>
                </div>
                <br>
                <div class="col-sm-6" style="left: 25%; position: relative;">
                    <input type="password" class="form-control form-control-user" name="contraseña" placeholder="Nueva Contraseña" required>
                </div>
                <br>
                <hr>
                <fieldset>
                    <legend>Seleccione rol:</legend>
                    <div>
                        <input type="radio" id="docente" name="id_cargo" value="3" <?php echo ($id_cargo == 3) ? 'checked' : ''; ?> required />
                        <label for="docente">Docente</label>
                    </div>
                    <div>
                        <input type="radio" id="estudiante" name="id_cargo" value="2" <?php echo ($id_cargo == 2) ? 'checked' : ''; ?> />
                        <label for="estudiante">Estudiante</label>
                    </div>
                </fieldset>
                <hr>
                <fieldset>
                    <legend>Estado del Usuario:</legend>
                    <div>
                        <input type="radio" id="activo" name="id_estado" value="1" <?php echo ($estado == 1) ? 'checked' : ''; ?> required />
                        <label for="activo">Activo</label>
                    </div>
                    <div>
                        <input type="radio" id="inactivo" name="id_estado" value="2" <?php echo ($estado == 2) ? 'checked' : ''; ?> />
                        <label for="inactivo">Inactivo</label>
                    </div>
                </fieldset>
                <br>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <a href="gestion_usuario.php" class="btn btn-secondary btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-arrow-left"></i>
                            </span>
                            <span class="text">Regresar</span>
                        </a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" name="enviar" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-check"></i>
                            </span>
                            <span class="text">Guardar Cambios</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
$conn->close();
?>
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