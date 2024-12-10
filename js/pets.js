// Obtener todos los botones con la clase "btnEdit"
var botones = document.getElementsByClassName("btnEdit");

// Agregar evento "onclick" a cada botón
for (var i = 0; i < botones.length; i++) {
  botones[i].onclick = function (evt) {
    var btn = evt.currentTarget; // Botón que activó el evento

    // Obtener valores de los atributos "data-*"
    var id = btn.getAttribute("data-id");
    var name = btn.getAttribute("data-name");
    var species = btn.getAttribute("data-species");
    var breed = btn.getAttribute("data-breed");
    var date = btn.getAttribute("data-date");
    var img = btn.getAttribute("data-img");

    // Establecer los valores en los campos del formulario
    document.getElementById("petid").value = id;
    document.getElementById("Ename").value = name;
    document.getElementById("Especies").value = species;
    document.getElementById("Ebreed").value = breed;
    document.getElementById("EpetAge").value = date;
    document.getElementById("EpetImages").value = img;
  };
}
