<?php
session_start();
include 'conexion.php';

// Redirigir si ya está autenticado
if (isset($_SESSION['id_iglesia'])) {
    header('Location: login.php');
    exit;
}

// Obtener lista de iglesias desde la base de datos
$query = $conexion->query("SELECT id, nombre, contraseña FROM iglesias");
$iglesias = $query->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bienvenida - Iglesias de la Localidad</title>
    <style>
        body { background-color: rgb(252, 252, 248) ; font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; padding: 20px; }
        select, input { background: rgb(253, 232, 217); width: 100%; padding: 8px; margin: 5px 0; }
        button { background: #007bff; color: white; border: none; padding: 10px 20px; cursor: pointer; }
        h1 {
            text-align: center;
            color: mediumblue;
        }
        .lou-btn {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Seleccione su Iglesia</h1>
    <form method="POST" action="login.php">
        <label>Iglesia:</label>
        <select name="iglesia" required>
            <option value="">-- Elija una iglesia --</option>
            <?php foreach ($iglesias as $iglesia): ?>
                <option value="<?= htmlspecialchars($iglesia['id']) ?>"><?= htmlspecialchars($iglesia['nombre']) ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Usuario:</label>
        <input type="text" name="usuario" required>
        <br>
        <label>Contraseña:</label>
        <input type="password" name="contraseña" required>
        <br>
        <button type="submit" class="lou-btn">Ingresar</button>
    </form>
</body>
</html>