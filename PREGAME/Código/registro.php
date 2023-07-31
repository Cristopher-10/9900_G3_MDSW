<?php
// Configura los detalles de la conexión a la base de datos
$servername = "localhost";
$username = "id21091114_irter";
$password = "Irter78944.";
$dbname = "id21091114_3";

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
  $codigoSeguridad = $_POST['codigo'];

  // Verificar el código de seguridad en la base de datos
  $queryCodigo = "SELECT codigo FROM codigos_seguridad WHERE codigo = '$codigoSeguridad'";
  $resultadoCodigo = mysqli_query($conexion, $queryCodigo);

  if (mysqli_num_rows($resultadoCodigo) == 1) {
    // Insertar el nuevo usuario en la tabla de usuarios
    $queryInsertarUsuario = "INSERT INTO usuarios (usuario, contraseña) VALUES ('$nuevoUsuario', '$nuevaContraseña')";

    if (mysqli_query($conexion, $queryInsertarUsuario)) {
      // Cerrar la conexión a la base de datos
      mysqli_close($conexion);

      // Mostrar ventana emergente de confirmación
      echo "<script>alert('Usuario creado correctamente.'); window.location.href = 'index.html';</script>";
      exit();
    } else {
      echo "Error al registrar el usuario: " . mysqli_error($conexion);
    }
  } else {
    // Mostrar ventana emergente de error
    echo "<script>alert('Código de seguridad incorrecto.'); window.location.href = 'Registro.html';</script>";
    exit();
  }
}
?>
