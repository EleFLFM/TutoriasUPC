<?php
session_start();
include('../conexion.php');

$usuario = $_SESSION['usuario'];
if(!isset($usuario)){
    header("Location: login.html");
    exit();
}

if(isset($_GET['code'])) {
    $course_code = $_GET['code'];
    
    // First, check if the course exists
    $check_query = "SELECT * FROM courses WHERE code = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("s", $course_code);
    $check_stmt->execute();
    $result = $check_stmt->get_result();
    
    if($result->num_rows == 0) {
        $_SESSION['error'] = "El curso no existe.";
        header("Location: index_course.php");
        exit();
    }
    
    // If the course exists, proceed with deletion
    $delete_query = "DELETE FROM courses WHERE code = ?";
    $delete_stmt = $conn->prepare($delete_query);
    $delete_stmt->bind_param("s", $course_code);
    
    if($delete_stmt->execute()) {
        $_SESSION['success'] = "Curso eliminado exitosamente.";
    } else {
        $_SESSION['error'] = "Error al eliminar el curso: " . $conn->error;
    }
    
    header("Location: index_course.php");
    exit();
} else {
    $_SESSION['error'] = "No se proporcionó el código del curso.";
    header("Location: index_course.php");
    exit();
}
?>