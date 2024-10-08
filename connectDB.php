<?php session_start();

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

include "conexion.php";
$consulta = "SELECT * FROM usuarios WHERE usuario='$usuario'";
$resultado = mysqli_query($conn, $consulta);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $contraseña_hash = $fila['contraseña'];

    if (password_verify($contraseña, $contraseña_hash)) {
        $_SESSION['usuario'] = $usuario;
        $_SESSION['idcargo'] = $fila['idcargo'];
        $idcargo = $_SESSION['idcargo'];
        $_SESSION['id_estado'] = $fila['id_estado'];
        $id_estado = $_SESSION['id_estado'];

        if ($id_estado == 1) {
            if ($idcargo == 1) {
                // Mostrar la página de administrador
                header("location: admin/home-admin.php");
            } elseif ($idcargo == 2) {
                // Redirigir a la página de estudiantes
                header("location: courses.php");
            } elseif ($idcargo == 3) {
                // Redirigir a la página de docentes
                header("location: admin/home_teach.php");
            }
        } else {
            echo '<script>alert("No tienes permisos para acceder a esta página. Este usuario está inactivo");
            location.href = "login.html";</script>';
            exit();
        }
    } else {
       echo '<script>alert("Contraseña incorrecta.");
          location.href = "login.html";</script>';
        exit();
    }
} else {
    include("login.html");
}

mysqli_free_result($resultado);
mysqli_close($conn);
?>