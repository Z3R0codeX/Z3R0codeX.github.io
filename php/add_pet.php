<?php
    $name = $_POST['txtname'];
    $specie = $_POST['txtespc'];
    $raza = $_POST['txtraza'];
    $fecha = $_POST['txtfecha'];

    $con= " NSERT INTO pets (name, img, species, breed, birth_date, main_image_id, status_id) 
            VALUES
                    ('$name', 'default.jpg', '$specie', '$raza', '$fecha', NULL, 1) ";


    echo $con;

?>