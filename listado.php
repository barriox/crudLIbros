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
$sql = "SELECT * FROM libros";
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
    $limite=$_GET['limite']?? 0;
    $i=0;
    $filas=$resultado->num_rows;
    $filas=round($filas/20);
    $sql2 = "SELECT * FROM libros LIMIT ".$limite."0, 20";
    if (!$resultado = $conexion->query($sql2)) {
        echo "Lo siento, la página que buscas no puede mostrar la información en este momento.";
    exit;
    }
	echo "<ul>\n";
	//voy a ir recorriendo los resultados y mostrandolos por pantalla
	while ($libro = $resultado->fetch_assoc()) {
		echo "<a href='select.php?libroID=".$libro['libroID']."'><li>".$libro['titulo']."<button><a href='update.php?libroID=".$libro['libroID']."'>Editar</a></button><button><a href='delete.php?libroID=".$libro['libroID']."'>Borrar</a></button></li></a>";
        echo "<li class='nodec'>&emsp;Estanteria->".$libro['estanteriaID']."</li>";
	}
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
    <button class="ins"><a href="insert.php">Insertar libro</a></button>
    <?php
    while($i<$filas){
        if($i==0){
            $i++;
            $limite=0;
        }else{
            $i++;
            switch($i){
                case 2:
                    $limite=2;
                    break;
                case 3:
                    $limite=4;
                    break;
                case 4:
                    $limite=6;
                    break;
                case 5:
                    $limite=8;
                    break;
            }
        }
        echo "<a class='pag' href='listado.php?limite=$limite'>$i</a>";
    }
    ?>
</body>
</html>