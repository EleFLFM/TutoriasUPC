<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está logueado
if(!isset($_SESSION['usuario'])){
    header("Location: ../login.html");
    exit();
}

$usuario = $_SESSION['usuario'];
?>

<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark h-100 align-content-start">
        <a href="home-admin.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"><img src="../img/logo UPC.png" alt="" width="30px"> UPC-SA</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0" style="color: black;">
                    <?php echo strtoupper($usuario); ?>
                </h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="../admin/home-admin.php" class="nav-item nav-link"><i class="bi bi-house-door-fill me-2"></i>Inicio</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-person-fill me-2"></i>Usuarios</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="../admin/add_user.php" class="dropdown-item">Agregar Nuevo</a>
                    <a href="../admin/gestion_usuarios.php" class="dropdown-item">Gestión de Usuario</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-book-fill me-2"></i>Cursos</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="../courses/create_course.php" class="dropdown-item">Agregar Nuevo</a>
                    <a href="../courses/index_course.php" class="dropdown-item">Gestión de curso</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-table me-2"></i>Tablas</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="../admin/students.php" class="dropdown-item">Estudiante</a>
                    <a href="../admin/teach.php" class="dropdown-item">Docente</a>
                </div>
            </div>
        </div>
    </nav>
</div>