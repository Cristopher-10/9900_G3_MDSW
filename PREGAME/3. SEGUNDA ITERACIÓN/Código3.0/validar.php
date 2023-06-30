<?php
// Establecer la conexión con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "prueba1");

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

// Realizar la consulta en la base de datos
$query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
$resultado = mysqli_query($conexion, $query);

// Verificar si se encontraron registros
if (mysqli_num_rows($resultado) > 0) {
    // Si la validación es exitosa, redirecciona a la página en blanco
    header("Location: Listado.html");
} else {
    // Si la validación falla, muestra un mensaje de error
    echo "Usuario o contraseña incorrectos. Inténtalo nuevamente.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>
