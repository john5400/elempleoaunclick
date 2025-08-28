<?php
session_start();
include("conexion.php"); // tu archivo de conexión a la BD

// Manejo del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["action"]) && $_POST["action"] == "login") {
        // LOGIN
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user["password"])) {
                $_SESSION["user"] = $user["name"];
                header("Location: dashboard.php");
                exit;
            } else {
                $mensaje = "Contraseña incorrecta.";
            }
        } else {
            $mensaje = "El usuario no existe.";
        }

    } elseif (isset($_POST["action"]) && $_POST["action"] == "register") {
        // REGISTRO
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (name, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            $mensaje = "Error al registrar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso y Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f5f5f5, #e0d4c3);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }
        h2 { font-family: 'Rancho', cursive; font-size: 2rem; color: #8B4513; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { font-weight: bold; margin-bottom: 8px; display: block; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 8px; }
        .form-actions button {
            background: #8B4513; color: white; padding: 12px 24px; border: none; border-radius: 8px;
            cursor: pointer; font-size: 1.2rem; transition: 0.3s;
        }
        .form-actions button:hover { background: #A0522D; }
        .toggle-link { margin-top: 20px; cursor: pointer; color: #8B4513; text-decoration: underline; }
        .hidden { display: none; }
        .mensaje { margin: 15px 0; color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 id="form-title">Iniciar Sesión</h2>
        
        <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>

        <!-- LOGIN -->
        <form id="login-form" method="POST" class="" autocomplete="on">
            <input type="hidden" name="action" value="login">
            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-actions">
                <button type="submit">Ingresar</button>
            </div>
            <span class="toggle-link" onclick="toggleForms()">¿No tienes cuenta? Regístrate</span>
        </form>

        <!-- REGISTRO -->
        <form id="register-form" method="POST" class="hidden" autocomplete="on">
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label>Nombre completo</label>
                <input type="text" name="name" required>
            </div>
            <div class="form-group">
                <label>Correo electrónico</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Contraseña</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-actions">
                <button type="submit">Registrarse</button>
            </div>
            <span class="toggle-link" onclick="toggleForms()">¿Ya tienes cuenta? Inicia sesión</span>
        </form>
    </div>

    <script>
        function toggleForms() {
            document.getElementById("login-form").classList.toggle("hidden");
            document.getElementById("register-form").classList.toggle("hidden");
            document.getElementById("form-title").textContent =
                document.getElementById("login-form").classList.contains("hidden")
                ? "Registro de Usuario" : "Iniciar Sesión";
        }
    </script>
</body>
</html>
