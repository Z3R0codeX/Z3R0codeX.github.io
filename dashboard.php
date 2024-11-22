<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Petpedia Dashboard</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
          <div class="position-sticky">
            <h4 class="text-center text-light py-3">Petpedia Dashboard</h4>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link text-light" href="./dashboard.html">
                  <i class="bi bi-house"></i> Inicio
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="./users.html">
                  <i class="bi bi-people"></i> Gestión de Usuarios
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="./pets.html">
                  <i class="bi bi-people"></i> Gestión de Mascotas
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="./services.html">
                  <i class="bi bi-box"></i> Servicios
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="./adoption.html">
                  <i class="bi bi-house-heart"></i> Adopciones
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="./stats.html">
                  <i class="bi bi-bar-chart"></i> Reportes y Análisis
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <nav class="px-4 py-4 navbar navbar-expand-lg bg-body-tertiary px-4">
            <div class="container-fluid">
              <h1 class="h2">Inicio</h1>
              <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="navbar-toggler-icon"></span>
              </button>
              <div
                class="collapse navbar-collapse justify-content-end"
                id="navbarSupportedContent"
              >
                <ul class="navbar-nav">
                  <li class="nav-item mx-4">
                    <button
                      type="button"
                      class="btn btn-light position-relative"
                    >
                      <i class="bi bi-bell"></i>
                      <span
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                      >
                        20
                        <span class="visually-hidden">unread messages</span>
                      </span>
                    </button>
                  </li>
                  <li class="nav-item">
                    <img
                      src="./img/profile.jpg"
                      style="
                        width: 40px;
                        border-radius: 50%;
                        border: 1px solid black;
                      "
                    />
                  </li>
                  <li class="nav-item dropdown mx-4">
                    <a
                      class="nav-link dropdown-toggle active"
                      href="#"
                      role="button"
                      data-bs-toggle="dropdown"
                      aria-expanded="false"
                    >
                      <?php echo $user['nombre'];
                      ?>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="#">Perfil</a></li>
                      <li>
                        <hr class="dropdown-divider" />
                      </li>
                      <li><a class="dropdown-item" href="#">Log Out</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </nav>

          <!-- Example content -->
          <div class="card mb-4">
            <div class="card-body">
              <h5 class="card-title">Resumen</h5>
              <p class="card-text">
                Aquí puedes ver un resumen de los comentarios recientes del
                sitio.
              </p>

              <!-- Carrusel de comentarios -->
              <div
                id="recentCommentsCarousel"
                class="carousel slide"
                data-bs-ride="carousel"
              >
                <div class="carousel-inner">
                  <!-- Comentario 1 -->
                  <div class="carousel-item active">
                    <blockquote class="blockquote text-center">
                      <p class="mb-4">
                        "Adopté a Max hace dos semanas y es el mejor amigo que
                        he tenido. Gracias por su ayuda."
                      </p>
                      <footer class="blockquote-footer">Juan Pérez</footer>
                    </blockquote>
                  </div>
                  <!-- Comentario 2 -->
                  <div class="carousel-item">
                    <blockquote class="blockquote text-center">
                      <p class="mb-4">
                        "La atención al cliente fue excelente. Mi gato está
                        mucho más feliz después de la consulta."
                      </p>
                      <footer class="blockquote-footer">Ana López</footer>
                    </blockquote>
                  </div>
                  <!-- Comentario 3 -->
                  <div class="carousel-item">
                    <blockquote class="blockquote text-center">
                      <p class="mb-4">
                        "Gracias por su apoyo en el proceso de adopción. Rocky
                        es increíble."
                      </p>
                      <footer class="blockquote-footer">Carlos Méndez</footer>
                    </blockquote>
                  </div>
                </div>

                <!-- Controles del carrusel -->
                <button
                  class="carousel-control-prev"
                  type="button"
                  data-bs-target="#recentCommentsCarousel"
                  data-bs-slide="prev"
                >
                  <span
                    class="carousel-control-prev-icon custom-carousel-control"
                    aria-hidden="true"
                  ></span>
                  <span class="visually-hidden">Anterior</span>
                </button>
                <button
                  class="carousel-control-next"
                  type="button"
                  data-bs-target="#recentCommentsCarousel"
                  data-bs-slide="next"
                >
                  <span
                    class="carousel-control-next-icon custom-carousel-control"
                    aria-hidden="true"
                  ></span>
                  <span class="visually-hidden">Siguiente</span>
                </button>
              </div>
            </div>
          </div>

          <!-- CSS -->
          <style>
            /* Personalización de los controles del carrusel */
            .custom-carousel-control {
              background-color: black !important; /* Fondo negro */
              border-radius: 50%; /* Opcional: hacer los controles redondos */
            }
          </style>

          <div class="row">
            <div class="col-md-3">
              <div class="card text-white bg-primary mb-3">
                <div class="card-header d-flex align-items-center">
                  <i class="bi bi-person-fill me-2"></i> Usuarios Registrados
                  Hoy
                </div>
                <div
                  class="card-body d-flex align-items-center justify-content-between"
                >
                  <h5 class="card-title mb-0">10</h5>
                  <i class="bi bi-graph-up fs-1"></i>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card text-white bg-success mb-3">
                <div class="card-header d-flex align-items-center">
                  <i class="bi bi-calendar-check-fill me-2"></i> Servicios
                  Agendados Hoy
                </div>
                <div
                  class="card-body d-flex align-items-center justify-content-between"
                >
                  <h5 class="card-title mb-0">5</h5>
                  <i class="bi bi-check-circle fs-1"></i>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card text-white bg-warning mb-3">
                <div class="card-header d-flex align-items-center">
                  <i class="bi bi-paw-fill me-2"></i> Mascotas Adoptadas Hoy
                </div>
                <div
                  class="card-body d-flex align-items-center justify-content-between"
                >
                  <h5 class="card-title mb-0">2</h5>
                  <i class="bi bi-heart fs-1"></i>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card text-white bg-danger mb-3">
                <div class="card-header d-flex align-items-center">
                  <i class="bi bi-x-circle-fill me-2"></i> Servicios Cancelados
                  Hoy
                </div>
                <div
                  class="card-body d-flex align-items-center justify-content-between"
                >
                  <h5 class="card-title mb-0">3</h5>
                  <i class="bi bi-exclamation-triangle fs-1"></i>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  </body>
</html>
