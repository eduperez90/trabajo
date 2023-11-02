<?php
include 'conexion.php';
$c = conectar();

$email = $_POST['email'];
$fecha = $_POST['fecha'];
$opcion = $_POST['opcion'];
$cantidad = $_POST['cantidad'];

$total = 0;
for ($i = 0; $i < count($cantidad); $i++) {
    if (isset($cantidad[$i]) && $cantidad[$i] > 0) {
        $id_menu = $i + 1;
        $subtotal = $cantidad[$i] * obtenerPrecioMenu($id_menu);
        $total += $subtotal;
    }
}

if ($total > 0) {
    $query_pedidos = "INSERT INTO pedidos (email, fecha, total, p_online) VALUES ('$email', '$fecha', $total, $opcion)";
    mysqli_query($c, $query_pedidos);
    $id_pedido = mysqli_insert_id($c);

    for ($i = 0; $i < count($cantidad); $i++) {
        if (isset($cantidad[$i]) && $cantidad[$i] > 0) {
            $id_menu = $i + 1; // Suponiendo que los IDs de menú comienzan desde 1
            $subtotal = $cantidad[$i] * obtenerPrecioMenu($id_menu); // Obtener el precio del menú según el ID
            $query_detalles = "INSERT INTO detalles (id_pedido, id_menu, cantidad, subtotal) VALUES ($id_pedido, $id_menu, $cantidad[$i], $subtotal)";
            mysqli_query($c, $query_detalles);
        }
    }

    echo "<script>alert('Pedido realizado');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
    exit();
}

function obtenerPrecioMenu($id_menu) {
    global $c;
    $query = "SELECT precio FROM menu WHERE id_menu = $id_menu";
    $resultado = mysqli_query($c, $query);
    $fila = mysqli_fetch_assoc($resultado);
    return $fila['precio'];
}

mysqli_close($c);
?>