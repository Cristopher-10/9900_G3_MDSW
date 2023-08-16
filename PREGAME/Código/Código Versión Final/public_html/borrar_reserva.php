<?php

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];


$servername = "localhost";
$username = "id21091114_irter";
$password = "Irter78944.";
$dbname = "id21091114_3";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay error en la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Consulta para borrar el registro
$sql = "DELETE FROM reservas WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo "Registro borrado exitosamente.";
} else {
    echo "Error al borrar el registro: " . $conn->error;
}

$conn->close();
} else {
echo "Error: No se proporcionó el ID a borrar.";
}
?>