<?php
include "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $documento = $_POST["documento"];
    $nombre = $_POST["nombre"];
    $usuario = $_POST["usuario"];
    $contraseña = $_POST["contraseña"];
    $id_cargo = $_POST["id_cargo"];
    $id_estado = 1;

    // Consultar si el usuario existe
    $consulta_usuario = "SELECT * FROM usuarios WHERE documento = '$documento'";
    $resultado_usuario = $conn->query($consulta_usuario);

    if ($resultado_usuario->num_rows > 0) {
        include("add_student.php");
        echo "<script>alert('El usuario ya existe')</script>";  
    } else {
        //cifrar contraseña
        $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
        // Insertar los datos en la tabla de la base de datos
        $sql = "INSERT INTO usuarios (documento, nombre, usuario, contraseña, idcargo, id_estado)
        VALUES ('$documento', '$nombre', '$usuario', '$hash_contraseña', '$id_cargo', '$id_estado')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Usuario agregado correctamente')</script>";
            include("add_student.php");
            ?>
            
            <?php
        } else {
            ?>
            <h1 class="bad">Error</h1>
            <?php
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>