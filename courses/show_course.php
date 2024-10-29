<?php
session_start();
$usuario = $_SESSION['usuario'] ?? null;
if (!isset($usuario)) {
    header("Location: login.html");
    exit();
}

// Incluir el archivo de conexión
require_once('../conexion.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener el código del curso desde la URL
$code = $_GET['code'] ?? null;

if ($code) {
    // Consulta para obtener el curso específico según el código
    $query = "SELECT * FROM courses WHERE code = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $code);
    $stmt->execute();
    $result = $stmt->get_result();
    $course = $result->fetch_assoc();
} else {
    $course = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="icon" type="image/vnd.icon" href="assets/images/favicon.ico">
    <title>Cursos / Tutorías UPC-SA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/templatemo-grad-school.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <link rel="stylesheet" href="../assets/css/lightbox.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/preloader.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/bootstrap.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/meanmenu.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/animate.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/owl.carousel.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/swiper-bundle.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/backToTop.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/jquery.fancybox.min.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/elegantFont.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/default.css">
    <link rel="stylesheet" href="./Educal – Online Learning and Education HTML5 Template_files/style.css">

 
  </head>

<body>
<header class="main-header clearfix" role="header">
         <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
         <div class="logo">
            <a href="../admin/home-admin.php"><img src="../assets/images/logo-universidad-popular-del-cesar.png " width="20%"  alt="Logo" style="color: black;"></a>
         </div>
        
         <nav id="menu" class="main-nav" role="navigation">
            <ul class="main-menu">
               <li> 
                  <a href="../cerrar_sesion.php" class="external" style="background-color: rgb(60, 155, 97, 0.9); color: bisque;" >
                     Cerrar sesión
                  </a>
               </li>
            </ul>
            <div class="bienvenido" style="padding-top: 30px;" >
               <?php
                  $usuarioMayus = strtoupper($usuario);
                  echo "<h3>BIENVENIDO  $usuarioMayus </h3>";  
               ?> 
            </div>
         </nav>
      </header>
      <main>
        <section class="pt-120 pb-120" style="background-color: rgb(60, 155, 97, 0.9);">
            <div class="container">
                <?php if ($course): ?>
                    <div class="course-info">
                        <h2><?php echo htmlspecialchars($course['descripcion']); ?></h2>
                        <div class="row">
                            <div class="col-md-3 label">Código del curso:</div>
                            <div class="col-md-9"><?php echo htmlspecialchars($course['code']); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 label">Semestre:</div>
                            <div class="col-md-9"><?php echo htmlspecialchars($course['semestre']); ?> Semestre</div>
                        </div>
                        <?php if (!empty($course['imagen'])): ?>
                        <div class="row">
                            <div class="col-md-3 label">Imagen del curso:</div>
                            <div class="col-md-9">
                                <img src="<?php echo htmlspecialchars($course['imagen']); ?>" alt="Imagen del curso" style="max-width: 300px;">
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="course-actions">
                            <a href="show_course.php?code=<?php echo $course['code']; ?>" class="btn btn-primary">
                                <i class="fas fa-eye"></i> Ver detalles
                            </a>
                            <a href="edit_course.php?code=<?php echo $course['code']; ?>" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="delete_course.php?code=<?php echo $course['code']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?');">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">No se encontró el curso solicitado.</div>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer style="background-color: rgb(6, 67, 10);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><i class="fa fa-copyright"></i> Copyright 2023 by Universidad Popular del Cesar</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<style>
        .course-info {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .course-info h2 {
            color: #3c9b61;
            margin-bottom: 20px;
        }
        .course-info .row {
            margin-bottom: 15px;
        }
        .course-info .label {
            font-weight: bold;
        }
        .course-actions {
            margin-top: 20px;
        }
        .course-actions .btn {
            margin-right: 10px;
        }
    </style>