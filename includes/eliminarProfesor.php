<?php
include "./conexion.php";
include "./header.php";

if (isset($_GET['id_prof'])) {
    // Obtener el DNI del profesor seleccionado
    $IdProfesor = $_GET['id_prof'];

    // Eliminar el profesor de la base de datos
    $query = $mysqli->prepare('DELETE FROM TB_PROFESOR WHERE IdProfesor = ?');
    $query->bind_param('i', $IdProfesor);

    if ($query->execute()) {
        // Redirigir a la página después de la eliminación exitosa
        header('Location: ../views/view1.php?id_prof="$Idprofesor"');
        exit(); // Asegurarse de detener la ejecución después de la redirección
    } else {
        echo "Error al eliminar el profesor: " . $mysqli->error;
    }
}
?>
