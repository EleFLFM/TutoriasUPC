<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../conexion.php";

$response = ['status' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descripcion = $_POST['descripcion'];
    $semestre = $_POST['semestre'];

    $imagen = $_FILES['imagen'];
    $ruta_imagen = 'img_courses/' . basename($imagen['name']);

    if (move_uploaded_file($imagen['tmp_name'], $ruta_imagen)) {
        $consulta = "INSERT INTO courses (descripcion, imagen, semestre) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($consulta);
        $stmt->bind_param("sss", $descripcion, $ruta_imagen, $semestre);
        
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Curso guardado correctamente.';
        } else {
            $response['status'] = 'error';
            $response['message'] = "Error: " . $stmt->error;
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = "Error al cargar la imagen.";
    }

    echo json_encode($response);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Administrador / Tutorias UPC-SA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../admin/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../admin/css/style2.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <?php include "../admin/sidebar.php"; ?>
        
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="#" class="sidebar-toggler flex-shrink-0">
                <img src="../admin/logo UPC.png" alt width="30px">
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-none d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Mi Perfil</a>
                            <a href="../cerrar_sesion.php" class="dropdown-item">Cerrar Sesión</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid h-40 pt-4 px-4">
                <div class="bg-secondary rounded h-100 p-4">
                    <h2 class="mb-4 text-dark">Agregar Nuevo Curso</h2>
                    <form id="createCourseForm" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción del Curso:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                        </div>

                        <div class="mb-3">
                            <label for="semestre" class="form-label">Semestre:</label>
                            <select class="form-control" id="semestre" name="semestre" required>
                                <option value="">Seleccione un semestre</option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Cargar imagen:</label>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Agregar Curso</button>
                        <a href="index_course.php" class="btn btn-secondary">Regresar a Gestión de Cursos</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
    document.getElementById('createCourseForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);

        fetch('create_course.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: data.message,
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = 'index_course.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ha ocurrido un error inesperado'
            });
        });
    });
    </script>
</body>
</html>