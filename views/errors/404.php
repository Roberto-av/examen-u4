<?php
include __DIR__ . '/../../app/config.php';
?>
<!doctype html>
<html lang="en">
  <!-- [Head] start -->

  <head>
    <title>Error | 404</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <?php include "../layouts/head.php" ?>


  </head>
  <!-- [Body] Start -->

  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
      <div class="loader-track">
        <div class="loader-fill"></div>
      </div>
    </div>
    <!-- [ Pre-loader ] End -->

    <div class="auth-main v1">
      <div class="auth-wrapper">
        <div class="auth-form">
          <div class="error-card">
            <div class="card-body">
              <div class="error-image-block">
                <img class="img-fluid" src="<?= BASE_PATH ?>assets/images/pages/img-error-404.png" alt="img" />
              </div>
              <div class="text-center">
                <h1 class="mt-2">Oops! Something Went wrong</h1>
                <p class="mt-2 mb-4 text-muted f-20">We couldn’t find the page you were looking for. Why not try back to the Homepage.</p>
                <a class="btn btn-primary d-inline-flex align-items-center mb-3" href="<?= BASE_PATH ?>home"
                  ><i class="ph-duotone ph-house me-2"></i> Regresar</a
                >
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <?php include __DIR__ . '/../layouts/scripts.php'; ?>

  </body>
  <!-- [Body] end -->
</html>
