<?php
    //local
    $_servername = "localhost"; //servidor
    $username = "root"; //usuario
    $password = ""; //contraseña
    $bdname = "php_formulario"; // nombre de la base de datos

    $conn = new mysqli(hostname:$_servername,username:$username,password:$password, database:$bdname);
    //check connection

    if($conn->connect_error){
        die("Connection failed: ". $conn->connect_error);
    }
?>
<?php
// Iniciar sesión solo si no está ya activa
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

