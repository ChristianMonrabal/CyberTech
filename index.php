<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("Location: ./views/view1.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = "admin";
    $password = "qweQWE123";

    // Comprobar si las credenciales son válidas
    if ($_POST["user"] === $username && $_POST["pwd"] === $password) {
        // Autenticación exitosa, establecer la sesión
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $_POST["user"];
        $_SESSION["password"] = $_POST["pwd"];
        header("Location: ./views/view1.php");
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}

// Obtener los valores ingresados por el usuario
$usernameValue = isset($_POST["user"]) ? $_POST["user"] : "";
$passwordValue = isset($_POST["pwd"]) ? $_POST["pwd"] : "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="shortcut icon" href="./sources/favicon.png" type="image/x-icon">
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <form name="loginForm" method="POST">
            <div class="user-box">
                <input type="text" name="user" value="<?php echo $usernameValue; ?>" required>
                <label>Usuario</label>
            </div>
            <div class="user-box">
                <input type="password" name="pwd" value="<?php echo $passwordValue; ?>" required>
                <label>Contraseña</label>
            </div>
            <p class="error"><?php echo isset($error) ? $error : ""; ?></p>
            <a><button class="btn" type="submit">Acceder</button></a>
        </form>
    </div>
</body>
</html>