<?php
$servername = "localhost";
$username = "root";
$password = "tamara11";
$dbname = "Skila";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['password']);

    // Preparar y ejecutar consulta
    $query = $conn->prepare("SELECT * FROM usuarios WHERE name = ?");
    $query->bind_param("s", $inputUsername);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verificar contraseña (suponiendo que la contraseña está en texto plano; si está hasheada, usa password_verify)
        if ($inputPassword === $row['cont']) {
            session_start();
            $_SESSION['nombre_usuario'] = $row['name'];
            header("Location: HTML/InsAt.html");
            require_once('HTML/InsAt.html');
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    $query->close();
}

$conn->close();
?>



