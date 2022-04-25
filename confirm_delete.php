<?php

$direccionIP='127.0.0.1';
$usuario='usuario';
$pass='Alumno1@';
$nombre_bd='biblioteca';

// Conectarse y seleccionar una base de datos de MySQL
$conexion = new mysqli($direccionIP, $usuario, $pass, $nombre_bd);

// Si la conexión falla obtenemos un error 'connect_errno', debemos mostrar un mensaje de error
if ($conexion->connect_errno) {
    echo "Lo siento, la página que buscas no puede mostrar la información en este momento.2";
    exit;
}

// Si la conexion se ha establecido correctamente podemos comenzar a trabajar
// vamos a lanzar una consulta SELECT
$sql = "DELETE FROM libros WHERE libroID=".$_GET['libroID'];
$resultado=$conexion->query($sql);
if (!$resultado) {
    echo "Lo siento, la página que buscas no puede mostrar la información en este momento.";
    exit;
}


// La consulta MySQL se ha realizado correctamente
// Compruebo si hay resultados
if ($resultado->num_rows === 0) {
    // No hay ningun resultado que conincida con los filtros aplicados en el SELECT
    echo "No se ha encontrado ningún resultado";
}else{
    echo "<h1>LIBRO CON ID=".$_GET['libroID']." ELIMINADO</h1>";
    echo $resultado->affected_rows." filas afectadas";
    echo "<button><a href='listado.php'>Volver</a></button>";
}


// El script automáticamente liberará el resultado y cerrará la conexión
// a MySQL cuando finalice, aunque aquí lo vamos a hacer nostros mismos
$resultado->free();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>