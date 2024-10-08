<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "roles";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

function procesar_usuario($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $documento = $_POST["documento"];
        $nombre = $_POST["nombre"];
        $usuario = $_POST["usuario"];
        $contraseña = $_POST["contraseña"];
        $idcargo = $_POST["id_cargo"];
        $id_estado = 1;

        // Consultar si el usuario existe
        $consulta_usuario = "SELECT * FROM usuarios WHERE documento = '$documento'";
        $resultado_usuario = $conn->query($consulta_usuario);
        
        if ($resultado_usuario->num_rows > 0) {
            include("login.php");
                ?>
                <h1 class="bad">El usuario ya existe</h1>
                <?php    
        }
        else {
            //cifrar contraseña
            // $hash_contraseña = password_hash($contraseña, PASSWORD_DEFAULT);
            // Insertar los datos en la tabla de la base de datos
        $sql = "INSERT INTO usuarios (documento, nombre, usuario, contraseña, id_cargo)
        VALUES ('$documento', '$nombre', '$usuario', '$contraseña', '$idcargo', '$id_estado')";
    }
    if ($conn->query($sql) === TRUE) {
        include("login.php");
        ?>
        <h1 class="good">Registro exitoso</h1>
        <?php
    } else {
        include("login.php");
        ?>
        <h1 class="bad">Error</h1>
        <?php
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
}  
?>