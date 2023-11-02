<?php
include 'conexion.php';
$c = conectar();
// Obtener los datos del formulario
$usuario = $_POST['usuario'];
$pass = $_POST['pass'];
// Consulta SQL para verificar el usuario y contraseña en la tabla empleados
$sql_empleados = "SELECT * FROM empleados WHERE email = '$usuario' AND pass = '$pass'";
$result_empleados = mysqli_query($c, $sql_empleados);
// Consulta SQL para verificar el usuario y contraseña en la tabla clientes
$sql_clientes = "SELECT * FROM clientes WHERE email = '$usuario' AND pass = '$pass'";
$result_clientes = mysqli_query($c, $sql_clientes);

if (mysqli_num_rows($result_empleados) > 0) {
    // El usuario y contraseña pertenecen a un empleado
    session_start();
    $_SESSION['correo'] = $usuario;
    mysqli_close($c);
    header("Location: indexempleado.php"); // Redireccionar a indexempleado.php
    exit(); // Terminar el script después de la redirección
} elseif (mysqli_num_rows($result_clientes) > 0) {
    // El usuario y contraseña pertenecen a un cliente
    session_start();
    $_SESSION['correo'] = $usuario;
    mysqli_close($c);
    header("Location: index.php"); // Redireccionar a index.php
    exit(); // Terminar el script después de la redirección
} else {
    // El usuario y/o contraseña son incorrectos
    mysqli_close($c);
    echo "Usuario y/o contraseña incorrectos";
}
?>