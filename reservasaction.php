<?php
include 'conexion.php'; // Incluye el archivo de conexión

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los valores del formulario
    $fecha = $_POST['fecha'];
    $numeroPersonas = $_POST['numeroPersonas'];
    $email = $_POST['email'];

    // Realiza la conexión a la base de datos
    $conexion = conectar();

    // Prepara la consulta SQL para insertar la reserva
    $consulta = "INSERT INTO reservas (email, fecha, numero_personas) VALUES ('$email', '$fecha', $numeroPersonas)";

    // Ejecuta la consulta
    if (mysqli_query($conexion, $consulta)) {
        mysqli_close($conexion);
        echo "<script>alert('Reserva confirmada');</script>"; // Muestra un mensaje de alerta
        echo "<script>window.location.href = 'index.php';</script>"; // Redirige a la página index.php
        exit();
    } else {
        echo "Error al realizar la reserva: " . mysqli_error($conexion);
    }

    // Cierra la conexión a la base de datos
    mysqli_close($conexion);
}
?>