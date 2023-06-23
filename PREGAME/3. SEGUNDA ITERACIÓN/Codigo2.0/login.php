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

// Establecer la codificación de caracteres en la conexión
$conn->set_charset("utf8");

// Obtención de los datos enviados por el formulario
$usuario = $_POST["usuario"];
$contraseña = $_POST["contraseña"];

// Escapar caracteres especiales para evitar inyección de SQL
$usuario = $conn->real_escape_string($usuario);
$contraseña = $conn->real_escape_string($contraseña);

// Validación del usuario y contraseña en la base de datos
$sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Inicio de sesión exitoso
    header("Location: index.html"); // Redirecciona a la página index.html
    exit;
} else {
    // Inicio de sesión fallido
    echo "<script>
              alert('Usuario o contraseña incorrectos. Inténtalo nuevamente.');
              window.location.href = 'Principal.html';
              document.getElementById('contraseña').value = '';
          </script>";
}

$conn->close();
?>
