<?php
$host = "dpg-cusmradumphs73c9grc0-a.oregon-postgres.render.com"; // DB_HOST completo
$db   = "iglesias_localidad"; // Nombre de la base de datos
$user = "feligres_admin"; // Usuario
$pass = "dIEUWItATBdYAIgx8kgyNCuNyzUJggHm"; // Contraseña de Render

$dsn = "pgsql:host=$host;dbname=$db";

try {
    $conexion = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>