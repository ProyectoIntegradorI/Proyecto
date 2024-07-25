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