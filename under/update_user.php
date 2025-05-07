<?php
include "../conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $documento = mysqli_real_escape_string($conn, $_POST["documento"]);
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
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Actualización Exitosa!',
                    text: 'Los datos del usuario han sido actualizados correctamente',
                    icon: 'success',
                    confirmButtonText: 'Continuar',
                    confirmButtonColor: '#28a745'
                }).then((result) => {
                    window.location.href = 'usuarios.php';
                });
            });
        </script>
        <?php
    } else {
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Error!',
                    text: 'Error al actualizar los datos: <?php echo $conn->error; ?>',
                    icon: 'error',
                    confirmButtonText: 'Intentar nuevamente',
                    confirmButtonColor: '#dc3545'
                }).then((result) => {
                    window.history.back();
                });
            });
        </script>
        <?php
    }

    $stmt->close();
    $conn->close();
}
?>