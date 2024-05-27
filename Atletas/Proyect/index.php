<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página Principal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <style>
    .cuadro {
      border: 1px solid #ced4da;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.12);
      padding: 20px;
      margin-bottom: 20px;
      margin-top: 60px;
      
      
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-start" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="info.php">Información</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="filtro.php">Filtrar Atletas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Iniciar Sesión</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-3">
    <h1 class="text-center">Rendimiento del mes</h1>
    
    <div class="row">
      <div class="col-md-4">
        <div class="cuadro">
          <h2>Atleta 1</h2>
          <p>.........</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="cuadro">
          <h2>Atleta 2</h2>
          <p>.........</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="cuadro">
          <h2>Atleta 3</h2>
          <p>.........</p>
        </div>
      </div>
    </div>
  </div>
  
  <script src=""></script>
</body>
</html>
