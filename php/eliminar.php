<?php
include "./conexion.php";

$tabla=$_POST['tabla'];
$col=$_POST['columna'];

$fila=$conexion->query("select * from $tabla where $col=".$_POST['id']);

$id=mysqli_fetch_row($fila); 
if(file_exists('../img/'.$id[0])){
    unlink('../img/'.$id[0]);
}
$conexion->query("delete from $tabla where $col=".$_POST['id']);

?>







