<?php
// Configuración de la conexión a la base de datos
$host = 'localhost'; // Cambia esto por el nombre del host de tu base de datos
$usuario = 'id21091114_irter'; // Cambia esto por el nombre de usuario de tu base de datos
$contraseña = 'Irter78944.'; // Cambia esto por la contraseña de tu base de datos
$base_de_datos = 'id21091114_3';

$conexion = mysqli_connect($host, $usuario, $contraseña, $base_de_datos);
// Verificar la conexión
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Consultar los datos de la tabla "reservas" y ordenar por fecha, mes y hora
$sql = "SELECT * FROM reservas ORDER BY dia, mes, hora";
$resultado = mysqli_query($conexion, $sql);

// Crear un arreglo para almacenar los datos de los clientes
$clientes = array();

// Generar el contenido de la tabla HTML con los datos de las reservas
if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $cliente = array(
            'nombre' => $row['nombre'],
            'apellido' => $row['apellido'],
            'telefono' => $row['telefono'],
            'direccion' => $row['direccion'],
            'email' => $row['email'],
            'dia' => $row['dia'],
            'mes' => $row['mes'], // Nueva columna "mes"
            'hora' => $row['hora'],
            'id' => $row['id']
        );
        $clientes[] = $cliente;
    }
}

// Cerrar la conexión
mysqli_close($conexion);

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($clientes);
?>