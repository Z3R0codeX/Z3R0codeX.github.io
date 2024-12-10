<?php
if(isset($_GET['error'])){
  $error = $_GET['error'];
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Petpedia - Sign In</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./css/sinupStyles.css" />
    <link rel="stylesheet" href="./css/mediaQuerys.css" />
  </head>
  <body>
    <div class="container">
      <div class="side-image">
        <div class="logo">
          <img src="./img/iconmonstr-cat-7-240.png" alt="Petpedia Logo" />
          <h2 class="brand-name">Petpedia</h2>
        </div>
        <img
          class="cat-family"
          src="./img/cat family-pana.svg"
          alt="Cat Family Illustration"
        />
      </div>

      <div class="sign-in-section">
        <h2>Sign In</h2>
        <div class="social-media">
          <a href="#"><img src="./img/Frame.png" alt="Facebook" /></a>
          <a href="#"><img src="./img/Frame2.png" alt="Google" /></a>
          <a href="#"><img src="./img/Frame3.png" alt="LinkedIn" /></a>
        </div>

        <form action="./php/login.php" method="post">
          <div class="input-group">
            <span class="material-icons">email</span>
            <input
              name="txtUser"
              id="user"
              type="email"
              placeholder="Email"
              required
            />
          </div>
          <div class="input-group">
            <span class="material-icons">lock</span>
            <input
              name="txtPass"
              id="pass"
              type="password"
              placeholder="Password"
              required
            />
          </div>
          <a href="#" class="forgot-password">Forgot your password?</a>
          <button id="login-btn" class="btn" type="submit">Sign In</button>
        </form>
        <p>Don’t have an account? <a href="./sign.php">Sign Up</a></p>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if(isset($error)){
    ?>
    <script>
      Swal.fire({
          icon: "error",
          title: "ERROR",
          text: "Credenciales incorrectas",
});
    </script>

<?php } ?>

  </body>
</html>





















