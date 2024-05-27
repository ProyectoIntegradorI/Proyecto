
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
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
    $query->bind_param("s", $username);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['contraseña']) { // No se utiliza password_verify ya que la contraseña se guarda en texto plano en la base de datos
            session_start();
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
            // Redirigir al usuario a datos.html
            header("Location: datos.html");
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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="codigos/css/login.css">
    <link rel="icon" href="codigos/img/th.jpeg">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12"></div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-black text-white d-flex justify-content-center align-items-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body p-5">
                        <form id="login-form" action="login.php" method="POST">
                            <div class="h-75">
                                <div class="form-group mt-3">
                                    <label for="username">Nombre de Usuario</label>
                                    <input type="text" class="form-control" name="username" id="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">Mostrar</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-block text-white btn-inicio mt-3">Iniciar Sesión</button>
                                <p id="error-msg" class="text-danger mt-3">
                                    <?php
                                        if(isset($_GET['error'])){
                                            echo $_GET['error'];
                                        }
                                    ?>
                                </p>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <a href="#">¿Olvidaste tu contraseña?</a>
                                    </div>
                                    <div>
                                        <a href="registro.php">Registrarme</a>
                                    </div>
                                </div>
                                <span class="d-flex justify-content-center align-items-center mt-2 mb-2">Or</span>
                                <a href="" class="btn btn-block text-white btn-inicio fa fa-facebook">Iniciar Sesión con Facebook</a>
                                <a href="" class="btn btn-block text-white btn-inicio mt-2 fa fa-twitter">Iniciar Sesión con Twitter</a>
                                <a href="" class="btn btn-block text-white btn-inicio mt-2 fa fa-google">Iniciar Sesión con Google</a>
                            </div>
                        </form>
                        <p class="mt-3 text-center"><a href="index.php">VOLVER A INICIO</a></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-12"></div>
        </div>
    </div>

    <script src="login.js"></script>
</body>
</html>
