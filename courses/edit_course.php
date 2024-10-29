<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../conexion.php";

// Verificar si se ha proporcionado un código de curso
if (!isset($_GET['code'])) {
    header("Location: index_course.php");
    exit();
}

$code = $_GET['code'];

// Obtener los datos actuales del curso
$query = "SELECT * FROM courses WHERE code = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $code);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    header("Location: index_course.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $descripcion = $_POST['descripcion'];
    $semestre = $_POST['semestre'];
    $imagen_actual = $course['imagen'];

    // Manejar la carga de la nueva imagen si se proporciona
    if ($_FILES['imagen']['size'] > 0) {
        $imagen = $_FILES['imagen'];
        $ruta_imagen = 'img_courses/' . basename($imagen['name']);

        if (move_uploaded_file($imagen['tmp_name'], $ruta_imagen)) {
            // Si se carga una nueva imagen, actualizar la ruta
            $imagen_actual = $ruta_imagen;
        } else {
            echo "Error al cargar la nueva imagen.";
        }
    }

    // Actualizar los datos en la base de datos
    $consulta = "UPDATE courses SET descripcion = ?, imagen = ?, semestre = ? WHERE code = ?";
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("sssi", $descripcion, $imagen_actual, $semestre, $code);
    
    if ($stmt->execute()) {
        $_SESSION['success'] = "Curso actualizado correctamente.";
        header("Location: index_course.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Editar Curso - Administrador / Tutorias UPC-SA</title>
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
                    <h2 class="mb-4 text-dark">Editar Curso</h2>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción del Curso:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo htmlspecialchars($course['descripcion']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="semestre" class="form-label">Semestre:</label>
                            <select class="form-control" id="semestre" name="semestre" required>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>" <?php echo ($course['semestre'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="imagen" class="form-label">Imagen actual:</label>
                            <?php if (!empty($course['imagen'])): ?>
                                <img src="<?php echo htmlspecialchars($course['imagen']); ?>" alt="Imagen del curso" style="max-width: 200px; display: block; margin-bottom: 10px;">
                            <?php else: ?>
                                <p>No hay imagen cargada</p>
                            <?php endif; ?>
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            <small class="form-text text-muted">Deja este campo vacío si no quieres cambiar la imagen.</small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Actualizar Curso</button>
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
</body>
</html>