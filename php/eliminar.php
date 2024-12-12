<?php
include "./conexion.php";

$tabla = $_POST['tabla'];
$col = $_POST['columna'];
$folder = $_POST['folder'];

// Consulta para obtener los datos de la fila
$fila = $conexion->query("SELECT * FROM $tabla WHERE $col=" . intval($_POST['id']));
$id = mysqli_fetch_row($fila);

if ($id) { // Verifica que la fila exista
    $filePath = '../img/' . $folder . '/' . $id[0];
    
    // Elimina el archivo si existe
    if (file_exists($filePath)) {
        unlink($filePath);
    }

    // Realiza las eliminaciones correspondientes según la tabla
    if ($tabla == 'pets') {
        $conexion->query("DELETE FROM adoptions WHERE pet_id=" . intval($_POST['id'])) or die($conexion->error);
        $conexion->query("DELETE FROM pet_images WHERE pet_id=" . intval($_POST['id'])) or die($conexion->error);
        $conexion->query("DELETE FROM appointments WHERE pet_id=" . intval($_POST['id'])) or die($conexion->error);
        $conexion->query("DELETE FROM $tabla WHERE $col=" . intval($_POST['id'])) or die($conexion->error);
    } elseif ($tabla == 'users') {
        $conexion->query("DELETE FROM $tabla WHERE $col=" . intval($_POST['id'])) or die($conexion->error);
    }
} else {
    // Mensaje de error si no se encuentra el registro
    echo "Registro no encontrado en la tabla '$tabla'.";
}
?>

