<?php
// Configura los detalles de la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "listado";
// Crear la conexión
$conexion = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión se estableció correctamente
if (!$conexion) {
  die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obtener los datos del formulario
  $nuevoUsuario = $_POST['nuevo-usuario'];
  $nuevaContraseña = $_POST['nueva-contraseña'];

  // Insertar el nuevo usuario en la tabla de usuarios
  $query = "INSERT INTO usuarios (usuario,contraseña) VALUES ('$nuevoUsuario', '$nuevaContraseña')";

  if (mysqli_query($conexion, $query)) {
    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Redireccionar al usuario a la página de validación o mostrar un mensaje de éxito
    header("Location: Principal.html");
    exit();
  } else {
    echo "Error al registrar el usuario: " . mysqli_error($conexion);
  }
}
?>