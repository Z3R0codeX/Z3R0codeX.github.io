
    document.getElementById("addPetForm").addEventListener("submit", function (event) {
        event.preventDefault();
        const form = this;
        const validationErrors = [];

        // Validar el formulario utilizando la API de validación de HTML5
        if (!form.checkValidity()) {
            if (!document.getElementById("petName").value) {
                validationErrors.push("El nombre de la mascota es obligatorio.");
            }
            if (!document.getElementById("petSpecies").value) {
                validationErrors.push("Debes seleccionar una especie.");
            }
            if (!document.getElementById("petBreed").value) {
                validationErrors.push("La raza es obligatoria.");
            }
            if (!document.getElementById("petAge").value || document.getElementById("petAge").value < 0) {
                validationErrors.push("La edad debe ser un número positivo.");
            }
            if (!document.getElementById("petHealth").value) {
                validationErrors.push("El estado de salud es obligatorio.");
            }
            if (document.getElementById("petImages").files.length === 0) {
                validationErrors.push("Debes cargar al menos una imagen de la mascota.");
            }

            // Mostrar el modal con los errores
            mostrarErrores(validationErrors);
            return;
        }

        // Si no hay errores, agregar la mascota
        agregarMascota();
    });

    function mostrarErrores(errors) {
        const validationModal = new bootstrap.Modal(document.getElementById("validationModal"));
        const errorList = document.getElementById("validationErrors");

        // Limpiar errores previos
        errorList.innerHTML = "";

        // Agregar errores actuales
        errors.forEach(error => {
            const li = document.createElement("li");
            li.textContent = error;
            errorList.appendChild(li);
        });

        // Mostrar el modal
        validationModal.show();
    }

    function agregarMascota() {
        // Lógica para agregar la mascota
        console.log("Formulario válido. Mascota agregada.");
        const addPetModal = new bootstrap.Modal(document.getElementById("addPetModal"));
        addPetModal.hide();
        document.getElementById("addPetForm").reset();
    }
