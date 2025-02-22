<?php
$host = getenv('DB_HOST'); // Host de Render
$db   = getenv('DB_NAME'); // iglesias_localidad
$user = getenv('DB_USER'); // feligres_admin
$pass = getenv('DB_PASSWORD'); // La contraseña de Render

$dsn = "pgsql:host=$host;dbname=$db;sslmode=require";

try {
    $conn = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>