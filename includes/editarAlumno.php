
<?php
include_once "./header.php";
include_once "./conexion.php";

if(isset($_POST['enviar'])){
    $matricula = $_POST['matriculaAlu'];
    $nom = $_POST['nombreAlu'];
    $ape1 = $_POST['apellidoAlu'];
    $ape2 = $_POST['apellidoAlu2'];
    $dni = $_POST['dniAlu'];
    $fecha = $_POST['edadAlu'];
    $direc = $_POST['direccionAlu'];
    $telf = $_POST['telfAlu'];
    $email = $_POST['emailAlu'];
    $clase = $_POST['claseAlu'];

    // Validar campos vacíos
    if(empty($nom) || empty($ape1) || empty($ape2) || empty($dni) || empty($fecha) || empty($direc) || empty($telf) || empty($email) || empty($clase)){
        echo "Todos los campos son obligatorios. Por favor, completa todos los campos.";
    } else {
        $query = $mysqli->prepare('UPDATE TB_ALUMNOS SET Nombre=?, ApellidoAlumno=?, Apellido2Alumno=?, DNI=?, FechaNacimiento=?, Dirección=?, Telefono=?, Email=?, IdClase=? WHERE Matricula=?');
        $query->bind_param('ssssssssii', $nom, $ape1, $ape2, $dni, $fecha, $direc, $telf, $email, $clase, $matricula);
        $query->execute();
        $query->close();

        header('Location: ../views/view1.php?orderBy=matricula_desc');
        exit();
    }
}
?>
