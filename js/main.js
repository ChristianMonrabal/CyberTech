/* Validar formulario Alta Alumnos: */

function validarFormularioAlumno() {
    // Obtener los valores de los campos del formulario
    var nombreAlumno = document.getElementById("nombre");
    var apellido1Alumno = document.getElementById("apellido");
    var apellido2Alumno = document.getElementById("apellido2");
    var dniAlumno = document.getElementById("dni");
    var telfAlumno = document.getElementById("numTelefono");
    var emailAlumno = document.getElementById("mail");
    var claseAlumno = document.getElementById("clase");

    var errorNombreAlumno = document.getElementById("error-nombre");
    var errorApellido1Alumno = document.getElementById("error-apellido");
    var errorApellido2Alumno = document.getElementById("error-apellido2");
    var errorDniAlumno = document.getElementById("error-dni");
    var errorDniAlumno = document.getElementById("error-nacimiento");
    var errorDniAlumno = document.getElementById("error-direccion");
    var errorTelfAlumno = document.getElementById("error-numTelefono");
    var errorEmailAlumno = document.getElementById("error-mail");
    var errorClaseAlumno = document.getElementById("error-clase");

    // Limpiar mensajes de error en caso de rellenar un input
    errorNombreAlumno.textContent = "";
    errorApellido1Alumno.textContent = "";
    errorApellido2Alumno.textContent = "";
    errorDniAlumno.textContent = "";
    errorTelfAlumno.textContent = "";
    errorEmailAlumno.textContent = "";
    errorClaseAlumno.textContent = "";

    // Verificar que los campos obligatorios estén completos
    var validoAlumno = true;

    if (nombreAlumno.value.trim() === "") {
        errorNombreAlumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    if (apellido1Alumno.value.trim() === "") {
        errorApellido1Alumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    if (apellido2Alumno.value.trim() === "") {
        errorApellido2Alumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    if (dniAlumno.value.trim() === "") {
        errorDniAlumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    if (telfAlumno.value.trim() === "") {
        errorTelfAlumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    if (emailAlumno.value.trim() === "") {
        errorEmailAlumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    if (claseAlumno.value === null || claseAlumno.value === "") {
        errorClaseAlumno.textContent = "Por favor, complete este campo.";
        validoAlumno = false;
    }

    return validoAlumno;
    }


/* Validar formularios Alta Profesores: */

function validarFormularioProfesor() {
    // Obtener los valores de los campos del formulario
    var nombreProf = document.getElementById("nombreprof");
    var apellido1Prof = document.getElementById("apellidoprof");
    var apellido2Prof = document.getElementById("apellido2prof");
    var dniProf = document.getElementById("dniprof");
    var telfProf = document.getElementById("numTelefonoprof");
    var emailProf = document.getElementById("mailprof");
    var claseProf = document.getElementById("idDepartamento");

    // Obtener los elementos para mostrar mensajes de error
    var errorNombreProf = document.getElementById("error-nombre-prof");
    var errorApellido1Prof = document.getElementById("error-apellido1-prof");
    var errorApellido2Prof = document.getElementById("error-apellido2-prof");
    var errorDniProf = document.getElementById("error-dni-prof");
    var errorTelfProf = document.getElementById("error-telf-prof");
    var errorEmailProf = document.getElementById("error-mail-prof");
    var errorClaseProf = document.getElementById("error-clase-prof");

    // Limpiar mensajes de error anteriores
    errorNombreProf.textContent = "";
    errorApellido1Prof.textContent = "";
    errorApellido2Prof.textContent = "";
    errorDniProf.textContent = "";
    errorTelfProf.textContent = "";
    errorEmailProf.textContent = "";
    errorClaseProf.textContent = "";

    // Verificar que los campos obligatorios estén completos
    var validoProf = true;

    if (nombreProf.value.trim() === "") {
        errorNombreProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (apellido1Prof.value.trim() === "") {
        errorApellido1Prof.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (apellido2Prof.value.trim() === "") {
        errorApellido2Prof.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (dniProf.value.trim() === "") {
        errorDniProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (telfProf.value.trim() === "") {
        errorTelfProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (emailProf.value.trim() === "") {
        errorEmailProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (claseProf.value === null || claseProf.value === "") {
        errorClaseProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    return validoProf;
    }


/* Validar formulario Editar Alumno */

function validarEditarAlumno() {
    // Obtener los valores de los campos del formulario
    var nombreAlu = document.getElementById("nombreAlu");
    var apellidoAlu = document.getElementById("apellidoAlu");
    var apellidoAlu2 = document.getElementById("apellidoAlu2");
    var dniAlu = document.getElementById("dniAlu");
    var edadAlu = document.getElementById("edadAlu");
    var direccionAlu = document.getElementById("direccionAlu");
    var telfAlu = document.getElementById("telfAlu");
    var emailAlu = document.getElementById("emailAlu");
    var claseAlu = document.getElementById("claseAlu");

    // Obtener los elementos para mostrar mensajes de error
    var errorNombreAlu = document.getElementById("error-nombre-alu");
    var errorApellidoAlu = document.getElementById("error-apellido-alu");
    var errorApellido2Alu = document.getElementById("error-apellido2-alu");
    var errorDniAlu = document.getElementById("error-dni-alu");
    var errorEdadAlu = document.getElementById("error-edad-alu");
    var errorDireccionAlu = document.getElementById("error-direccion-alu");
    var errorTelfAlu = document.getElementById("error-telf-alu");
    var errorEmailAlu = document.getElementById("error-mail-alu");
    var errorClaseAlu = document.getElementById("error-clase-alu");

    // Limpiar mensajes de error anteriores
    errorNombreAlu.textContent = "";
    errorApellidoAlu.textContent = "";
    errorApellido2Alu.textContent = "";
    errorDniAlu.textContent = "";
    errorEdadAlu.textContent = "";
    errorDireccionAlu.textContent = "";
    errorTelfAlu.textContent = "";
    errorEmailAlu.textContent = "";
    errorClaseAlu.textContent = "";

    // Verificar que los campos obligatorios estén completos
    var validoAlu = true;

    if (nombreAlu.value.trim() === "") {
        errorNombreAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (apellidoAlu.value.trim() === "") {
        errorApellidoAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (apellidoAlu2.value.trim() === "") {
        errorApellido2Alu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (dniAlu.value.trim() === "") {
        errorDniAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (edadAlu.value.trim() === "") {
        errorEdadAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (direccionAlu.value.trim() === "") {
        errorDireccionAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (telfAlu.value.trim() === "") {
        errorTelfAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (emailAlu.value.trim() === "") {
        errorEmailAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    if (claseAlu.value === null || claseAlu.value === "") {
        errorClaseAlu.textContent = "Por favor, complete este campo.";
        validoAlu = false;
    }

    return validoAlu;
}

function validarEditarProfesor() {
    // Obtener los valores de los campos del formulario
    var nombreProf = document.getElementById("nombreProf");
    var apellidoProf = document.getElementById("apellidoProf");
    var apellidoProf2 = document.getElementById("apellidoProf2");
    var dniProf = document.getElementById("dniProf");
    var telfProf = document.getElementById("telfProf");
    var emailProf = document.getElementById("emailProf");
    var deptProfe = document.getElementById("deptProfe");

    // Obtener los elementos para mostrar mensajes de error
    var errorNombreProf = document.getElementById("error-nombreProf-Editar");
    var errorApellidoProf = document.getElementById("error-apellidoProf");
    var errorApellidoProf2 = document.getElementById("error-apellidoProf2-Editar");
    var errorDniProf = document.getElementById("error-dniProf-Editar");
    var errorTelfProf = document.getElementById("error-telfProf-Editar");
    var errorEmailProf = document.getElementById("error-emailProf-Editar");
    var errorDeptProfe = document.getElementById("error-deptProfe-Editar");

    // Limpiar mensajes de error anteriores
    errorNombreProf.textContent = "";
    errorApellidoProf.textContent = "";
    errorApellidoProf2.textContent = "";
    errorDniProf.textContent = "";
    errorTelfProf.textContent = "";
    errorEmailProf.textContent = "";
    errorDeptProfe.textContent = "";

    // Verificar que los campos obligatorios estén completos
    var validoProf = true;

    if (nombreProf.value.trim() === "") {
        errorNombreProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (apellidoProf.value.trim() === "") {
        errorApellidoProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (apellidoProf2.value.trim() === "") {
        errorApellidoProf2.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (dniProf.value.trim() === "") {
        errorDniProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (telfProf.value.trim() === "") {
        errorTelfProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (emailProf.value.trim() === "") {
        errorEmailProf.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    if (deptProfe.value === null || deptProfe.value === "") {
        errorDeptProfe.textContent = "Por favor, complete este campo.";
        validoProf = false;
    }

    return validoProf;
}



    /* Ocultar tablas */
    function showAlumnosTable() {
        document.getElementById("tablaAlumnos").style.display = "table";
        document.getElementById("tablaProfesores").style.display = "none";
    }

    function showProfesoresTable() {
        document.getElementById("tablaAlumnos").style.display = "none";
        document.getElementById("tablaProfesores").style.display = "table";
    }

    function mostrarTablaPorDefecto() {
        window.location.href = '../views/view1.php?orderBy=matricula_desc';
    }

    /* Editar los formularios*/
    
    /* Recoge la variable alu y su valor*/
    function getDataAlu(alu){
        document.getElementById("matriculaAlu").value = document.getElementById('alu_matricula_' + alu).innerText;
        document.getElementById("nombreAlu").value = document.getElementById('alu_nombre_' + alu).innerText;
        document.getElementById("apellidoAlu").value = document.getElementById('alu_apellido_' + alu).innerText;
        document.getElementById("apellidoAlu2").value = document.getElementById('alu_apellido2_' + alu).innerText;
        document.getElementById("edadAlu").value = document.getElementById('alu_edad_' + alu).innerText;
        document.getElementById("direccionAlu").value = document.getElementById('alu_direccion_' + alu).innerText;
        document.getElementById("telfAlu").value = document.getElementById('alu_telefono_' + alu).innerText;
        document.getElementById("dniAlu").value = document.getElementById('alu_dni_' + alu).innerText;
        document.getElementById("emailAlu").value = document.getElementById('alu_email_' + alu).innerText;
        document.getElementById("claseAlu").value = document.getElementById('alu_clase_' + alu).innerText;
    }

    /* Recoge la variable prof y su valor*/
    function getDataProf(prof){
        document.getElementById("idProf").value = document.getElementById('prof_id_' + prof).innerText;
        document.getElementById("nombreProf").value = document.getElementById('prof_nombre_' + prof).innerText;
        document.getElementById("apellidoProf").value = document.getElementById('prof_apellido_' + prof).innerText;
        document.getElementById("apellidoProf2").value = document.getElementById('prof_apellido2_' + prof).innerText;
        document.getElementById("emailProf").value = document.getElementById('prof_email_' + prof).innerText;
        document.getElementById("dniProf").value = document.getElementById('prof_dni_' + prof).innerText;
        document.getElementById("telfProf").value = document.getElementById('prof_telf_' + prof).innerText;
        document.getElementById("deptProfe").value = document.getElementById('prof_dept_' + prof).innerText;
    }
    





