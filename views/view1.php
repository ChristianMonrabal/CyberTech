<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    // Usuario no ha iniciado sesión, redireccionar al formulario de inicio de sesión
    header("Location: ../index.php");
    exit();
}
?>
<?php
include  "../includes/conexion.php";
$queryAlumnos = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección,a.Telefono, a.Email, c.Nombreclase from TB_ALUMNOS a INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase";
$queryProfesores = "SELECT p.IdProfesor, p.DNI, p.Nombreprofesor, p.Apellidoprofesor, p.Apellido2profesor, p.Email, p.Telfprofe, d.Nombredepartamento
FROM TB_PROFESOR p
INNER JOIN TB_DEPARTAMENTO d ON p.IdDepartamento = d.IdDepartamento ORDER BY p.IdProfesor ASC";
$resultAlumnos = $mysqli->query($queryAlumnos);
$resultProfesores = $mysqli->query($queryProfesores);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberTech</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="shortcut icon" href="../sources/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>
<body>

<!--NavBar-->
<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">J24</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#" onclick="showAlumnosTable()">Tabla Alumnos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#" onclick="showProfesoresTable()">Tabla Profesores</a>
                </li>
                <li class="nav-item dropdown">
                <div class="btn-group">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="page">Altas</button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#formularioAlumno">Nuevo Alumno</a></li>
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#formularioProfesor">Nuevo Profesor</a></li>
                    </ul>
                </div>
                </li>
            </ul>
            <form class="d-flex" role="search" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input class="form-control me-2" type="search" name="search" placeholder="Búsqueda" aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-outline-success" type="submit" name="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
<br>
<br>
<!-- Tabla ALUMNOS -->
<table class="table table-bordered" id="tablaAlumnos" onclick="showAlumnosTable()" style="display: none;" >
    <thead>
        <tr>
            <th><a href="?orderBy=<?php echo (isset($_GET['orderBy']) && $_GET['orderBy'] === 'matricula') ? 'matricula_desc' : 'matricula'; ?>" class="no-decoration" onclick="showAlumnosTable()">Matricula</a></th>
            <th>DNI</th>
            <th><a href="?orderBy=<?php echo (isset($_GET['orderBy']) && $_GET['orderBy'] === 'nombre') ? 'nombre_desc' : 'nombre'; ?>" class="no-decoration" onclick="showAlumnosTable()">Nombre</a></th>
            <th>1er Apellido</th>
            <th>2n Apellido</th>
            <th>Fecha de nacimiento</th>
            <th>Dirección</th>
            <th>Telefono</th>
            <th>Mail</th>
            <th>Clase</th>
            <th>Mas acciones</th>
        </tr>
    </thead>   
    <tbody>
    
    <?php
    $hideTable1 = false;
    $hideTable2 = false;


    $search = isset($_GET['search']) ? $_GET['search'] : '';

            if (!empty($search)) {
                // Modificar la consulta para incluir la búsqueda
                $consulta = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección, a.Telefono, a.Email, c.Nombreclase
                FROM TB_ALUMNOS a
                INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase WHERE Nombre LIKE '%$search%' OR Apellidoalumno LIKE '%$search%' OR DNI LIKE '%$search%' OR Apellido2alumno LIKE '%$search%' OR Dirección LIKE '%$search%' OR Telefono LIKE '%$search%' OR Email LIKE '%$search%' ";
                $resultado = $mysqli->query($consulta);
                $hideTable = true;
            } else if (isset($_GET['orderBy']) && $_GET['orderBy'] === 'nombre' ) {
                // Consulta SQL con ordenación alfabética descendente por nombre
                $consulta = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección, a.Telefono, a.Email, c.Nombreclase
                FROM TB_ALUMNOS a
                INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase WHERE Nombre LIKE '%$search%' OR Apellidoalumno LIKE '%$search%' OR DNI LIKE '%$search%' OR Apellido2alumno LIKE '%$search%' OR Dirección LIKE '%$search%' OR Telefono LIKE '%$search%' OR Email LIKE '%$search%' ORDER BY Nombre DESC ";
                $resultado = $mysqli->query($consulta);
                $hideTable = true;
            } else if (isset($_GET['orderBy']) && $_GET['orderBy'] === 'nombre_desc') {
                // Consulta SQL con ordenación alfabética ascendente por nombre
                $consulta = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección, a.Telefono, a.Email, c.Nombreclase
                FROM TB_ALUMNOS a
                INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase WHERE Nombre LIKE '%$search%' OR Apellidoalumno LIKE '%$search%' OR DNI LIKE '%$search%' OR Apellido2alumno LIKE '%$search%' OR Dirección LIKE '%$search%' OR Telefono LIKE '%$search%' OR Email LIKE '%$search%' ORDER BY Nombre ASC ";
                $resultado = $mysqli->query($consulta);
                $hideTable = true;
            } else if (isset($_GET['orderBy']) && $_GET['orderBy'] === 'matricula') {
                // Consulta SQL con ordenación alfabética descendente por matrícula
                $consulta = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección, a.Telefono, a.Email, c.Nombreclase
                FROM TB_ALUMNOS a
                INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase WHERE Nombre LIKE '%$search%' OR Apellidoalumno LIKE '%$search%' OR DNI LIKE '%$search%' OR Apellido2alumno LIKE '%$search%' OR Dirección LIKE '%$search%' OR Telefono LIKE '%$search%' OR Email LIKE '%$search%' ORDER BY Matricula DESC ";
                $resultado = $mysqli->query($consulta);
                $hideTable = true;
            } else if (isset($_GET['orderBy']) && $_GET['orderBy'] === 'matricula_desc') {
                // Consulta SQL con ordenación alfabética ascendente por matrícula
                $consulta = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección, a.Telefono, a.Email, c.Nombreclase
                FROM TB_ALUMNOS a
                INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase WHERE Nombre LIKE '%$search%' OR Apellidoalumno LIKE '%$search%' OR DNI LIKE '%$search%' OR Apellido2alumno LIKE '%$search%' OR Dirección LIKE '%$search%' OR Telefono LIKE '%$search%' OR Email LIKE '%$search%'  ORDER BY Matricula ASC ";
                $resultado = $mysqli->query($consulta);
                $hideTable = true;
            } else {
                // Mostrar la tabla por defecto sin filtros ni búsqueda
                $consulta = "SELECT a.Matricula, a.DNI, a.Nombre, a.Apellidoalumno, a.Apellido2alumno, a.FechaNacimiento, a.Dirección, a.Telefono, a.Email, c.Nombreclase
                FROM TB_ALUMNOS a
                INNER JOIN TB_CLASE c ON c.IdClase = a.IdClase  ";
                $_SESSION['primeraVez'] = false; // Ya no es la primera vez
                $resultado = $mysqli->query($consulta);
            }

            // Ejecutar la consulta y mostrar los resultados en la tabla
            $resultado = $mysqli->query($consulta);

            $encontrados = false; // Variable para verificar si se
    
    if ($resultado->num_rows == 0) {
        echo '<tr><td colspan="11" style="vertical-align: middle;">No se encontraron resultados <button class="btn" style="margin-left: 60%;" onclick="mostrarTablaPorDefecto()">Mostrar todos los datos de la tabla</button></td></tr>';
    } else {
        $alu=0;
            while ($row = $resultado->fetch_array()) {
                $encontrados = true; // Se encontraron resultados
                $fila = "<tr>";
                $fila .= "<td id='alu_matricula_".$alu."'>" . $row["Matricula"] . "</td>";
                $fila .= "<td id='alu_dni_".$alu."'>" . $row["DNI"] . "</td>";
                $fila .= "<td id='alu_nombre_".$alu."'>" . $row["Nombre"] . "</td>";
                $fila .= "<td id='alu_apellido_".$alu."'>" . $row["Apellidoalumno"] . "</td>";
                $fila .= "<td id='alu_apellido2_".$alu."'>" . $row["Apellido2alumno"] . "</td>";
                $fila .= "<td id='alu_edad_".$alu."'>" . $row["FechaNacimiento"] . "</td>";
                $fila .= "<td id='alu_direccion_".$alu."'>" . $row["Dirección"] . "</td>";
                $fila .= "<td id='alu_telefono_".$alu."'>" . $row["Telefono"] . "</td>";
                $fila .= "<td id='alu_email_".$alu."'>" . $row["Email"] . "</td>";
                $fila .= "<td id='alu_clase_".$alu."'>" . $row["Nombreclase"] . "</td>";
                $fila .= "<td>
                    <div class='btn-group'>
                        <button class='btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='page'>Extras</button>
                        <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                            <li><a class='dropdown-item' onclick='getDataAlu(".$alu.")' data-bs-toggle='modal' data-bs-target='#EditarformularioAlumno'>Editar Alumnos</a></li>
                            <li><a class='dropdown-item' href='../includes/eliminarAlumno.php?id_alu=" . $row['Matricula'] . "' data-bs-toggle='modal'>Eliminar Alumno</a></li>                   
                        </ul>
                    </div>
                </td>";
                $fila .= "</tr>";
                echo $fila;
                $resu2=$resu2+1;
            }
            echo "<tr><td colspan='11'>Se encontraron $resu2 resultados en la tabla alumnos</td></tr>";

    }  
?>
    </tbody>
</table>

<?php
    if ($hideTable == true) {
        // Cambiar la propiedad display de la tabla tablaAlumnos
        echo '<script>document.getElementById("tablaAlumnos").style.display = "table";</script>';
    }
?>

<!-- Tabla PROFESORES -->
<table class="table table-bordered" id="tablaProfesores" style="display: none;" >
    <thead>
        <tr>
            <th>Id</th>
            <th><a href="?orderBy2=<?php echo (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'nombrep') ? 'nombrep_desc' : 'nombrep'; ?>" class="no-decoration" onclick="showProfesoresTable()" href="#">Nombre</a></th>
            <th><a href="?orderBy2=<?php echo (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'apellidop') ? 'apellidop_desc' : 'apellidop'; ?>" class="no-decoration" onclick="showProfesoresTable()" href="#">Primer apellido</a></th>
            <th><a href="?orderBy2=<?php echo (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'apellidos') ? 'apellidos_desc' : 'apellidos'; ?>" class="no-decoration" onclick="showProfesoresTable()" href="#">Segundo apellido</a></th>
            <th>Email</th>
            <th>DNI</th>
            <th>Telefono</th>
            <th>Nombre Departamento</th>
            <th>Mas acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $hideTable1 = false;
        $hideTable2 = false;

        if (!empty($search)) {
            // Modificar la consulta para incluir la búsqueda
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento WHERE Nombreprofesor LIKE '%$search%' OR Apellidoprofesor LIKE '%$search%' OR DNI LIKE '%$search%' OR Apellido2profesor LIKE '%$search%' OR IdDepartamento LIKE '%$search%' OR Telfprofe LIKE '%$search%' OR Email LIKE '%$search%';";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else if (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'nombrep') {
            // Consulta SQL con ordenación alfabética descendente por nombre
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento ORDER BY Nombreprofesor DESC;";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else if (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'nombrep_desc') {
            // Consulta SQL con ordenación alfabética ascendente por nombre
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento ORDER BY Nombreprofesor ASC;";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else if (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'apellidop') {
            // Consulta SQL con ordenación alfabética descendente por nombre
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento ORDER BY Apellidoprofesor DESC;";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else if (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'apellidop_desc') {
            // Consulta SQL con ordenación alfabética ascendente por nombre
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento ORDER BY Apellidoprofesor ASC;";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else if (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'apellidos') {
            // Consulta SQL con ordenación alfabética descendente por nombre
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento ORDER BY Apellido2profesor DESC;";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else if (isset($_GET['orderBy2']) && $_GET['orderBy2'] === 'apellidos_desc') {
            // Consulta SQL con ordenación alfabética ascendente por nombre
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento ORDER BY Apellido2profesor ASC;";
            $resultado = $mysqli->query($consulta);
            $hideTable2 = true;
        } else {
            // Mostrar la tabla por defecto sin filtros ni búsqueda
            $consulta = "SELECT a.IdProfesor, a.DNI, a.Nombreprofesor, a.Apellidoprofesor, a.Apellido2profesor, a.Email, a.Telfprofe, c.Nombredepartamento FROM TB_PROFESOR a INNER JOIN TB_DEPARTAMENTO c ON c.IdDepartamento = a.IdDepartamento;";
            $resultado = $mysqli->query($consulta);

        }

        // Ejecutar la consulta y mostrar los resultados en la tabla
        $resultado = $mysqli->query($consulta);

        $encontrados = false; // Variable para verificar si se encontraron resultados

        if ($resultado->num_rows == 0) {
            echo "<tr><td colspan='11'>No se encontraron resultados en la tabla profesores</td></tr>";
        } else {
            $prof = 0;
            while ($row = $resultado->fetch_array()) {
                $fila = "<tr>";
                $fila .= "<td id='prof_id_".$prof."'>" . $row["IdProfesor"] . "</td>";
                $fila .= "<td id='prof_nombre_".$prof."'>" . $row["Nombreprofesor"] . "</td>";
                $fila .= "<td id='prof_apellido_".$prof."'>" . $row["Apellidoprofesor"] . "</td>";
                $fila .= "<td id='prof_apellido2_".$prof."'>" . $row["Apellido2profesor"] . "</td>";
                $fila .= "<td id='prof_email_".$prof."'>" . $row["Email"] . "</td>";
                $fila .= "<td id='prof_dni_".$prof."'>" . $row["DNI"] . "</td>";
                $fila .= "<td id='prof_telf_".$prof."'>" . $row["Telfprofe"] . "</td>";
                $fila .= "<td id='prof_dept_".$prof."'>" . $row["Nombredepartamento"] . "</td>";
                $fila .= "<td>
                <div class='btn-group'>
                    <button class='btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='page'>Extras</button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                    <li><a class='dropdown-item' onclick='getDataProf(".$prof.")' data-bs-toggle='modal' data-bs-target='#editarProfesor'>Editar Profesor</a></li>
                    <li><a class='dropdown-item' href='../includes/eliminarProfesor.php?id_prof=" . $row['IdProfesor'] . "' data-bs-toggle='modal'>Eliminar Profesor</a></li>                   
                        </ul>
                </div>
            </td>";
                echo $fila;
                $prof = $prof + 1;
            }
            echo "<tr><td colspan='11'>Se encontraron $prof resultados en la tabla profesores</td></tr>";

        }
        ?>
    </tbody>
</table>

<?php
    if ($hideTable2 == true) {
        // Cambiar la propiedad display de la tabla tablaAlumnos
        echo '<script>document.getElementById("tablaProfesores").style.display = "table";</script>';
    }
    ?>

<!-- Formulario Nuevo Alumno -->
<div class="modal fade" id="formularioAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alta alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="scrollable-modal-body">
                    <form id="formAlumno" action="../includes/altaAlumno.php" method="POST" onsubmit="return validarFormularioAlumno()">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese el nombre del alumno" required>
                            <span id="error-nombre" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="apellido" name="apellido1" placeholder="Ingrese el apellido del alumno" required>
                            <span id="error-apellido" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido2" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="apellido2" name="apellido2" placeholder="Ingrese el apellido del alumno" required>
                            <span id="error-apellido2" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese el dni del alumno" required>
                            <span id="error-dni" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="edad" name="fecha" max="<?php echo date('Y-m-d', strtotime('-1 years')); ?>" placeholder="Ingrese la fecha de nacimiento del alumno" required>
                            <span id="error" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingrese la dirección del alumno" required>
                            <span id="error-direccion" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="numTelefono" class="form-label">Número de teléfono:</label>
                            <input type="number" class="form-control" id="numTelefono" name="telf" placeholder="Ingrese el número de teléfono del alumno" required>
                            <span id="error-numTelefono" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Mail:</label>
                            <input type="text" class="form-control" id="mail" name="email" placeholder="Ingrese el mail del alumno" required>
                            <span id="error-mail" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="clase">Clase:</label>
                            <select name="clase" id="clase" class="form-select form-select-sm" aria-label=".form-select-sm example" required>
                                <option disabled selected>Seleccione Clase</option>
                                <?php
                                $query = "SELECT * FROM TB_CLASE";
                                $resultado = $mysqli->query($query);
                                $clases = $resultado->fetch_all(MYSQLI_ASSOC);
                                foreach ($clases as $clase) {
                                    echo "<option value='" . $clase["IdClase"] . "'>" . $clase["Nombreclase"] . "</option>";
                                }
                                ?>
                            </select>
                            <span id="error-clase" class="errorform"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario Nuevo Profesor -->
<div class="modal fade" id="formularioProfesor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alta profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="scrollable-modal-body">
                    <form action="../includes/altaProfesor.php" method="POST" onsubmit="return validarFormularioProfesor()">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombreprof" name="nombreProf" placeholder="Ingrese el nombre del profesor" required>
                            <span id="error-nombre-prof" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="apellidoprof" name="apellidoProf1" placeholder="Ingrese el apellido del profesor" required>
                            <span id="error-apellido1-prof" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido2" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="apellido2prof" name="apellidoProf2" placeholder="Ingrese el apellido del profesor" required>
                            <span id="error-apellido2-prof" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input type="text" class="form-control" id="dniprof" name="dniProf" placeholder="Ingrese el dni del profesor" required>
                            <span id="error-dni-prof" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="numTelefono" class="form-label">Número de teléfono:</label>
                            <input type="number" class="form-control" id="numTelefonoprof" name="telfProf" placeholder="Ingrese el número de teléfono del profesor" required>
                            <span id="error-telf-prof" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido2" class="form-label">Mail:</label>
                            <input type="text" class="form-control" id="mailprof" name="emailProf" placeholder="Ingrese el mail del profesor" required>
                            <span id="error-mail-prof" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion">Departamento</label>
                            <select name="deptProf" id="idDepartamento" class="form-select from-select-sm" aria-label=".form-select-sm example" required>
                                <option disabled selected>Seleciona Clase</option>
                                <?php
                                $query = "SELECT * FROM TB_DEPARTAMENTO";
                                $resultado = $mysqli->query($query);
                                $departamento = $resultado->fetch_all(MYSQLI_ASSOC);
                                foreach ($departamento as $dept) {
                                    echo "<option value='" . $dept["IdDepartamento"] . "'>" . $dept["Nombredepartamento"] . "</option>";
                                }
                                ?>
                            </select>
                            <span id="error-clase-prof" class="errorform"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="enviar" class="btn btn-primary" onclick="showProfesoresTable()">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario Editar Alumno -->
<div class="modal fade" id="EditarformularioAlumno" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="scrollable-modal-body">
                    <form action="../includes/editarAlumno.php" method="POST" onsubmit="return validarEditarAlumno()">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="hidden" name="matriculaAlu" id="matriculaAlu" value="">
                            <input type="text" class="form-control" id="nombreAlu" name="nombreAlu" value="" required>
                            <span id="error-nombre-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" id="apellidoAlu" name="apellidoAlu" value="" required>
                            <span id="error-apellido-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido2" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" id="apellidoAlu2" name="apellidoAlu2" value="" required>
                            <span id="error-apellido2-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input type="text" class="form-control" id="dniAlu" name="dniAlu" value="" required>
                            <span id="error-dni-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="edad" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="edadAlu" name="edadAlu" max="<?php echo date('Y-m-d', strtotime('-1 years')); ?>" value="" required>
                            <span id="error-edad-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección:</label>
                            <input type="text" class="form-control" id="direccionAlu" name="direccionAlu" value="" required>
                            <span id="error-direccion-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="numTelefono" class="form-label">Número de teléfono:</label>
                            <input type="number" class="form-control" id="telfAlu" name="telfAlu" value="" required>
                            <span id="error-telf-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="mail" class="form-label">Mail:</label>
                            <input type="text" class="form-control" id="emailAlu" name="emailAlu" value="" required>
                            <span id="error-mail-alu" class="errorform"></span>
                        </div>
                        <div class="mb-3">
                            <label for="clase" class="form-label">Clase:</label>
                            <select name="claseAlu" id="claseAlu" class="form-select from-select-sm" aria-label=".form-select-sm example" value="" required>
                                <option disabled selected>Selecciona una Clase</option>
                                <?php
                                $query = "SELECT * FROM TB_CLASE";
                                $resultado = $mysqli->query($query);
                                $clases = $resultado->fetch_all(MYSQLI_ASSOC);
                                foreach ($clases as $clase) {
                                    $selected = ($clase["IdClase"] == $row['IdClase']) ? "selected" : "";
                                    echo "<option value='" . $clase["IdClase"] . "' " . $selected . ">" . $clase["Nombreclase"] . "</option>";
                                }
                                ?>
                            </select>
                            <span id="error-clase-alu" class="errorform"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Formulario Editar Profesor -->
<div class="modal fade" id="editarProfesor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="scrollable-modal-body">
                    <form action="../includes/editarProfesor.php" method="POST" onsubmit="return validarEditarProfesor()">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="hidden" name="idProf" id="idProf" value="" required>
                            <input type="text" class="form-control" name="nombreProf" id="nombreProf" value="" required>
                            <span id="error-nombreProf-Editar" class="error-msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Primer Apellido:</label>
                            <input type="text" class="form-control" name="apellidoProf" id="apellidoProf" required>
                            <span id="error-apellidoProf" class="error-msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido2" class="form-label">Segundo Apellido:</label>
                            <input type="text" class="form-control" name="apellidoProf2" id="apellidoProf2" required>
                            <span id="error-apellidoProf2-Editar" class="error-msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI:</label>
                            <input type="text" class="form-control" name="dniProf" id="dniProf" required>
                            <span id="error-dniProf-Editar" class="error-msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="numTelefono" class="form-label">Número de teléfono:</label>
                            <input type="number" class="form-control" name="telfProf" id="telfProf" required>
                            <span id="error-telfProf-Editar" class="error-msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="apellido2" class="form-label">Mail:</label>
                            <input type="text" class="form-control" name="emailProf" id="emailProf" required>
                            <span id="error-emailProf-Editar" class="error-msg"></span>
                        </div>
                        <div class="mb-3">
                            <label for="descripcion">Departamento</label>
                            <select name="deptProfe" id="deptProfe" class="form-select from-select-sm" aria-label=".form-select-sm example" required>
                                <option disabled selected>Selecciona Clase</option>
                                <?php
                                $query = "SELECT * FROM TB_DEPARTAMENTO";
                                $resultado = $mysqli->query($query);
                                $departamento = $resultado->fetch_all(MYSQLI_ASSOC);
                                foreach ($departamento as $dept) {
                                    echo "<option value='" . $dept["IdDepartamento"] . "'>" . $dept["Nombredepartamento"] . "</option>";
                                }
                                ?>
                            </select>
                            <span id="error-deptProfe-Editar" class="error-msg"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" name="enviar" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../js/main.js"></script>
</body>
</html>