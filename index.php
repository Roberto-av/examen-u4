<?php
include 'app/config.php';
?>
<!doctype html>
<html lang="en">

<head>
  <?php include "views/layouts/head.php" ?>
  <style>
    .auth-form .card {
      min-height: auto !important;
    }

    .alert {
      transition: opacity 0.5s ease-out;
    }
  </style>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <div class="auth-main v2">
    <div class="bg-overlay bg-dark"></div>
    <div class="auth-wrapper d-flex align-items-center justify-content-center" style="min-height: 100vh;">
      <div class="auth-wrapper">
        <div class="auth-form">
          <div class="card my-3 mx-3 p-2">
            <div class="card-body">
              <h4 class="f-w-500 mb-2 text-center">Iniciar Sesión</h4>
              <?php
              if (isset($_SESSION['error_message'])) {
                echo '<div id="error-message" class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
                unset($_SESSION['error_message']);
              }
              ?>
              <form method="POST" action="auth">
                <div class="mb-2">
                  <input type="email" name="email" class="form-control" placeholder="Email Address" required />
                </div>
                <div class="mb-2">
                  <input type="password" name="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="d-grid mt-3">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <input type="hidden" name="action" value="login">
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include "views/layouts/scripts.php" ?>

  <script>
    window.onload = function() {
      const alertMessage = document.getElementById("error-message");

      if (alertMessage) {
        setTimeout(function() {
          alertMessage.style.opacity = 0;
          setTimeout(function() {
            alertMessage.style.display = "none";
          }, 500);
        }, 3000);
      }
    };
  </script>

  <?php include "views/layouts/scripts.php" ?>
</body>

</html>