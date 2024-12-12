<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

?>
<?php
  include "./php/conexion.php";
  $sql="select * from pets order by pet_id DESC";
  $res=$conexion->query($sql)or die($conexion->error);

  $title="Gestión de Mascotas";
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

          <div class="d-flex justify-content-end flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <button
              class="btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#addPetModal"
            >
              <i class="bi bi-plus-circle"></i> Agregar Mascota
            </button>
          </div>

          <svg xmlns="http://www.w3.org/2000/svg"  class="d-none">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>


          <?php
            if(isset($_GET['status']) && $_GET['status']== 1)
            {
            ?>
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert" style="height: 100px">
            <svg style="width:50px"  class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div>
             <?php echo "Datos actualizados" ?>
            </div>
              </div>
              <?php
            }
              ?>

          <div
            class="modal fade"
            id="addPetModal"
            tabindex="-1"
            aria-labelledby="addPetModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addPetModalLabel">
                    Agregar Nueva Mascota
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <form action="./php/add.php" enctype="multipart/form-data" method="post" id="addPetForm2" novalidate>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="petName" class="form-label"
                        >Nombre de la Mascota</label
                      >
                      <input name="txtname"
                        type="text"
                        class="form-control"
                        id="petName"
                        required
                      />
                    </div>
                    <input type="hidden"  name="index" class="form-control" id="index" value="2">
                    <div class="mb-3">
                      <label for="petSpecies" class="form-label">Especie</label>
                      <select name="txtespc" class="form-select" id="petSpecies" required>
                        <option value="" selected disabled>
                          Selecciona la especie
                        </option>
                        <option value="Perro">Perro</option>
                        <option value="Gato">Gato</option>
                        <option value="Ave">Ave</option>
                        <option value="Reptil">Reptil</option>
                        <option value="Otro">Otro</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="petBreed" class="form-label">Raza</label>
                      <input
                        name="txtraza"
                        type="text"
                        class="form-control"
                        id="petBreed"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="petAge" class="form-label">Fecha de nacimiento</label>
                      <input
                        name="txtfecha"
                        type="date"
                        class="form-control"
                        id="petAge"
                        min="0"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="petImages" class="form-label"
                        >Imágenes de la Mascota</label
                      >
                      <input
                        name="txtimg[]"
                        type="file"
                        class="form-control"
                        id="petImages"
                        multiple
                        accept="image/*"
                        required
                      />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                      Agregar Mascota
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>

<!--modal editar -->
          <div
            class="modal fade"
            id="EditPetModal"
            tabindex="-1"
            aria-labelledby="EditPetModalLabel"
            aria-hidden="true"
          >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="EditPetModalLabel">
                    Editar Mascota
                  </h5>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <form action="./php/add.php" enctype="multipart/form-data" method="post" id="EditPetForm" novalidate>
                  <div class="modal-body">
                    <div class="mb-3">
                      <label for="petName" class="form-label"
                        >Nombre de la Mascota</label
                      >
                      <input name="txtname"
                        type="text"
                        class="form-control"
                        id="Ename"
                        required
                      />
                    </div>
                    <input type="hidden"  name="index" class="form-control" id="Eindex" value="11">
                    <input type="text"  name="id" class="form-control" id="petid" required>
                    <div class="mb-3">
                      <label for="petSpecies" class="form-label">Especie</label>
                      <select name="txtespc" class="form-select" id="Especies" required>
                      <option value="" selected disabled>Selecciona la especie</option>
                        <option value="Perro">Perro</option>
                        <option value="Gato">Gato</option>
                        <option value="Ave">Ave</option>
                        <option value="Reptil">Reptil</option>
                        <option value="Otro">Otro</option>
                      </select>

                    </div>
                    <div class="mb-3">
                      <label for="petBreed" class="form-label">Raza</label>
                      <input
                        name="txtraza"
                        type="text"
                        class="form-control"
                        id="Ebreed"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="petAge" class="form-label">Fecha de nacimiento</label>
                      <input
                        name="txtfecha"
                        type="date"
                        class="form-control"
                        id="EpetAge"
                        min="0"
                        required
                      />
                    </div>
                    <div class="mb-3">
                      <label for="petImages" class="form-label"
                        >Imágenes de la Mascota</label
                      >
                      <input
                        name="txtimg[]"
                        type="file"
                        class="form-control"
                        id="EpetImages"
                        multiple
                        accept="image/*"
                        required
                      />
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                      Agregar Mascota
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>


          <style>
  .card:hover {
    transform: scale(1.05); /* Incrementa el tamaño del card */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Agrega sombra */
    transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transición suave */
  }
</style>

<div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
  <!-- Card -->
  <?php while($fila=mysqli_fetch_array($res)) { ?>
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img
          src="<?php echo './img/pets/' . $fila['main_image_url']; ?>"
          alt="<?php echo $fila['name']; ?>"
          class="img-fluid rounded"
          style="width: 300px; height: 200px; object-fit: cover;"
        />
        <div class="card-body">
          <h5 class="card-title"><?php echo htmlspecialchars($fila['name']); ?></h5>
          <p class="card-text">
            <strong>Especie:</strong> <?php echo htmlspecialchars($fila['species']); ?><br />
            <strong>Raza:</strong> <?php echo htmlspecialchars($fila['breed']); ?><br />
            <strong>Fecha de Nacimiento:</strong> <?php echo htmlspecialchars($fila['birth_date']); ?><br />
          </p>
          <div class="d-flex justify-content-between">
            <!-- Botón para editar -->
            <button
              class="btn btn-warning btn-sm btnEdit"
              data-id="<?php echo $fila['pet_id'] ?>"
              data-name="<?php echo $fila['name'] ?>"
              data-species="<?php echo $fila['species'] ?>"
              data-breed="<?php echo $fila['breed'] ?>"
              data-date="<?php echo $fila['birth_date'] ?>"
              data-img="<?php echo './img/pets/' . $fila['main_image_url'] ?>"
              data-bs-toggle="modal"
              data-bs-target="#EditPetModal"
            >
              <i class="bi bi-pencil-square"></i> Editar
            </button>
            <!-- Botón para eliminar -->
            <button class="btn btn-sm btn-danger btnEliminar"
              data-id="<?php echo $fila['pet_id']; ?>"
              data-bs-toggle="modal" data-bs-target="#deleteUserModal">
              <i class="bi bi-trash"></i> Eliminar
            </button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>

        </main>
        <!-- Modal para mensajes de validación -->
        <div
          class="modal fade"
          id="validationModal"
          tabindex="-1"
          aria-labelledby="validationModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-danger" id="validationModalLabel">
                  Errores de Validación
                </h5>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <ul id="validationErrors" class="text-danger"></ul>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Cerrar
                </button>
              </div>
            </div>
          </div>
        </div>

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./js/pets.js"></script>
    <script>
      $(document).ready(function(){
        var idEliminar = -1;
        var fila;
        $(".btnEliminar").click(function(){
          idEliminar=$(this).data('id');
          fila=$(this).parent('div').parent('div').parent('div');
        });
        $(".eliminar").click(function(){
          $.ajax({
            url:'./php/eliminar.php',
            method:'POST',
            data:{
              id:idEliminar,
              tabla:'pets',
              columna:'pet_id',
              folder:'pets'
            }
          }).done(function(res){
          console.log(res,"gfdgfd");
            $(fila).fadeOut(500);
          });
          
        });
      });
    </script>
  </body>
</html>










