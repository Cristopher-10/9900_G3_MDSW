<?php
// Configuración de la conexión a la base de datos (misma que en tu código original)
$host = 'localhost'; // Cambia esto por el nombre del host de tu base de datos
$usuario = 'id21091114_irter'; // Cambia esto por el nombre de usuario de tu base de datos
$contraseña = 'Irter78944.'; // Cambia esto por la contraseña de tu base de datos
$base_de_datos = 'id21091114_3';
$conexion = mysqli_connect($host, $usuario, $contraseña, $base_de_datos);

// Verificar si se recibió el ID del usuario a eliminar
if (isset($_POST['id'])) {
    $idUsuario = $_POST['id'];

    // Eliminar el usuario de la base de datos
    $sql = "DELETE FROM usuarios WHERE id = $idUsuario AND superusuario = 0";
    if (mysqli_query($conexion, $sql)) {
        echo "Usuario eliminado correctamente.";
    } else {
        echo "Error al eliminar el usuario: " . mysqli_error($conexion);
    }
} else {
    echo "ID de usuario no proporcionado.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
