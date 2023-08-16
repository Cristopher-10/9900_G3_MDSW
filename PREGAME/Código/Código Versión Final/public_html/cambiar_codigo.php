<?php
// Datos de conexión a la base de datos
$host = 'localhost'; // Cambia esto por el nombre del host de tu base de datos
$usuario = 'id21091114_irter'; // Cambia esto por el nombre de usuario de tu base de datos
$contraseña = 'Irter78944.'; // Cambia esto por la contraseña de tu base de datos
$base_de_datos = 'id21091114_3';

// Establecer la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos);

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die(json_encode(array('status' => 'error', 'message' => 'Error al conectar con la base de datos')));
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el nuevo código de seguridad desde el formulario
    $nuevoCodigo = $_POST["codigo"];

    // Validar el nuevo código si es necesario

    // Consulta preparada para actualizar el código de seguridad en la tabla
    $consulta = $conexion->prepare("UPDATE codigos_seguridad SET codigo = ? WHERE id = 1"); // Cambia '1' por el ID correcto
    $consulta->bind_param("s", $nuevoCodigo); // "s" indica que es una cadena (string)
    
    // Ejecutar la consulta
    if ($consulta->execute()) {
        // Código actualizado correctamente
        echo json_encode(array('status' => 'success'));
    } else {
        // Error al actualizar el código
        echo json_encode(array('status' => 'error', 'message' => 'Error al actualizar el código de seguridad'));
    }

    // Cerrar la consulta
    $consulta->close();
}

// Cerrar la conexión cuando hayas terminado de trabajar con la base de datos
$conexion->close();
?>
