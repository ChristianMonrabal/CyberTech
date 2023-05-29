<?php
include "./conexion.php";
include "./header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los campos obligatorios se hayan enviado
    if (empty($_POST['nombreProf']) || empty($_POST['apellidoProf1']) || empty($_POST['apellidoProf2']) || empty($_POST['dniProf']) || empty($_POST['telfProf']) || empty($_POST['emailProf']) || empty($_POST['deptProf'])) {
        echo "Por favor, complete todos los campos obligatorios.";
        exit;
    }
}
if (isset($_POST['enviar'])) {
    $nom = $_POST['nombreProf'];
    $ape1 = $_POST['apellidoProf1'];
    $ape2 = $_POST['apellidoProf2'];
    $dni = $_POST['dniProf'];
    $telf = $_POST['telfProf'];
    $mail = $_POST['emailProf'];
    $clase = $_POST['deptProf'];

    $query = $mysqli->prepare('INSERT INTO TB_PROFESOR (DNI, Nombreprofesor, Apellidoprofesor, Apellido2profesor, Email, Telfprofe, IdDepartamento) VALUES (?, ?, ?, ?, ?, ?, ?)');
    $query->bind_param('ssssssi', $dni, $nom, $ape1, $ape2, $mail, $telf, $clase);
    $query->execute();
    header('Location: ../views/view1.php?orderBy=matricula_desc');
}
?>