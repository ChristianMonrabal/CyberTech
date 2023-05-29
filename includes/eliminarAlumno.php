<?php
include "./conexion.php";
include "./header.php";

if (isset($_GET['id_alu'])) {
    // Obtener el DNI del alumno seleccionado
    $IdAlumno = $_GET['id_alu'];

    // Eliminar el alumno de la base de datos
    $query = $mysqli->prepare('DELETE FROM TB_ALUMNOS WHERE Matricula = ?');
    $query->bind_param('i', $IdAlumno);
    $query->execute();

    // Redirigir a la página después de la eliminación
    header('Location: ../views/view1.php?orderBy=matricula_desc');
    exit(); // Asegurarse de detener la ejecución después de la redirección
}
?>