<nav class="col-md-3 col-lg-2 d-md-block sidebar">
  <div class="position-sticky">
  <h4 class="text-center text-yellow py-3 bg logo">
  <img src="./img/iconmonstr-cat-7-240.png" alt="Petpedia Logo" />
  Petpedia
</h4>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link" href="./dashboard.php">
          <i class="bi bi-house"></i> Inicio
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./users.php">
          <i class="bi bi-people"></i> Gestión de Usuarios
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./pets.php">
          <i class="bi bi-people"></i> Gestión de Mascotas
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./services.php">
          <i class="bi bi-box"></i> Servicios
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./adoption.php">
          <i class="bi bi-house-heart"></i> Adopciones
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./stats.php">
          <i class="bi bi-bar-chart"></i> Reportes y Análisis
        </a>
      </li>
    </ul>
  </div>
</nav>

<style>
  .sidebar {
    min-height: 100vh; /* Altura mínima para cubrir la ventana */
    background-color: #4a4f58; /* Color de fondo */
    overflow-y: auto; /* Habilitar scroll si el contenido crece */
  }

  .sidebar .nav-link {
    color: #ffffff; /* Color predeterminado del texto */
    transition: color 0.3s;
  }

  .sidebar .nav-link:hover {
    color: #f8e71c; /* Color del texto al pasar el cursor */
  }

  .logo {
    color: #f8e71c;
    display: flex; /* Alineación de contenido en fila */
    align-items: center; /* Centrar elementos verticalmente */
    justify-content: center; /* Centrar elementos horizontalmente */
  }

  .logo img {
    height: 50px; /* Altura de la imagen */
    margin-right: 10px; /* Espacio entre la imagen y el texto */
  }

</style>
