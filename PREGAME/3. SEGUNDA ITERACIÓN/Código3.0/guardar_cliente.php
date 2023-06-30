<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prueba1";

// Obtener los datos del formulario
$name = $_POST['name'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$description = $_POST['description'];

// Crear una conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Preparar la consulta SQL para insertar los datos en la tabla de clientes
$sql = "INSERT INTO clientes (nombre, telefono, fecha, descripcion) VALUES ('$name', '$phone', '$date', '$description')";

if ($conn->query($sql) === TRUE) {
    // Redireccionar a la página de Listado.html
    header("Location: Listado.html");
    exit();
} else {
    echo "Error al registrar al cliente: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
