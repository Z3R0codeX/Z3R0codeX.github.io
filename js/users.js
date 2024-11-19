const form = document.getElementById("userForm");
    const modal = new bootstrap.Modal(document.getElementById("alertModal"));
    const alertBody = document.getElementById("alertModalBody");
    const confirmButton = document.getElementById("modalConfirmButton");
    let isFormValid = false;

    form.addEventListener("submit", function(event) {
      event.preventDefault(); // Evita el envío del formulario si hay errores

      // Obtener los valores de los campos
      const username = document.getElementById("username").value.trim();
      const email = document.getElementById("email").value.trim();
      const password = document.getElementById("password").value.trim();
      const confirmPassword = document.getElementById("confirm-password").value.trim();

      // Validaciones
      if (!username) {
        showModal("El nombre de usuario es obligatorio.");
        return;
      }

      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showModal("El correo electrónico no es válido.");
        return;
      }

      if (password.length < 8 || !/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
        showModal("La contraseña debe tener al menos 8 caracteres, una letra mayúscula y un número.");
        return;
      }

      if (password !== confirmPassword) {
        showModal("Las contraseñas no coinciden.");
        return;
      }

      // Si todas las validaciones son correctas
      isFormValid = true;
      showModal("Formulario enviado correctamente. Presiona aceptar para continuar.");
    });

    // Función para mostrar el modal con el mensaje
    function showModal(message) {
      alertBody.textContent = message;
      modal.show();
    }

    // Evento para el botón de confirmar en el modal
    confirmButton.addEventListener("click", function() {
      modal.hide();
      if (isFormValid) {
        form.submit(); // Envía el formulario si todo está correcto
      }
    });