<?php session_start();
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
        echo "nivel: ".$fila[4].'<br>';

        $arreglo =[
            'id'=>$fila[0],
            'nombre'=>$fila[1],
            'email'=>$fila[2],
            'nivel'=>$fila[4]
        ];

        $_SESSION['userdata']=$arreglo;

        if($fila[4]==1){
            header("Location: ../dashboard.php");
        }else{
            header("Location: ../index.html");
        }

    }else{
        echo 'datos no validos';
        header("Location: ../login.php?error=datos no validos");
    }

?>







      