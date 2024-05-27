const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');

const app = express();
const port = 3000;

// Configura la conexión a la base de datos
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'aaronCR14',
    database: 'Administra'
});

// Conéctate a la base de datos
connection.connect(err => {
    if (err) {
        console.error('Error al conectar a la base de datos:', err);
        return;
    }
    console.log('Conexión exitosa a la base de datos');
});

// Middleware para analizar los datos del cuerpo de las solicitudes
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

// Ruta para manejar el inicio de sesión
app.post('/login', (req, res) => {
    const { username, password } = req.body;

    // Realiza una consulta a la base de datos para verificar las credenciales
    connection.query('SELECT * FROM usuarios WHERE nombre_usuario = ? AND contraseña = ?', [username, password], (error, results) => {
        if (error) {
            res.status(500).json({ message: 'Error interno del servidor' });
        } else if (results.length > 0) {
            res.status(200).json({ message: 'Inicio de sesión exitoso', tipo_usuario: results[0].tipo_usuario });
        } else {
            res.status(401).json({ message: 'Credenciales inválidas' });
        }
    });
});

// Inicia el servidor
app.listen(port, () => {
    console.log(`Servidor en funcionamiento en http://localhost:${port}`);
});

// Lógica del cliente (en el mismo archivo)
function login() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Enviar solicitud al servidor
    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ username, password })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Credenciales inválidas');
        }
        // Redirigir al usuario a datos.html
        window.location.href = 'datos.html';
    })
    .catch(error => {
        document.getElementById('error-msg').innerText = error.message;
    });
}
