<?php
$mysql_server = "localhost";
$mysql_login = "edu_php";
$mysql_pass = "Bender,01";
$base = "edu_proyecto";

function conectar(){
    global $mysql_server, $mysql_login, $mysql_pass, $base;
    $c = mysqli_connect($mysql_server, $mysql_login, $mysql_pass) or die ("Imposible conectar");
    mysqli_select_db($c, $base) or die ("Imposible seleccionar la base de datos");
}
?>