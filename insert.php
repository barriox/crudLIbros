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

if(isset($_POST['submit'])){
    $titulo=$_POST['titu'];
    $estanteria=$_POST['estan'];
    $id=$_GET['libroID'];
    $sql = "INSERT INTO libros (titulo, estanteriaID) VALUES ('$titulo',$estanteria)";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        echo "Ha ocurrido un error en la inserción de datos";
    }else{
        echo "Libro insertado correctamente.";
        echo "<button><a href='listado.php'>Volver</a></button>";
    }
}


// El script automáticamente liberará el resultado y cerrará la conexión
// a MySQL cuando finalice, aunque aquí lo vamos a hacer nostros mismos
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
    <h1>INSERTAR LIBRO</h1>
    <p>Introduce los datos del libro:</p>
    <form action="" method="POST">
        <label>Titulo</label>
        <input type="text" name="titu">
        <label>Estanteria</label>
        <input type="text" name="estan">
        <button type="submit" name="submit">Insertar</button>
    </form>
    <button><a href="listado.php">Volver</a></button>
    
</body>
</html>