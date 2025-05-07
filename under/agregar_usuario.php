<!-- archivo agregar_usuario -->
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

    // Consultar si existe el documento
    $consulta_documento = "SELECT * FROM usuarios WHERE documento = ?";
    $stmt = $conn->prepare($consulta_documento);
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        // El documento ya existe
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Documento Duplicado!',
                    text: 'Ya existe un usuario registrado con el documento <?php echo $documento; ?>',
                    icon: 'warning',
                    confirmButtonText: 'Entendido',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    window.location.href = 'add_user.php';
                });
            });
        </script>
        <?php
        exit();
    } else {
        // Cifrar la contraseña
        $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);

        // Insertar los datos en la tabla de usuarios
        $sql = "INSERT INTO usuarios (documento, nombre, usuario, contraseña, idcargo, id_estado) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssii", $documento, $nombre, $usuario, $hash_contraseña, $id_cargo, $id_estado);

        if ($stmt->execute()) {
            // Usuario agregado exitosamente
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: 'Usuario agregado correctamente',
                        icon: 'success',
                        confirmButtonText: 'Continuar',
                        confirmButtonColor: '#28a745'
                    }).then((result) => {
                        window.location.href = 'add_user.php';
                    });
                });
            </script>
            <?php
        } else {
            // Error al agregar usuario
            ?>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        title: '¡Error!',
                        text: 'Error al agregar usuario: <?php echo $conn->error; ?>',
                        icon: 'error',
                        confirmButtonText: 'Intentar nuevamente',
                        confirmButtonColor: '#dc3545'
                    }).then((result) => {
                        window.location.href = 'add_user.php';
                    });
                });
            </script>
            <?php
        }
    }

    // Cerrar las conexiones
    $stmt->close();
    $conn->close();
}
?>