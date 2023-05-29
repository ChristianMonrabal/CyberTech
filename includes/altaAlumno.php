<?php
include "./conexion.php";
include "./header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los campos obligatorios se hayan enviado
    if (empty($_POST['nombre']) || empty($_POST['apellido1']) || empty($_POST['apellido2']) || empty($_POST['dni']) || empty($_POST['fecha']) || empty($_POST['direccion']) || empty($_POST['telf']) || empty($_POST['email']) || empty($_POST['clase'])) {
        echo "Por favor, complete todos los campos obligatorios.";
        exit;
    }
}

if (isset($_POST['enviar'])) {
    $nom = $_POST['nombre'];
    $ape1 = $_POST['apellido1'];
    $ape2 = $_POST['apellido2'];
    $dni = $_POST['dni'];
    $telf = $_POST['telf'];
    $fecha = $_POST['fecha'];
    $direc = $_POST['direccion'];
    $mail = $_POST['email'];
    $clase = $_POST['clase'];

    $query = $mysqli->prepare('INSERT INTO TB_ALUMNOS (Nombre, Apellidoalumno, Apellido2alumno, DNI, Telefono, FechaNacimiento, Foto, Dirección, Email, IdClase) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $query->bind_param('sssssssssi', $nom, $ape1, $ape2, $dni, $telf, $fecha, $foto_ubicacion, $direc, $mail, $clase);
    $query->execute();
    header('Location: ../views/view1.php?orderBy=matricula_desc');
}
?>
