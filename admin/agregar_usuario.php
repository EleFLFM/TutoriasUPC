<?php
include "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario y limpiarlos para evitar inyecciones
    $documento = mysqli_real_escape_string($conn, $_POST["documento"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $contraseña = $_POST["contraseña"]; 
    $id_cargo = mysqli_real_escape_string($conn, $_POST["id_cargo"]);
    $id_estado = 1;

    // Consultar si el usuario ya existe
    $consulta_usuario = "SELECT * FROM usuarios WHERE documento = ?";
    $stmt = $conn->prepare($consulta_usuario);
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $resultado_usuario = $stmt->get_result();

    if ($resultado_usuario->num_rows > 0) {
        // Si el usuario ya existe, mostrar alerta y redirigir
        echo "<script>alert('El usuario ya existe'); window.location.href = 'add_user.php';</script>";
    } else {
        // Cifrar la contraseña
        $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertar los datos en la tabla de usuarios usando una consulta preparada
        $sql = "INSERT INTO usuarios (documento, nombre, usuario, contraseña, idcargo, id_estado) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $documento, $nombre, $usuario, $hash_contraseña, $id_cargo, $id_estado);

        if ($stmt->execute()) {
            // Si la inserción fue exitosa, mostrar alerta y redirigir
            echo "<script>alert('Usuario agregado correctamente'); window.location.href = 'add_user.php';</script>";
        } else {
            // Mostrar error si hubo un problema en la inserción
            echo "<script>alert('Error al agregar usuario: " . $conn->error . "'); window.location.href = 'add_user.php';</script>";
        }
    }

    // Cerrar las conexiones
    $stmt->close();
    $conn->close();
}
?>
