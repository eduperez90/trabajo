<?php
// Incluir el archivo de conexión
require_once 'conexion.php';

// Obtener los valores del formulario
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tlf = $_POST['tlf'];
$email = $_POST['email'];

// Realizar la inserción en la tabla clientes
$query = "INSERT INTO clientes (nombre, telefono, email, pass) VALUES ('$nombre', '$tlf', '$email', '$pass')";

// Conectar a la base de datos
$conexion = conectar();

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $query);

// Verificar si la inserción fue exitosa
if ($resultado) {
    mysqli_close($conexion);
    //header("Location: index.php");
    echo "<script>alert('Usuario Creado Correctamente');</script>"; // Muestra un mensaje de alerta
    echo "<script>window.location.href = 'index.php';</script>"; // Redirige a la página index.php
    exit();
    exit();
} else {
    echo "Error al insertar el registro en la tabla clientes: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>