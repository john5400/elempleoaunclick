<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso y Registro</title>
    <link href="https://fonts.googleapis.com/css?family=Rancho&effect=shadow-multiple" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
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
        .form-container h2 {
            font-family: 'Rancho', cursive;
            font-size: 3rem;
            color: #8B4513;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
        }
        .form-actions {
            margin-top: 30px;
        }
        .form-actions button {
            background-color: #8B4513;
            color: white;
            font-family: 'Rancho', cursive;
            font-size: 1.5rem;
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-actions button:hover {
            background-color: #A0522D;
        }
        .toggle-link {
            display: block;
            margin-top: 20px;
            color: #8B4513;
            text-decoration: underline;
            cursor: pointer;
            font-family: 'Rancho', cursive;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 id="form-title">Iniciar Sesión</h2>

        <!-- Formulario de inicio de sesión -->
        <form id="login-form" method="POST" action="login.php" autocomplete="on">
            <div class="form-group">
                <label for="login-email">Correo electrónico</label>
                <input type="email" name="email" id="login-email" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="login-password">Contraseña</label>
                <input type="password" name="password" id="login-password" required autocomplete="current-password">
            </div>
            <div class="form-actions">
                <button type="submit">Ingresar</button>
            </div>
            <span class="toggle-link" onclick="toggleForms()">¿No tienes cuenta? Regístrate</span>
        </form>

        <!-- Formulario de registro -->
        <form id="register-form" class="hidden" method="POST" action="register.php" autocomplete="on">
            <div class="form-group">
                <label for="register-name">Nombre completo</label>
                <input type="text" name="name" id="register-name" required autocomplete="name">
            </div>
            <div class="form-group">
                <label for="register-email">Correo electrónico</label>
                <input type="email" name="email" id="register-email" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="register-password">Contraseña</label>
                <input type="password" name="password" id="register-password" required autocomplete="new-password">
            </div>
            <div class="form-actions">
                <button type="submit">Registrarse</button>
            </div>
            <span class="toggle-link" onclick="toggleForms()">¿Ya tienes cuenta? Inicia sesión</span>
        </form>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            const formTitle = document.getElementById('form-title');

            if (loginForm.classList.contains('hidden')) {
                loginForm.classList.remove('hidden');
                registerForm.classList.add('hidden');
                formTitle.textContent = 'Iniciar Sesión';
            } else {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                formTitle.textContent = 'Registro de Usuario';
            }
        }
    </script>
</body>
</html>
