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
$codigoSeguridad = $_POST["codigo"];

// Verificar el código de seguridad en la base de datos
$sql = "SELECT codigo_seguridad FROM tabla_codigos WHERE codigo_seguridad = $codigoSeguridad";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // Insertar los datos en la base de datos
    $sqlInsert = "INSERT INTO clientes (nombre, direccion, telefono, descripcion)
                  VALUES ('$nombre', '$direccion', '$telefono', '$descripcion')";

    if ($conn->query($sqlInsert) === TRUE) {
        echo "Cliente registrado exitosamente.";
    } else {
        echo "Error al registrar el cliente: " . $conn->error;
    }
} else {
    echo "Código de seguridad inválido.";
}

// Cerrar la conexión
$conn->close();
?>
