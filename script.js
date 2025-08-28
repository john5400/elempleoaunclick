<script>
// Guardar usuario al registrarse
document.getElementById('register-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('register-name').value.trim();
    const email = document.getElementById('register-email').value.trim();
    const password = document.getElementById('register-password').value;

    if (localStorage.getItem(email)) {
        alert('Este correo ya está registrado.');
        return;
    }

    localStorage.setItem(email, JSON.stringify({ name, email, password }));
    alert('¡Registro exitoso! Ahora puedes iniciar sesión.');
    toggleForms();
});

// Validar usuario al iniciar sesión
document.getElementById('login-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('login-email').value.trim();
    const password = document.getElementById('login-password').value;

    const user = JSON.parse(localStorage.getItem(email));
    if (user && user.password === password) {
        alert('¡Bienvenido, ' + user.name + '!');
        // Aquí puedes redirigir a otra página si quieres
        // window.location.href = "bienvenido.html";
    } else {
        alert('Correo o contraseña incorrectos.');
    }
});
</script>