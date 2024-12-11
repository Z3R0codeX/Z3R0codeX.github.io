<?php session_start();
if(isset($_SESSION['userdata'])){
  $user=$_SESSION['userdata'];
}else{
  header('Location: ./login.php');
}

$title="Gestion de Usuarios";

?>
<?php
  include "./php/conexion.php";
  $sql="select * from users order by user_id DESC";
  $res=$conexion->query($sql)or die($conexion->error);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
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
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-plus"></i> Agregar Usuario
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
            if(isset($_GET['error']))
            {
            ?>
            <div sclass="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert" style="height: 100px">
            <svg style="width:50px"  class="bi flex-shrink-0 me-2" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div>
             <?php echo $_GET['error'] ?>
            </div>
              </div>
              <?php
            }
              ?>

            <?php
            if(isset($_GET['success']))
            {
            ?>
            <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert" style="height: 100px">
            <svg style="width:50px"  class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <div>
             <?php echo $_GET['success'] ?>
            </div>
              </div>
              <?php
            }
              ?>

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
    
            <!-- Tabla de usuarios -->
            <div class="table-responsive">
              <table class="table table-striped table-hover">
                <thead class="table-dark">
                  <tr>
                    <th>#</th>
                    <th>Nombre de Usuario</th>
                    <th>Email</th>
                    <th>Fecha de Registro</th>
                    <th>Nivel</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while($fila=mysqli_fetch_array($res)){
                  ?>
                  <tr>
                    <td><?php echo $fila['user_id']  ?></td>
                    <td><?php echo $fila['username']  ?></td>
                    <td><?php echo $fila['email']  ?></td>
                    <td><?php echo $fila['created_at']  ?></td>
                    <td><?php 
                      if($fila['level']==1){
                        echo '<span class="badge bg-success">Administrador</span>';
                      }
                      else{echo '<span class="badge bg-dark">Usuario</span>';}
                    ?></td>
                    <td>
                       <!-- Botón para editar -->
                       <button class="btn btn-sm btn-warning btnEdit" 
        data-id="<?php echo $fila['user_id']; ?>"
        data-username="<?php echo $fila['username']; ?>" 
        data-mail="<?php echo $fila['email']; ?>"
        data-bs-toggle="modal" 
        data-bs-target="#EditUserModal">
    <i class="bi bi-pencil-square"></i> Editar
</button>


  <!-- Botón para eliminar -->
  <button class="btn btn-sm btn-danger btnEliminar"
        data-id="<?php echo $fila['user_id']; ?>"
        data-bs-toggle="modal" 
        data-bs-target="#deleteUserModal">
    <i class="bi bi-trash"></i> Eliminar
</button>

                    </td>
                  </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </main>
        </div>
      </div>
      <!-- Modal para agregar usuario -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Agregar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./php/add.php" method="post" enctype="multipart/form-data" id="userForm">
          <div class="modal-body">
            <div class="mb-3">
              <label for="username" class="form-label">Nombre de Usuario</label>
              <input type="text"  name="name" class="form-control" id="username" required>
            </div>
             <input type="hidden"  name="index" class="form-control" id="index" value="1">
            <div class="mb-3">
              <label for="email" class="form-label">Correo Electrónico</label>
              <input type="email" name="mail"  class="form-control" id="email" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" name="pass" class="form-control" id="password" required>
            </div>
            <div class="mb-3">
              <label for="confirm-password" class="form-label">Confirmar Contraseña</label>
              <input type="password" name="pass2" class="form-control" id="confirm-password" required>
            </div>
            <div class="mb-3">
              <label for="level" class="form-label">Nivel</label>
              <input type="number" name="level" class="form-control" id="level" required>
            </div>
            <div class="mb-3">
              <label for="imagen" class="form-label">Imagen</label>
              <input type="file" name="imagen" class="form-control" id="imagen" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<!---modal editar -->
  <div class="modal fade" id="EditUserModal" tabindex="-1" aria-labelledby="EditUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EditUserModalLabel">Editar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="./php/add.php" method="post" enctype="multipart/form-data" id="EdituserForm">
          <div class="modal-body">
            <input type="hidden" name="userid" class="form-control" id="userid">
            
              <input type="hidden" name="level" class="form-control" id="Editlevel">
              <div class="mb-3">
                <label for="username" class="form-label">Nombre de Usuario</label>
                <input type="text" name="name" class="form-control" id="Editusername" required>
              </div>
              <input type="hidden"  name="index" class="form-control" id="Editindex" value="10">
              <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="mail" class="form-control" id="Editemail" required>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
          </div>
        </form>
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
    <script src="./js/users.js"></script>
    <script>
      $(document).ready(function(){
        var idEliminar = -1;
        var fila;
        $(".btnEliminar").click(function(){
          idEliminar=$(this).data('id');
          fila=$(this).parent('td').parent('tr');
        });
        $(".eliminar").click(function(){
          $.ajax({
            url:'./php/eliminar.php',
            method:'POST',
            data:{
              id:idEliminar,
              tabla:'users',
              columna:'user_id'
            }
          }).done(function(res){
            $(fila).fadeOut(500);
          });
          
        });
      });

    </script>
    
  </body>
</html>




























