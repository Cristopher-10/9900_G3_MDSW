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

// Consulta para obtener los clientes registrados
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

$clientData = array();
if ($result->num_rows > 0) {
    // Recorrer los resultados y agregar los datos de los clientes al arreglo
    while ($row = $result->fetch_assoc()) {
        $clientData[] = array(
            "id" => $row["id"],
            "name" => $row["nombre"],
            "address" => $row["direccion"],
            "phone" => $row["telefono"],
            "description" => $row["descripcion"]
        );
    }
}

// Devolver los datos de los clientes en formato JSON
echo json_encode($clientData);

$conn->close();
?>
