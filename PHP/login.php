<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "tamara11";
$dbname = "skila";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $inputUsername = mysqli_real_escape_string($conn, $_POST['username']);
    $inputPassword = mysqli_real_escape_string($conn, $_POST['password']);

    

    // Preparar y ejecutar consulta
    $query = $conn->prepare("SELECT * FROM usuarios WHERE name = ?");
    $query->bind_param("s", $inputUsername);
    $query->execute();
    $result = $query->get_result();
    
    // Verificar si se encontraron resultados
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Asegúrate de que 'cont' es el nombre correcto de la columna de la contraseña
        if ($inputPassword === $row['cont']) {
            $_SESSION['nombre_usuario'] = $row['name'];
            header("Location: http://localhost:8031/Atletas/HTML/InsAt.html");
            exit();
        } else {
            echo "<script>alert('Contraseña o usuario incorrecto');</script>";
            header("Location: http://localhost:8031/Atletas/HTML/login.html? error=Contraseña incorrecta");
            
            exit();
        }
    } else {
        echo "<script>alert('Contraseña o usuario incorrecto');</script>";
        header("Location:  http://localhost:8031/Atletas/HTML/login.html?error=Usuario no encontrado");
        
        exit();
    }
    

    $query->close();
}

$conn->close();
?>
