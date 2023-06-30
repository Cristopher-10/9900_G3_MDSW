<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "listado";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtención del ID del cliente a eliminar
$clientID = $_POST["id"];

// Eliminación del cliente de la base de datos
$sql = "DELETE FROM clientes WHERE id = '$clientID'";

if ($conn->query($sql) === TRUE) {
    echo "success";
} else {
    echo "Error al eliminar el cliente de la base de datos: " . $conn->error;
}

$conn->close();
?>
