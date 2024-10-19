<?php
$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$correo = $_POST["correo"];

include "conexion.php";

// Verificar si la cédula ya existe en la base de datos
$sql_verificar = "SELECT * FROM datos WHERE cedula = '$cedula'";
$resultado_verificar = $conn->query($sql_verificar);

if ($resultado_verificar->num_rows > 0) {
    // Si ya existe, redirigir con un mensaje de error
    header('Location: ./index.php?error=duplicate');
} else {
    // Si no existe, proceder a insertar el nuevo registro
    $sql = "INSERT INTO datos (cedula, nombre, edad, correo)
            VALUES ('$cedula', '$nombre', '$edad', '$correo')";
    
    if ($conn->query($sql) === TRUE) {
        header('Location: ./index.php?success=true');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
