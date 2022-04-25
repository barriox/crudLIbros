<?php

$direccionIP='127.0.0.1';
$usuario='usuario';
$pass='Alumno1@';
$nombre_bd='biblioteca';

// Conectarse y seleccionar una base de datos de MySQL
$conexion = new mysqli($direccionIP, $usuario, $pass, $nombre_bd);

// Si la conexión falla obtenemos un error 'connect_errno', debemos mostrar un mensaje de error
if ($conexion->connect_errno) {
    echo "Lo siento, la página que buscas no puede mostrar la información en este momento.";
    exit;
}

// Si la conexion se ha establecido correctamente podemos comenzar a trabajar
// vamos a lanzar una consulta SELECT
$sql = "SELECT * FROM libros WHERE libroID=".$_GET['libroID'];
if (!$resultado = $conexion->query($sql)) {
     echo "Lo siento, la página que buscas no puede mostrar la información en este momento.";
    exit;
}

// La consulta MySQL se ha realizado correctamente
// Compruebo si hay resultados
if ($resultado->num_rows === 0) {
    // No hay ningun resultado que conincida con los filtros aplicados en el SELECT
    echo "No se ha encontrado ningún resultado";
}else{
	//hay uno o mas resultados
	echo "<ul>\n";
	//voy a ir recorriendo los resultados y mostrandolos por pantalla
    $libro = $resultado->fetch_assoc();
    echo "<h1>ELIMINAR</h1>";
    echo "<h2>¿Está seguro de que desea eliminar el libro seleccionado con la siguiente información?</h2>";
    echo "El libro que has seleccionado es: ".$libro['titulo']."<br><br>";
    echo "<button><a href='listado.php'>Cancelar</a></button><button><a href='confirm_delete.php?libroID=".$libro['libroID']."'>Confirmar borrado</a></button>";
		
echo "</ul>\n";
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