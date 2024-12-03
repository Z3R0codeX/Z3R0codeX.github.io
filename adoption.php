<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

?>
<?php
include "./php/conexion.php";

// Consulta SQL para unir las tablas `adoptions` y `pets`
$sql = "SELECT 
            a.adoption_id, 
            p.name AS pet_name,
            p.birth_date AS b_date,
            p.breed, 
            a.status_id,
            u.username
        FROM adoptions a
        INNER JOIN pets p ON a.pet_id = p.pet_id
        INNER JOIN users u ON a.user_id = u.user_id
        ORDER BY a.adoption_id DESC";

$res = $conexion->query($sql) or die($conexion->error);

$title="Adopciones";
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
          <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom"
          >
            <button
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#addAdoptionModal"
            >
              <i class="bi bi-plus"></i> Agregar Adopción
            </button>
          </div>

          <!-- Tabla de Adopciones -->
          <div class="table-responsive">
            <table class="table table-striped table-hover">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Nombre de la Mascota</th>
                  <th>Especie</th>
                  <th>Fecha de nacimiento</th>
                  <th>Estado</th>
                  <th>Adoptante</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
              <?php
                    while($fila=mysqli_fetch_array($res)){
                  ?>
                <tr>
                <td><?php echo $fila['adoption_id'] ?></td>
                <td><?php echo $fila['pet_name'] ?></td>
                <td><?php echo $fila['breed'] ?></td>
                <td><?php echo $fila['b_date'] ?></td>
                <td><?php 
                      if($fila['status_id']==2){
                        echo '<span class="badge bg-warning">Pendiente</span>';
                      }
                      if($fila['status_id']==3){echo '<span class="badge bg-success">Completado</span>';
                      }
                    ?></td>
                    <td><?php echo $fila['username']; ?></td>
                  <td>
                    <button
                      class="btn btn-warning btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#addAdoptionModal"
                    >
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button
                      class="btn btn-sm btn-danger"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteUserModal"
                    >
                      <i class="bi bi-trash"></i>
                    </button>
                  </td>
                </tr>
                <?php
                    }
                ?>
              </tbody>
            </table>
          </div>

          <!-- Modal para agregar adopción -->
          <div
            class="modal fade"
            id="addAdoptionModal"
            tabindex="-1"
            aria-labelledby="addAdoptionModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addAdoptionModalLabel">
                    Agregar Adopción
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="petForm">
                    <div class="mb-3">
                      <label for="petName" class="form-label"
                        >Nombre de la Mascota</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="petName"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="petSpecies" class="form-label">Especie</label>
                      <select class="form-select" id="petSpecies" required>
                        <option selected disabled>Selecciona una opción</option>
                        <option value="Perro">Perro</option>
                        <option value="Gato">Gato</option>
                        <option value="Ave">Ave</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="petAge" class="form-label">Edad</label>
                      <input
                        type="text"
                        class="form-control"
                        id="petAge"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="adoptionStatus" class="form-label"
                        >Estado</label
                      >
                      <select class="form-select" id="adoptionStatus" required>
                        <option selected disabled>Selecciona un estado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="Adoptado">Adoptado</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                      Guardar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </main>

        <!-- Alerta de confirmación para eliminar -->
        <div
          class="modal fade"
          id="deleteUserModal"
          tabindex="-1"
          aria-labelledby="deleteUserModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">
                  Confirmar Eliminación
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                ¿Estás seguro de que deseas eliminar a este usuario? Esta acción
                no se puede deshacer.
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Cancelar
                </button>
                <button type="button" class="btn btn-danger">Eliminar</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal para alertas -->
        <div
          class="modal fade"
          id="alertModal"
          tabindex="-1"
          aria-labelledby="alertModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="alertModalLabel">Validación</h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Cerrar"
                ></button>
              </div>
              <div class="modal-body" id="alertModalBody">
                <!-- Mensaje dinámico de error o éxito -->
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  id="modalConfirmButton"
                  class="btn btn-primary"
                >
                  Aceptar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="./js/adoption.js"></script>
  </body>
</html>
