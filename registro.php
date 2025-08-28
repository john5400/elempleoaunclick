<?php
session_start();
include("conexion.php");

// --- Registro ---
if (isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre','$email','$password')";
    if ($conn->query($sql) === TRUE) {
        $mensaje = "✅ Registro exitoso, ahora inicia sesión.";
    } else {
        $mensaje = "❌ Error: " . $conn->error;
    }
}

// --- Login ---
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = $usuario['nombre'];
            header("Location: panel.php");
            exit();
        } else {
            $mensaje = "❌ Contraseña incorrecta.";
        }
    } else {
        $mensaje = "❌ Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>El Empleo a un Click - Acceso</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rancho&display=swap">
  <style>
    body {
      font-family: 'Rancho', cursive;
      background: linear-gradient(to right, #43cea2, #185a9d);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      margin: 0;
    }
    .container {
      background: #fff;
      border-radius: 20px;
      padding: 30px;
      box-shadow: 0 8px 16px rgba(0,0,0,0.2);
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    h1 {
      margin-bottom: 20px;
      color: #185a9d;
    }
    input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 10px;
      font-size: 16px;
    }
    button {
      background: #185a9d;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      margin: 10px 0;
      transition: 0.3s;
    }
    button:hover {
      background: #43cea2;
    }
    .mensaje {
      margin: 10px 0;
      color: red;
      font-weight: bold;
    }
    .toggle-link {
      color: #185a9d;
      cursor: pointer;
      text-decoration: underline;
      display: block;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>El Empleo a un Click</h1>

    <?php if (!empty($mensaje)) echo "<p class='mensaje'>$mensaje</p>"; ?>

    <!-- Formulario de Login -->
    <form method="POST" id="loginForm">
      <input type="email" name="email" placeholder="Correo electrónico" required><br>
      <input type="password" name="password" placeholder="Contraseña" required><br>
      <button type="submit" name="login">Ingresar</button>
      <span class="toggle-link" onclick="mostrarRegistro()">¿No tienes cuenta? Regístrate</span>
    </form>

    <!-- Formulario de Registro -->
    <form method="POST" id="registerForm" style="display:none;">
      <input type="text" name="nombre" placeholder="Nombre completo" required><br>
      <input type="email" name="email" placeholder="Correo electrónico" required><br>
      <input type="password" name="password" placeholder="Contraseña" required><br>
      <button type="submit" name="registrar">Registrarse</button>
      <span class="toggle-link" onclick="mostrarLogin()">¿Ya tienes cuenta? Inicia sesión</span>
    </form>
  </div>

  <script>
    function mostrarRegistro() {
      document.getElementById("loginForm").style.display = "none";
      document.getElementById("registerForm").style.display = "block";
    }
    function mostrarLogin() {
      document.getElementById("registerForm").style.display = "none";
      document.getElementById("loginForm").style.display = "block";
    }
  </script>
</body>
</html>
