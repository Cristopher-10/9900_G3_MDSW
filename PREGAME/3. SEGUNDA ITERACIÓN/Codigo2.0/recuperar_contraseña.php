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
$usuario = $_POST["usuario"];
$codigo = $_POST["codigo"];
$nuevaContraseña = $_POST["nueva-contraseña"];

// Verificar si el código de seguridad existe en la tabla "codigos_seguridad"
$sql = "SELECT * FROM codigos_seguridad WHERE codigo = '$codigo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $codigo_id = $row["codigo"];

    // Verificar si el usuario existe en la tabla "usuarios"
    $sqlUsuario = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultUsuario = $conn->query($sqlUsuario);

    if ($resultUsuario->num_rows > 0) {
        // El usuario y el código de seguridad son válidos, actualizar la contraseña
        $rowUsuario = $resultUsuario->fetch_assoc();
        $usuario_id = $rowUsuario["id"];

        $sqlUpdate = "UPDATE usuarios SET contraseña = '$nuevaContraseña' WHERE id = $usuario_id";
        if ($conn->query($sqlUpdate) === TRUE) {
            // Contraseña actualizada exitosamente, mostrar mensaje en una ventana y redirigir a la página Principal.html
            echo "<script>alert('Se ha cambiado la contraseña correctamente.'); window.location.href='Principal.html';</script>";
            exit;
        } else {
            echo "<script>alert('Error al actualizar la contraseña: " . $conn->error . "'); window.location.href='recuperar_contraseña.html';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Usuario inválido. Inténtalo nuevamente.'); window.location.href='recuperar_contraseña.html';</script>";
        exit;
    }
} else {
    echo "<script>alert('Código de seguridad inválido. Inténtalo nuevamente.'); window.location.href='recuperar_contraseña.html';</script>";
    exit;
}

$conn->close();
?>
