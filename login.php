<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_iglesia = $_POST['iglesia'];
    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    // Validar credenciales
    $query = $conexion->prepare("SELECT * FROM iglesias WHERE id = ? AND usuario = ?");
    $query->execute([$id_iglesia, $usuario]);
    $iglesia = $query->fetch();

    if ($iglesia && password_verify($contraseña, $iglesia['contraseña'])) {
        $_SESSION['id_iglesia'] = $iglesia['id'];
        header('Location: registro_feligreses.php');
        exit;
    } else {
        echo "¡Credenciales incorrectas 😅";
    }
}
?>