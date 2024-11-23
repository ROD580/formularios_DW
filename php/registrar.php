<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contraseña = password_hash($_POST["contraseña"], PASSWORD_DEFAULT);

    $sql = "SELECT id FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        header("Location: ../registrar.html?error=" . urlencode("El usuario ya existe"));
        exit();
    }

    $stmt->close();

    $sql = "INSERT INTO usuarios (nombre_usuario, contraseña) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error en la preparación: " . $conn->error);
    }

    $stmt->bind_param("ss", $nombre_usuario, $contraseña);

    if ($stmt->execute()) {
        header("Location: ../login.html");
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
