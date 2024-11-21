<?php
    include "./conexion.php";
    $email = $_POST['txtUser'];
    $pass = $_POST['txtPass'];

    echo "Bienvenido $email Password: $pass";

    echo '<br>';

    $query = "select * from users where email='$email'and password ='$pass';";

    $res = $conexion -> query($query);
    if(mysqli_num_rows($res) > 0){
        echo 'login correcto';
        echo'<br>';
        $fila=mysqli_fetch_row($res);
        echo "id: ".$fila[0].'<br>';
        echo "nombre: ".$fila[1].'<br>';
        echo "email: ".$fila[2].'<br>';
    }else{
        echo 'datos no validos';
    }

?>