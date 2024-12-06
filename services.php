<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

?>
<?php
  include "./php/conexion.php";
  $sql = "SELECT 
            a.appointment_id, 
            a.pet_id, 
            a.service_id, 
            a.appointment_date, 
            a.price, 
            a.status_id,
            a.notes, 
            p.name AS pet_name 
        FROM appointments a
        INNER JOIN pets p ON a.pet_id = p.pet_id
        ORDER BY a.appointment_id DESC";
  $res=$conexion->query($sql)or die($conexion->error);

  $title="Servicios";
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

          <!-- Acordeón de Servicios (Encabezado Oscuro) -->
          <div class="accordion accordion-dark" id="servicesAccordion">
            <!-- Consulta Médica -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingConsultaMedica">
                <button
                  class="accordion-button bg-dark text-white"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseConsultaMedica"
                  aria-expanded="true"
                  aria-controls="collapseConsultaMedica"
                >
                  Consulta Médica
                </button>
              </h2>
              <div
                id="collapseConsultaMedica"
                class="accordion-collapse collapse show"
                aria-labelledby="headingConsultaMedica"
                data-bs-parent="#servicesAccordion"
              >
              <div class="accordion-body">
      <div style="max-height: 200px; overflow-y: auto;"> <!-- Scroll activado -->
      <table class="table table-striped" style="position: relative; border-collapse: separate;">
      <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Fecha y Hora</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 0; // Contador para limitar registros
            while ($fila = mysqli_fetch_array($res)) {
              if ($fila['service_id'] == 1) {
                $counter++;
            ?>
              <tr>
                <td><?php echo $fila['pet_name']; ?></td>
                <td><?php echo $fila['notes']; ?></td>
                <td>$<?php echo $fila['price']; ?></td>
                <td><?php echo $fila['appointment_date']; ?></td>
                <td>
                  <?php
                  if ($fila['status_id'] == 2) {
                    echo '<span class="badge bg-warning">Pendiente</span>';
                  } elseif ($fila['status_id'] == 3) {
                    echo '<span class="badge bg-success">Completado</span>';
                  } elseif ($fila['status_id'] == 4) {
                    echo '<span class="badge bg-danger">Cancelado</span>';
                  }
                  ?>
                </td>
                <td>
                  <button
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal"
                  >
                    <i class="bi bi-pencil"></i>
                  </button>
                 <!-- Botón para eliminar -->
  <button class="btn btn-sm btn-danger btnEliminar"
  d         ata-id="<?php echo $fila['appointment_id']; ?>"
            data-table="appointments"
            data-column="appointment_id "
          data-bs-toggle="modal" data-bs-target="#deleteUserModal">
      <i class="bi bi-trash"></i>
  </button>
                </td>
              </tr>
            <?php
              }
            }mysqli_data_seek($res,0);
            ?>
          </tbody>
        </table>
      </div>
      <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#addModal"
      >
        <i class="bi bi-plus-circle"></i> Agregar Registro
      </button>
    </div>
  </div>
</div>

            <div class="accordion-item">
  <h2 class="accordion-header" id="headingAdiestramiento">
    <button
      class="accordion-button bg-dark text-white"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#collapseAdiestramiento"
      aria-expanded="false"
      aria-controls="collapseAdiestramiento"
    >
      Adiestramiento
    </button>
  </h2>
  <div
    id="collapseAdiestramiento"
    class="accordion-collapse collapse"
    aria-labelledby="headingAdiestramiento"
    data-bs-parent="#servicesAccordion"
  >
    <div class="accordion-body">
      <div style="max-height: 200px; overflow-y: auto;"> <!-- Scroll activado -->
      <table class="table table-striped" style="position: relative; border-collapse: separate;">
      <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Fecha y Hora</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 0; // Contador para limitar registros
            while ($fila = mysqli_fetch_array($res)) {
              if ($fila['service_id'] == 3) {
                $counter++;
            ?>
              <tr>
                <td><?php echo $fila['pet_name']; ?></td>
                <td><?php echo $fila['notes']; ?></td>
                <td>$<?php echo $fila['price']; ?></td>
                <td><?php echo $fila['appointment_date']; ?></td>
                <td>
                  <?php
                  if ($fila['status_id'] == 2) {
                    echo '<span class="badge bg-warning">Pendiente</span>';
                  } elseif ($fila['status_id'] == 3) {
                    echo '<span class="badge bg-success">Completado</span>';
                  } elseif ($fila['status_id'] == 4) {
                    echo '<span class="badge bg-danger">Cancelado</span>';
                  }
                  ?>
                </td>
                <td>
                  <button
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal"
                  >
                    <i class="bi bi-pencil"></i>
                  </button>
                  <!-- Botón para eliminar -->
  <button class="btn btn-sm btn-danger btnEliminar"
            data-id="<?php echo $fila['appointment_id']; ?>"
            data-table="appointments"
            data-column="appointment_id "
          data-bs-toggle="modal" data-bs-target="#deleteUserModal">
      <i class="bi bi-trash"></i>
  </button>
                </td>
              </tr>
            <?php
              }
            }mysqli_data_seek($res,0);
            ?>
          </tbody>
        </table>
      </div>
      <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#addModal"
      >
        <i class="bi bi-plus-circle"></i> Agregar Registro
      </button>
    </div>
  </div>
</div>

            <!-- Consulta Estética -->
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingConsultaEstetica">
                <button
                  class="accordion-button bg-dark text-white"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseConsultaEstetica"
                  aria-expanded="false"
                  aria-controls="collapseConsultaEstetica"
                >
                  Consulta Estética
                </button>
              </h2>
              <div
                id="collapseConsultaEstetica"
                class="accordion-collapse collapse"
                aria-labelledby="headingConsultaEstetica"
                data-bs-parent="#servicesAccordion"
              >
                <div class="accordion-body">
      <div style="max-height: 200px; overflow-y: auto;"> <!-- Scroll activado -->
      <table class="table table-striped" style="position: relative; border-collapse: separate;">
      <thead style="position: sticky; top: 0; background-color: #fff; z-index: 1;">
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Precio</th>
              <th>Fecha y Hora</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $counter = 0; // Contador para limitar registros
            while ($fila = mysqli_fetch_array($res)) {
              if ($fila['service_id'] == 2) {
                $counter++;
            ?>
              <tr>
                <td><?php echo $fila['pet_name']; ?></td>
                <td><?php echo $fila['notes']; ?></td>
                <td>$<?php echo $fila['price']; ?></td>
                <td><?php echo $fila['appointment_date']; ?></td>
                <td>
                  <?php
                  if ($fila['status_id'] == 2) {
                    echo '<span class="badge bg-warning">Pendiente</span>';
                  } elseif ($fila['status_id'] == 3) {
                    echo '<span class="badge bg-success">Completado</span>';
                  } elseif ($fila['status_id'] == 4) {
                    echo '<span class="badge bg-danger">Cancelado</span>';
                  }
                  ?>
                </td>
                <td>
                  <button
                    class="btn btn-warning btn-sm"
                    data-bs-toggle="modal"
                    data-bs-target="#addModal"
                  >
                    <i class="bi bi-pencil"></i>
                  </button>
                  <!-- Botón para eliminar -->
  <button class="btn btn-sm btn-danger btnEliminar"
          data-id="<?php echo $fila['appointment_id']; ?>"
            data-table="appointments"
            data-column="appointment_id "
          data-bs-toggle="modal" data-bs-target="#deleteUserModal">
      <i class="bi bi-trash"></i> 
  </button>
                </td>
              </tr>
            <?php
              }
            }mysqli_data_seek($res,0);
            ?>
          </tbody>
        </table>
      </div>
      <button
        class="btn btn-success"
        data-bs-toggle="modal"
        data-bs-target="#addModal"
      >
        <i class="bi bi-plus-circle"></i> Agregar Registro
      </button>
    </div>
  </div>
</div>

          <!-- Modal para Agregar -->
          <div
            class="modal fade"
            id="addModal"
            tabindex="-1"
            aria-labelledby="addModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addConsultaMedicaModalLabel">
                    Nuevo Servicio
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="Form">
                    <div class="mb-3">
                      <label for="Nombre" class="form-label">Nombre</label>
                      <input
                        type="text"
                        class="form-control"
                        id="Nombre"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="Descripcion" class="form-label"
                        >Descripción</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="Descripcion"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="Precio" class="form-label">Precio</label>
                      <input
                        type="number"
                        class="form-control"
                        id="Precio"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="Fecha" class="form-label">Fecha</label>
                      <input
                        type="date"
                        class="form-control"
                        id="Fecha"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="Hora" class="form-label">Hora</label>
                      <input
                        type="time"
                        class="form-control"
                        id="Hora"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="Estado" class="form-label">Estado</label>
                      <select class="form-select" id="Estado" required>
                        <option selected disabled>Selecciona un estado</option>
                        <option value="Realizado">Realizado</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Cancelado">Cancelado</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                      Agregar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>

       <!-- Alerta de confirmación para eliminar -->
<div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="deleteUserModalLabel">Confirmar Eliminación</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              ¿Estás seguro de que deseas eliminar a este registro? Esta acción no se puede deshacer.
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-danger eliminar" data-bs-dismiss="modal">Eliminar</button>
          </div>
      </div>
  </div>
</div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="./js/services.js"></script>
  </body>
</html>
