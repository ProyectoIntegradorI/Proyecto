<?php
$servername = "localhost";
$username = "root";
$password = "aaronCR14";
$dbname = "Administra";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO tu_tabla (nombre, edad, categoria)
            VALUES ('$nombre', $edad, '$categoria')";

    if ($conn->query($sql) === TRUE) {
        echo "Nuevo atleta agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
   
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Atleta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-3 mb-4">Agregar Nuevo Atleta</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad:</label>
                <input type="number" class="form-control" id="edad" name="edad" required>
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría:</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Atleta</button>
        </form>
    </div>
</body>
</html>
