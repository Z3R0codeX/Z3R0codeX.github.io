// Obtener todos los botones con la clase "btnEdit"
var botones = document.getElementsByClassName("btnEdit");

// Agregar evento "onclick" a cada botón
for (var i = 0; i < botones.length; i++) {
  botones[i].onclick = function (evt) {
    var btn = evt.currentTarget; // Botón que activó el evento

    // Obtener valores de los atributos "data-*"
    var id = btn.getAttribute("data-id");
    var username = btn.getAttribute("data-username");
    var mail = btn.getAttribute("data-mail");

    // Establecer los valores en los campos del formulario
    document.getElementById("userid").value = id;
    document.getElementById("Editusername").value = username;
    document.getElementById("Editemail").value = mail;
  };
}

