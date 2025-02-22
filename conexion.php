<?php
// conexion.php
$host = 'localhost';
$dbname = 'iglesias_localidad';
$user = 'root';     // Usuario de MySQL (por defecto en XAMPP)
$password = '';     // Contraseña de MySQL (vacío por defecto en XAMPP)

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>