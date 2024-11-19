const form = document.getElementById("petForm");
    const modal = new bootstrap.Modal(document.getElementById("alertModal"));
    const alertBody = document.getElementById("alertModalBody");
    const confirmButton = document.getElementById("modalConfirmButton");
    let isFormValid = false;

    form.addEventListener("submit", function(event) {
      event.preventDefault(); // Evita el envío del formulario si hay errores

      // Obtener los valores de los campos
      const petName = document.getElementById("petName").value.trim();
      const petSpecies = document.getElementById("petSpecies").value;
      const petAge = document.getElementById("petAge").value.trim();
      const adoptionStatus = document.getElementById("adoptionStatus").value;

      // Validaciones
      if (!petName) {
        showModal("El nombre de la mascota es obligatorio.");
        return;
      }

      if (!petSpecies) {
        showModal("Debes seleccionar una especie válida.");
        return;
      }

      if (!petAge || isNaN(petAge) || petAge <= 0) {
        showModal("La edad debe ser un número mayor a 0.");
        return;
      }

      if (!adoptionStatus) {
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