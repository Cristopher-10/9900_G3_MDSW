<?php
// Configuración de la conexión a la base de datos (misma que en tu código original)
$host = 'localhost'; // Cambia esto por el nombre del host de tu base de datos
$usuario = 'id21091114_irter'; // Cambia esto por el nombre de usuario de tu base de datos
$contraseña = 'Irter78944.'; // Cambia esto por la contraseña de tu base de datos
$base_de_datos = 'id21091114_3';
$conexion = mysqli_connect($host, $usuario, $contraseña, $base_de_datos);

// Verificar la conexión
if (!$conexion) {
    die('Error de conexión: ' . mysqli_connect_error());
}

// Consultar los datos de la tabla "usuarios" con superusuario = 0
$sql = "SELECT usuario, contraseña, id FROM usuarios WHERE superusuario = 0";
$resultado = mysqli_query($conexion, $sql);

// Crear un arreglo para almacenar los datos de los usuarios
$usuarios = array();

// Generar el contenido de la tabla HTML con los datos de los usuarios
if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $usuario = array(
            'usuario' => $row['usuario'],
            'contraseña' => $row['contraseña'],
            'id' => $row['id']
        );
        $usuarios[] = $usuario;
    }
}

// Cerrar la conexión
mysqli_close($conexion);

// Enviar la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($usuarios);
?>
