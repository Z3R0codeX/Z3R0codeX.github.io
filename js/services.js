const form = document.getElementById("Form");
    const modal = new bootstrap.Modal(document.getElementById("alertModal"));
    const alertBody = document.getElementById("alertModalBody");
    const confirmButton = document.getElementById("modalConfirmButton");
    let isFormValid = false;

    form.addEventListener("submit", function(event) {
      event.preventDefault(); // Evita el envío del formulario si hay errores

      // Obtener los valores de los campos
      const nombre = document.getElementById("Nombre").value.trim();
      const descripcion = document.getElementById("Descripcion").value.trim();
      const precio = document.getElementById("Precio").value.trim();
      const fecha = document.getElementById("Fecha").value.trim();
      const hora = document.getElementById("Hora").value.trim();
      const estado = document.getElementById("Estado").value;

      // Validaciones
      if (!nombre) {
        showModal("El nombre es obligatorio.");
        return;
      }

      if (!descripcion) {
        showModal("La descripción es obligatoria.");
        return;
      }

      if (precio <= 0 || isNaN(precio)) {
        showModal("El precio debe ser un número mayor a 0.");
        return;
      }

      if (!fecha) {
        showModal("La fecha es obligatoria.");
        return;
      }

      if (!hora) {
        showModal("La hora es obligatoria.");
        return;
      }

      if (!estado) {
        showModal("Debes seleccionar un estado válido.");
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
