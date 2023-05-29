<?php
include_once "./header.php";
include_once "./conexion.php";

if(isset($_POST['enviar'])){
    $id = $_POST['idProf'];
    $nom = $_POST['nombreProf'];
    $ape1 = $_POST['apellidoProf'];
    $ape2 = $_POST['apellidoProf2'];
    $dni = $_POST['dniProf'];
    $telf = $_POST['telfProf'];
    $mail = $_POST['emailProf'];
    $clase = $_POST['deptProfe'];

    // Validar campos vacíos
    if(empty($id) || empty($nom) || empty($ape1) || empty($ape2) || empty($dni) || empty($telf) || empty($mail) || empty($clase)){
        echo "Todos los campos son obligatorios. Por favor, completa todos los campos.";
    } else {
        $query = $mysqli->prepare('UPDATE TB_PROFESOR SET DNI=?, Nombreprofesor=?, Apellidoprofesor=?, Apellido2profesor=?, Email=?, Telfprofe=?, IdDepartamento=? WHERE IdProfesor=?');
        $query->bind_param('ssssssis', $dni, $nom, $ape1, $ape2, $mail, $telf, $clase, $id);
        $query->execute();
        $query->close();
        header('Location: ../views/view1.php?orderBy=matricula_desc');
        exit();
    }
}
?>
