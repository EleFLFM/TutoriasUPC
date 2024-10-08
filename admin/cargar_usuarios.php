<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container-fluid pt-4 px-4"> 
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h3 class="mb-0" style="color: #4fa570;"><em><u>Estudiantes</u></em></h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-hover mb-0">
                            <thead>
                                <tr  style="color: #4fa570;">
                                    <th scope="col"><u>Documento</u></th>
                                    <th scope="col"><u>Nombre</u></th>
                                    <th scope="col"><u>Usuario</u></th>
                                    <th scope="col"><u>Cargo</u></th>
                                    <th scope="col"><u>Estado</u></th>
                                </tr>
                            </thead>

                            
                            <tbody>
                            <?php 
// Conexión a la base de datos
include "../conexion.php";
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
else{
    $consulta_usuario = "SELECT * FROM usuarios";
    $resultado = $conn->query($consulta_usuario);

   

    if($resultado){
        while($row = $resultado->fetch_array()){
            $documento = $row["documento"];
            $nombre = $row["nombre"];
            $usuario = $row["usuario"];
            $id_cargo = $row["idcargo"];
            if($id_cargo = $row["idcargo"]==2){
                $id_cargo="docente";
            }
            elseif($id_cargo = $row["idcargo"]==3){
                $id_cargo="estudiante";
            }
            ?>
               
                <div class="container-fluid pt-4 px-4"> 
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <!-- <h3 class="mb-0" style="color: #4fa570;"><em><u>Estudiantes</u></em></h3> -->
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-hover mb-0">
                            
                            <tbody>
                                <tr>
                                    <td><?php echo $documento ?></td>
                                    <td><?php echo $nombre ?></td>
                                    <td><?php echo $usuario ?></td>
                                    <td><?php echo $id_cargo ?></td>
                                    <td>Activo</td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
            <?php 
        }
    }
}


?>
</html>
