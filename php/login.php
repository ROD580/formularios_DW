<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST["nombre_usuario"];
    $contraseña = $_POST["contraseña"];

    $sql = "SELECT id, contraseña FROM usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error en la preparación: " . $conn->error);
    }

    $stmt->bind_param("s", $nombre_usuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hash_contraseña);
        $stmt->fetch();

        if (password_verify($contraseña, $hash_contraseña)) {
            $_SESSION["usuario_id"] = $id;
            header("Location: index.php");
            exit();
        } else {
            header("Location: login.html?error=" . urlencode("Contraseña incorrecta"));
            exit();
        }
    } else {
        header("Location: login.html?error=" . urlencode("Usuario no encontrado"));
        exit();
    }

    $stmt->close();
}

$conn->close();
?>