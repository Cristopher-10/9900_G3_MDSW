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

// Obtención de los datos enviados por el formulario
$name = $_POST["name"];
$address = $_POST["address"];
$phone = $_POST["phone"];
$description = $_POST["description"];

// Inserción del cliente en la base de datos
$sql = "INSERT INTO clientes (nombre, direccion, telefono, descripcion) VALUES ('$name', '$address', '$phone', '$description')";

if ($conn->query($sql) === TRUE) {
    // Obtención del ID del cliente insertado
    $clientID = $conn->insert_id;

    // Creación de un arreglo con los datos del cliente
    $clientData = array(
        "id" => $clientID,
        "name" => $name,
        "address" => $address,
        "phone" => $phone,
        "description" => $description
    );

    // Devolución de los datos del cliente en formato JSON
    echo json_encode($clientData);
} else {
    echo "Error al insertar el cliente en la base de datos: " . $conn->error;
}

$conn->close();
?>
