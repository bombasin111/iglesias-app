<?php
session_start();
include 'conexion.php';

// Redirigir si ya está autenticado
if (isset($_SESSION['id_iglesia'])) {
    header('Location: login.php');
    exit;
}

// Obtener lista de iglesias desde la base de datos
$query = $conexion->query("SELECT id, nombre FROM iglesias");
$iglesias = $query->fetchAll();

// Procesar el formulario de autenticación para la búsqueda global
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscar_global'])) {
    $usuario_global = $_POST['usuario_global'];
    $contraseña_global = $_POST['contraseña_global'];

    // Depuración: Mostrar los valores ingresados
    echo "Usuario ingresado: $usuario_global<br>";
    echo "Contraseña ingresada: $contraseña_global<br>";

    // Obtener el hash de la contraseña desde la base de datos
    $query = $conexion->prepare("SELECT id, contraseña FROM iglesias WHERE usuario = ?");
    $query->execute([$usuario_global]);
    $usuario = $query->fetch();

    if ($usuario) {
        // Verificar la contraseña usando password_verify
        if (password_verify($contraseña_global, $usuario['contraseña'])) {
            // Autenticación exitosa para búsqueda global
            $_SESSION['busqueda_global'] = true;
            header('Location: buscar_global.php');
            exit;
        } else {
            $error_global = "Usuario o contraseña incorrectos.";
            echo "Error: $error_global<br>"; // Depuración: Mostrar el error
        }
    } else {
        $error_global = "Usuario o contraseña incorrectos.";
        echo "Error: $error_global<br>"; // Depuración: Mostrar el error
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida - Iglesias de la Localidad</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f0f8ff, #ffe4e1); /* Fondo pastel celeste y rosado */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente */
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #6a5acd; /* Color celeste oscuro */
            text-align: center;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.9); /* Fondo semi-transparente para inputs */
            border: 1px solid #ddd;
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #9370db; /* Color lila pastel */
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
        }
        .btn-primary:hover {
            background-color: #7b68ee; /* Color lila más oscuro al pasar el mouse */
        }
        .btn-secondary {
            background-color: #ffb6c1; /* Color rosado pastel */
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
        }
        .btn-secondary:hover {
            background-color: #ff69b4; /* Color rosado más oscuro al pasar el mouse */
        }
        .error {
            color: #ff4500; /* Color naranja para errores */
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Seleccione su Iglesia</h1>
        <h2>Usuario y Contraseña</h2>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="iglesia" class="form-label">Iglesia:</label>
                <select class="form-control" name="iglesia" required>
                    <option value="">-- Elija una iglesia --</option>
                    <?php foreach ($iglesias as $iglesia): ?>
                        <option value="<?= htmlspecialchars($iglesia['id']) ?>"><?= htmlspecialchars($iglesia['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="contraseña" required>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Ingresar</button>
                <button type="button" onclick="mostrarBusquedaGlobal()" class="btn btn-secondary">Búsqueda Global</button>
            </div>
        </form>

        <!-- Formulario de búsqueda global (oculto inicialmente) -->
        <div id="busqueda-global" style="display: none; margin-top: 20px;">
            <h2>Búsqueda Global</h2>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="usuario_global" class="form-label">Usuario:</label>
                    <input type="text" class="form-control" name="usuario_global" required>
                </div>
                <div class="mb-3">
                    <label for="contraseña_global" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" name="contraseña_global" required>
                </div>
                <?php if (isset($error_global)): ?>
                    <p class="error"><?= htmlspecialchars($error_global) ?></p>
                <?php endif; ?>
                <div class="text-center">
                    <button type="submit" name="buscar_global" class="btn btn-primary">Acceder a la búsqueda</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, si necesitas funcionalidades de Bootstrap) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function mostrarBusquedaGlobal() {
            document.getElementById('busqueda-global').style.display = 'block';
        }
    </script>
</body>
</html>