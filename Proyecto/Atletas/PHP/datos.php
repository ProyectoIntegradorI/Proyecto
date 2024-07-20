<?php
$servername = "localhost";
$username = "root";
$password = "tamara11";
$dbname = "Skila";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Leer la entrada JSON
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Asignar los valores del JSON a variables
    $name_user = $input['nombre'] ?? '';
    $apellidoPat = $input['apellidoPat'] ?? '';
    $apellidoMar = $input['apellidoMar'] ?? '';
    $tipoSangre = $input['tipoSangre'] ?? '';
    $lateralidad = $input['lateralidad'] ?? '';
    $enfermedades = $input['enfermedades'] ?? '';
    $sexo = $input['sexo'] ?? '';
    $edad = $input['edad'] ?? '';
    $peso = $input['peso'] ?? '';
    $altura = $input['altura'] ?? '';

    // Preparar y ejecutar la declaración SQL
    $stmt = $conn->prepare("INSERT INTO deportistas (name_user, apellidoPat, apellidoMar, tipoSangre, lateralidad, enfermedades, sexo, edad, peso, altura) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $name_user, $apellidoPat, $apellidoMar, $tipoSangre, $lateralidad, $enfermedades, $sexo, $edad, $peso, $altura);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Nuevo atleta agregado correctamente"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
    }

    $stmt->close();
}

$conn->close();
?>

