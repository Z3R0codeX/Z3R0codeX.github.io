<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Petpedia - Sign Up</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/styles.css" />
    <link rel="stylesheet" href="./css/mediaQuerys.css" />
  </head>
  <body>
    <div class="container">
      <div class="signup-form">
        <h2>Sign Up</h2>
        <div class="social-icons">
          <a href="#"><img src="./img/Frame.png" alt="Facebook" /></a>
          <a href="#"><img src="./img/Frame2.png" alt="Google" /></a>
          <a href="#"><img src="./img/Frame3.png" alt="LinkedIn" /></a>
        </div>
        <form action="sign.php" method="POST">
    <div class="input-group">
      <span class="material-icons">person</span>
      <input type="text" id="username" name="username" placeholder="Username" required />
    </div>
    <div class="input-group">
      <span class="material-icons">email</span>
      <input type="email" id="email" name="email" placeholder="Email" required />
    </div>
    <div class="input-group">
      <span class="material-icons">lock</span>
      <input type="password" id="password" name="password" placeholder="Password" required />
    </div>
    <button type="submit" class="signup-btn">Sign Up</button>
  </form>
        <p>Already have an account? <a href="./login.php">Sign In</a></p>
      </div>
      <div class="side-image">
        <div class="logo">
          <img src="./img/iconmonstr-cat-7-240.png" alt="Petpedia Logo" />
          <h2 class="brand-name">Petpedia</h2>
        </div>
        <img class="dog" src="./img/Dog paw-pana.svg" alt="Dog Illustration" />
      </div>
    </div>

    <?php
  // Mostrar alerta si hay error
  if (isset($error)) {
      echo "
      <script>
        Swal.fire({
          icon: 'error',
          title: 'ERROR',
          text: '$error'
        });
      </script>
      ";
  }
  ?>

  </body>
</html>
