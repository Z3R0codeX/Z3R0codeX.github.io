<?php
include "./conexion.php";

if (isset($_POST['index']) && $_POST['index'] == 1) { // Verificar si el índice es 1
    if (isset($_POST['name']) && isset($_POST['mail']) && isset($_POST['pass']) && isset($_POST['pass2']) && isset($_POST['level'])) {
        
        $pass = $_POST['pass'];
        $pass2 = $_POST['pass2'];

        if ($pass !== $pass2) {
            header("Location: ../users.php?error=Las contraseñas no coinciden");
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
                        header("Location: ../users.php?success=Se han cargado todos los datos");
                    } else {
                        header("Location: ../users.php?error=Error al guardar en la base de datos");
                    }
                } else {
                    header("Location: ../users.php?error=Error al cargar el archivo");
                }
            } else {
                header("Location: ../users.php?error=El formato de imagen no es válido");
            }
        }
    } else {
        header("Location: ../users.php?error=Debe llenar todos los campos");
    }
} 
if (isset($_POST['index']) && $_POST['index'] == 2) { // Verificar si el índice es 2
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
                    header("Location: ../pets.php?error=Error al cargar la imagen: $imageName");
                    exit();
                }
            } else {
                header("Location: ../pets.php?error=Formato de imagen no válido para: $imageName");
                exit();
            }
        }

        // Validar que al menos haya una imagen principal
        if (!$mainImage) {
            header("Location: ../pets.php?error=Se requiere al menos una imagen válida");
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

            header("Location: ../pets.php?success=Mascota y sus imágenes agregadas correctamente");
        } catch (Exception $e) {
            // Revertir la transacción en caso de error
            $conexion->rollback();
            header("Location: ../pets.php?error=" . $e->getMessage());
        }
    } else {
        header("Location: ../pets.php?error=Debe llenar todos los campos y seleccionar imágenes válidas");
    }
} else {
    header("Location: ../pets.php?error=Acción no permitida");
}
?>
