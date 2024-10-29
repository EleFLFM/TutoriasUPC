<?php
session_start();
// require 'connectDB.php';
$usuario=$_SESSION['usuario'];
if(!isset($usuario)){
header("Location: ../login.html");
}
?>

<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="home_teach.php" class="navbar-brand mx-3 mb-3">
            <h3 class="text-primary"><img src="img/logo UPC.png" alt="" width="30px"> UPC-SA</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0" style="color: black;">
                    <?php
                    $usuario = strtoupper($usuario);
                    echo $usuario;
                    ?>
                </h6>
                <span>Docente</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <div>
                <a href="home_teach.php" class="nav-link">
                    <i class="bi bi-house-door-fill me-2"></i>
                    Inicio
                </a>
            </div>
            <div class="nav-item dropdown">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
        <i class="bi bi-journal-bookmark-fill me-2"></i>
        Cursos
    </a> 
   
    <div class="dropdown-menu bg-transparent border-0 overflow-auto">
    <?php           
        // Conexión a la base de datos
        if (file_exists('../conexion.php')) {
            include "../conexion.php";
        } else {
            die("Error al incluir el archivo de conexión.");
        }
        // con la condición que no muestre cuando idcargo = 1 (admin)
        $consulta_usuario = "SELECT * FROM courses";
        $resultado = $conn->query($consulta_usuario);
        
        if ($resultado) {
            while ($row = $resultado->fetch_array()) {
                $descripcion = $row["descripcion"];
                $code = $row["code"];
    ?>
         <a href='show_matriculados.php?code=<?php echo $code ?>' class='dropdown-item'><?php echo $descripcion?></a>
    <?php
            }
        }
    ?>
    </div>
</div>


            <div>
                <a href="asign_student.php" class="nav-link">
                    <i class="bi bi-person-lines-fill me-2"></i>
                    Matricular
                </a>
            </div>
        </div>
    </nav>
</div>
