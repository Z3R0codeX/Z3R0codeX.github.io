<?php
include "./conexion.php";
$ruta="";
if (isset($_POST['index']) && $_POST['index'] == 1) { // Verificar si el índice es 1

    if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['level'])) {
        
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if ($pass !== $pass2) {
            $ruta=("Location: ../users.php?error=Las contraseñas no coinciden");
        } else {
            $carpeta = "../img/users/";
            $nombre = $_FILES['imagen']['name'];
            $temp = explode('.', $nombre);
            $extension = end($temp);
            $finalName = time() . '.' . $extension;

            if ($extension == 'jpg' || $extension == 'png') {
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta . $finalName)) {
                    $query = $conexion->query(
                        "INSERT INTO users (username, email, password, level, user_img) 
                        VALUES (
                            '" . $_POST['name'] . "',
                            '" . $_POST['mail'] . "',
                            '" . $_POST['pass'] . "',
                            " . $_POST['level'] . ",
                            '$finalName'
                        )"
                    );

                    if ($query) {
                        $ruta=("Location: ../users.php?success=Se han cargado todos los datos");
                    } else {
                        $ruta=("Location: ../users.php?error=Error al guardar en la base de datos");
                    }
                } else {
                    $ruta=("Location: ../users.php?error=Error al cargar el archivo");
                }
            } else {
                $ruta=("Location: ../users.php?error=El formato de imagen no es válido");
            }
        }
    } else {
        $ruta=("Location: ../users.php?error=Debe llenar todos los campos");
    }
} else if (isset($_POST['index']) && $_POST['index'] == 2) { // Verificar si el índice es 2
    if (
        isset($_POST['txtname']) && 
        isset($_POST['txtespc']) && 
        isset($_POST['txtraza']) && 
        isset($_POST['txtfecha']) &&
        isset($_FILES['txtimg']) &&
        !empty($_FILES['txtimg']['name'][0]) // Validar que haya al menos una imagen
    ) {
        $name = $_POST['txtname'];
        $species = $_POST['txtespc'];
        $breed = $_POST['txtraza'];
        $birthDate = $_POST['txtfecha'];
        $images = $_FILES['txtimg'];

        $uploadDir = "../img/pets/"; // Directorio de subida de imágenes
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $mainImage = null;
        $uploadedImages = []; // Para almacenar las imágenes adicionales

        // Crear el directorio si no existe
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Procesar imágenes
        foreach ($images['name'] as $key => $imageName) {
            $tempName = $images['tmp_name'][$key];
            $extension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
            $uniqueName = time() . "_$key.$extension"; // Nombre único para evitar conflictos

            if (in_array($extension, $allowedExtensions)) {
                if (move_uploaded_file($tempName, $uploadDir . $uniqueName)) {
                    if ($key === 0) {
                        // La primera imagen será la principal
                        $mainImage = $uniqueName;
                    } else {
                        // Las imágenes restantes
                        $uploadedImages[] = $uniqueName;
                    }
                } else {
                    $ruta=("Location: ../pets.php?error=Error al cargar la imagen: $imageName");
                    exit();
                }
            } else {
                $ruta=("Location: ../pets.php?error=Formato de imagen no válido para: $imageName");
                exit();
            }
        }

        // Validar que al menos haya una imagen principal
        if (!$mainImage) {
            $ruta=("Location: ../pets.php?error=Se requiere al menos una imagen válida");
            exit();
        }

        // Iniciar una transacción para garantizar consistencia
        $conexion->begin_transaction();

        try {
            // Insertar la mascota en la tabla `pets`
            $stmtPet = $conexion->prepare("INSERT INTO pets (name, species, breed, birth_date, main_image_url) VALUES (?, ?, ?, ?, ?)");
            $stmtPet->bind_param("sssss", $name, $species, $breed, $birthDate, $mainImage);

            if (!$stmtPet->execute()) {
                throw new Exception("Error al insertar la mascota: " . $stmtPet->error);
            }

            $petId = $stmtPet->insert_id; // Obtener el ID de la mascota recién insertada
            $stmtPet->close();

            // Insertar imágenes adicionales en la tabla `pet_images`
            if (!empty($uploadedImages)) {
                $stmtImages = $conexion->prepare("INSERT INTO pet_images (pet_id, image_url) VALUES (?, ?)");

                foreach ($uploadedImages as $image) {
                    $stmtImages->bind_param("is", $petId, $image);
                    if (!$stmtImages->execute()) {
                        throw new Exception("Error al insertar una imagen: " . $stmtImages->error);
                    }
                }

                $stmtImages->close();
            }

            // Confirmar la transacción
            $conexion->commit();

            $ruta=("Location: ../pets.php?success=Mascota y sus imágenes agregadas correctamente");
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            $ruta=("Location: ../pets.php?error=" . $e->getMessage());
        }
    } else {
        $ruta=("Location: ../pets.php?error=Debe llenar todos los campos y seleccionar imágenes válidas");
    }
}else if(isset($_POST['index']) && $_POST['index'] == 10){

    if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['userid'])){

        $name=$_POST['name'];
        $mail=$_POST['mail'];
        $id=$_POST['userid'];

        $consulta="update users set username='$name', email='$mail' where user_id=$id";

        $conexion->query($consulta)or die($conexion->error);
        header("Location: ../users.php?status=1");

    }
    
}else if (isset($_POST['index']) && $_POST['index'] == 11) {
    if (isset($_POST['txtname']) && isset($_POST['txtespc']) && isset($_POST['txtraza']) && isset($_POST['txtfecha']) && isset($_POST['id'])) {

        $id = $_POST['id'];
        $name = $_POST['txtname'];
        $especie = $_POST['txtespc'];
        $raza = $_POST['txtraza'];
        $fecha = $_POST['txtfecha'];

        // Actualizar datos básicos de la mascota
        $consulta = "UPDATE pets SET name='$name', species='$especie', breed='$raza', birth_date='$fecha' WHERE pet_id=$id";
        $conexion->query($consulta) or die($conexion->error);

        // Procesar nueva imagen principal
        if (!empty($_FILES['txtimg']['name'][0])) {
            $uploadDir = "../img/pets/";
            $newImage = uniqid() . "-" . basename($_FILES['txtimg']['name'][0]);
            $uploadPath = $uploadDir . $newImage;

            // Obtener la URL de la imagen principal actual
            $result = $conexion->query("SELECT main_image_url FROM pets WHERE pet_id=$id");
            $currentImage = $result->fetch_assoc()['main_image_url'];

            // Eliminar la imagen anterior si existe
            if ($currentImage && file_exists($uploadDir . $currentImage)) {
                unlink($uploadDir . $currentImage);
            }

            // Subir la nueva imagen principal
            if (move_uploaded_file($_FILES['txtimg']['tmp_name'][0], $uploadPath)) {
                // Actualizar el campo main_image_url en la base de datos
                $conexion->query("UPDATE pets SET main_image_url='$newImage' WHERE pet_id=$id") or die("Error al actualizar imagen principal: " . $conexion->error);
            } else {
                echo "Error al mover la nueva imagen principal.";
            }
        }

        header("Location: ../pets.php?status=1");
        exit();
    }
}



else {
    $ruta=("Location: ../pets.php?error=Acción no permitida");
}

header($ruta);
?>
