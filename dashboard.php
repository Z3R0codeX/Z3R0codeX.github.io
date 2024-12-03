<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

$title="Inicio";

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
        <?php include "./layouts/aside.php" ?>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

        <?php include "./layouts/header.php" ?>

          <!-- Example content -->
          <div class="card mb-4  pt-3 pb-2 mb-3 mt-3">
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
