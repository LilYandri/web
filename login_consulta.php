<?php
// Iniciar sesión
session_start();

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "php_formulario");

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Obtener los valores del formulario
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $password = $conn->real_escape_string($_POST['password']);

    // Consultar la base de datos para verificar el usuario
    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$password'";
    $result = $conn->query($sql);

    // Comprobar si el usuario existe
    if ($result->num_rows > 0) {
        // Guardar el nombre del usuario en la sesión
        $_SESSION['usuario'] = $usuario;

        // Redirigir a la página de inicio
        header("Location: index.php");
        exit();
    } else {
        // Redirigir de nuevo a login.php con un mensaje de error
        $error = "Usuario o contraseña incorrectos";
        header("Location: login.php?error=" . urlencode($error));
        exit();
    }

    // Cerrar la conexión
    $conn->close();
} else {
    // Si alguien intenta acceder directamente a login_consulta.php, redirigir al login
    header("Location: login.php");
    exit();
}
