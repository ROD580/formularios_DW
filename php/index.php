<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit();
}

echo "Bienvenido a la página protegida, tu ID de usuario es: " . $_SESSION["usuario_id"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PAGINA PRUBA DESARROLLO WEB</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="welcome-message">
               ESTO ES:
            </div>
            <div class="content">
                <p>ARROZ CON LECHE</p>
            </div>
        </div>
    </div>
</body>
</html>
