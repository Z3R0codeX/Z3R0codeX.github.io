<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

$title="Reportes y Análisis";

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
        <main
          class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex flex-column flex-grow-1"
        >
        <?php include "./layouts/header.php" ?>

          <!-- Filtro de Fechas -->
          <div class="row mb-4">
            <div class="col-md-4">
              <label for="startDate" class="form-label">Fecha Inicio</label>
              <input type="date" id="startDate" class="form-control" />
            </div>
            <div class="col-md-4">
              <label for="endDate" class="form-label">Fecha Fin</label>
              <input type="date" id="endDate" class="form-control" />
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button class="btn btn-primary w-100" id="filterButton">
                Aplicar Filtros
              </button>
            </div>
          </div>

          <!-- Estadísticas Clave -->
          <div class="row text-center mb-4">
            <div class="col-md-3">
              <div class="card bg-primary text-white">
                <div class="card-body">
                  <h5 class="card-title">Servicios Totales</h5>
                  <p class="display-6" id="totalServicios">0</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card bg-success text-white">
                <div class="card-body">
                  <h5 class="card-title">Servicios Realizados</h5>
                  <p class="display-6" id="realizados">0</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card bg-warning text-dark">
                <div class="card-body">
                  <h5 class="card-title">Servicios Pendientes</h5>
                  <p class="display-6" id="pendientes">0</p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card bg-danger text-white">
                <div class="card-body">
                  <h5 class="card-title">Servicios Cancelados</h5>
                  <p class="display-6" id="cancelados">0</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Gráficos -->
          <div class="row">
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-header">Distribución de Servicios</div>
                <div class="card-body">
                  <canvas id="servicesChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 mb-4">
              <div class="card">
                <div class="card-header">Tendencias Mensuales</div>
                <div class="card-body">
                  <canvas id="monthlyTrendsChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </main>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./js/script.js"></script>
  </body>
</html>
