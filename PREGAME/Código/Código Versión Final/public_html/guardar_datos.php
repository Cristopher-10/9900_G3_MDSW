<?php
// Obtener los valores del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$dia = $_POST['dia'];
$hora = $_POST['hora'];
$mes = $_POST['mes']; // Agregamos la variable del mes obtenida del formulario

$host = 'localhost'; // Cambia esto por el nombre del host de tu base de datos
$usuario = 'id21091114_irter'; // Cambia esto por el nombre de usuario de tu base de datos
$contraseña = 'Irter78944.'; // Cambia esto por la contraseña de tu base de datos
$base_de_datos = 'id21091114_3';

$conexion = mysqli_connect($host, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if (!$conexion) {
  die('Error de conexión: ' . mysqli_connect_error());
}

// Consulta para verificar si la hora y el día están ocupados
$consulta_disponibilidad = "SELECT COUNT(*) as cantidad FROM reservas WHERE dia = '$dia' AND hora = '$hora' AND mes = '$mes'";
$resultado_disponibilidad = mysqli_query($conexion, $consulta_disponibilidad);

if ($resultado_disponibilidad) {
  $fila = mysqli_fetch_assoc($resultado_disponibilidad);
  $cantidad_reservas = $fila['cantidad'];

  if ($cantidad_reservas > 0) {
    // Mostrar mensaje de error en una ventana emergente y redirigir al formulario
    echo '<script>alert("Lo sentimos, la hora seleccionada ya está ocupada. Por favor, elige otra hora.");</script>';
    echo '<script>window.location.href = "formulario.html";</script>';
    exit;
  }
}

// Preparar la consulta SQL para insertar los datos en la tabla
$consulta = "INSERT INTO reservas (nombre, apellido, telefono, direccion, email, dia, hora, mes)
             VALUES ('$nombre', '$apellido', '$telefono', '$direccion', '$email', '$dia', '$hora', '$mes')";

// Ejecutar la consulta
if (mysqli_query($conexion, $consulta)) {
  mysqli_close($conexion);
  header('Location: formulario.html');
} else {
  echo 'Error al guardar la reserva: ' . mysqli_error($conexion);
}

// Cerrar la conexión

?>
