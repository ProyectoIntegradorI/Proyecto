<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "Utn123**";
$dbname = "proyecto";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(array('status' => 'error', 'message' => 'Error al conectar con la base de datos')));
}

// Consulta para obtener los atletas
$query = "SELECT userId, CONCAT(name_user, ' ', apellidoPat, ' ', apellidoMar) AS fullName FROM deportistas";
$result = $conn->query($query);

$response = array('status' => 'error', 'data' => array());

if ($result && $result->num_rows > 0) {
    $response['status'] = 'success';
    while ($row = $result->fetch_assoc()) {
        $response['data'][] = $row;
    }
} else {
    $response['message'] = 'No se encontraron atletas';
}

$conn->close();

echo json_encode($response);
?>
