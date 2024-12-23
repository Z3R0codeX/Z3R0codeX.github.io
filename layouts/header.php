<nav class="px-4 py-4 navbar navbar-expand-lg" style="background-color: #ff4c61; width: 100%;">
  <div class="container-fluid">
    <h1 class="h2"><?php echo ($title) ?></h1>
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
            class="btn bg-warning position-relative"
          >
            <i class="bi bi-bell"></i>
            <span
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
            >
              5
              <span class="visually-hidden">unread messages</span>
            </span>
          </button>
        </li>
        <img
                      src="./img/R.png"
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
            <?php
            $user=$_SESSION['userdata'];
            echo $user['nombre'];
            ?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Perfil</a></li>
            <li>
              <hr class="dropdown-divider" />
            </li>
            <li> <a href="./php/logout.php" class="dropdown-item">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
