<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Si has configurado una contraseña para MySQL en XAMPP, colócala aquí

// Nombre de la base de datos
$dbname = "clientes_db";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Obtener los datos del formulario
$nombre = $_POST["name"];
$direccion = $_POST["address"];
$telefono = $_POST["phone"];
$descripcion = $_POST["description"];

// Insertar los datos en la base de datos
$sql = "INSERT INTO clientes (nombre, direccion, telefono, descripcion)
        VALUES ('$nombre', '$direccion', '$telefono', '$descripcion')";

if ($conn->query($sql) === TRUE) {
    echo "Cliente registrado exitosamente.";
} else {
    echo "Error al registrar el cliente: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
