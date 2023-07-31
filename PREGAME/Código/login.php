<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "id21091114_irter";
$password = "Irter78944.";
$dbname = "id21091114_3";

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
    
    // Obtener los datos del usuario desde la consulta
    $usuario_data = $result->fetch_assoc();
    if ($usuario_data['usuario'] == 'AbigailC') { // Cambiar 'nombre_usuario_super' por el nombre de usuario del superusuario
        // Cambiar el valor de superusuario a 1 para el usuario superusuario
        $update_sql = "UPDATE usuarios SET superusuario = 1 WHERE usuario = 'nombre_usuario_super'";
        $conn->query($update_sql);
        header("Location: Sformulario.html"); // Redirecciona a la página para superusuarios
    } else {
        header("Location: formulario.html"); // Redirecciona a la página para usuarios normales
    }
    exit;
} else {
    // Inicio de sesión fallido
    echo "<script>
              alert('Usuario o contraseña incorrectos. Inténtalo nuevamente.');
              window.location.href = 'index.html';
              document.getElementById('contraseña').value = '';
          </script>";
}

$conn->close();
?>
