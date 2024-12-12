<?php
    include "./conexion.php";
    
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validar campos
    if (!empty($username) && !empty($email) && !empty($password)) {
        // Encriptar contraseña
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Consulta SQL para insertar usuario
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado exitosamente.";
        } else {
            echo "Error al registrar el usuario: " . $conn->error;
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}

?>