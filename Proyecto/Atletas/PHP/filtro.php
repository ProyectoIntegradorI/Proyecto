<?php
$servername = "localhost";
$username = "root";
$password = "tamara11";
$dbname = "Skila";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cedula = $_POST['cedula'];

    //Consulta a la base de datos 
    $query = $conn->prepare("SELECT * FROM atletas WHERE cedula = ?");
    $query->bind_param("s", $cedula);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $atleta = $result->fetch_assoc();
    } else {
        $error_message = "No se encontró ningún atleta con esa cédula.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtro de Atletas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="filtro.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="#">Atletas</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h1 class="mb-4">Filtro de Atletas</h1>
        <form method="POST">
            <div class="form-group">
                <label for="cedula">Ingrese la cédula del atleta:</label>
                <input type="text" class="form-control" id="cedula" name="cedula" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php if (isset($atleta)): ?>
            <div class="mt-4">
                <h2>Información del Atleta</h2>
                <p><strong>Cédula:</strong> <?php echo $atleta['cedula']; ?></p>
                <p><strong>Nombre:</strong> <?php echo $atleta['nombre']; ?></p>
                <p><strong>Edad:</strong> <?php echo $atleta['edad']; ?></p>
                <p><strong>Categoría:</strong> <?php echo $atleta['categoria']; ?></p>
            </div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger mt-4" role="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
