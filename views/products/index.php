<?php

include "../../app/config.php";

?>
<!doctype html>
<html lang="en">

<head>
  <?php include "../layouts/head.php" ?>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->
  <?php include "../layouts/sidebar.php" ?>
  <?php include "../layouts/navbar.php" ?>

  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>home">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Productos</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Products</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->


      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-sm-12">
          <div class="ecom-wrapper">
            <div class="offcanvas-xxl offcanvas-start ecom-offcanvas" tabindex="-1" id="offcanvas_mail_filter">
              <div class="offcanvas-body p-0 sticky-xxl-top">
              </div>
            </div>
            <div class="ecom-content">
              <div class="d-sm-flex align-items-center mb-4">
                <div class="list-inline ms-auto my-1">
                  <div class="list-inline-item">
                    <a href="<?= BASE_PATH ?>products/create" class="btn btn-outline-primary d-inline-flex">
                      <i class="ti ti-new-section me-1"></i>Añadir producto
                    </a>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-sm-6 col-xl-4">
                  <div class="card product-card">
                    <div class="card-img-top">
                      <a href="<?= BASE_PATH ?>products/details/1">
                        <img src="<?= BASE_PATH ?>assets/images/application/img-prod-1.jpg" alt="image" class="img-prod img-fluid" />
                      </a>
                    </div>
                    <div class="card-body">
                      <a href="#">
                        <p class="prod-content mb-0 text-muted">Apple watch -4</p>
                      </a>
                      <div class="d-flex align-items-center justify-content-between mt-2 mb-2 flex-wrap gap-1">
                        <h4 class="mb-0 text-truncate"><b>$299.00</b> <span class="text-sm text-muted f-w-400 text-decoration-line-through">$399.00</span></h4>
                      </div>

                      <div class="d-flex flex-wrap gap-1 mb-3">
                        <a href="#" class="text-decoration-none">
                          <span class="badge rounded-pill text-bg-info">celular</span>
                        </a>
                        <a href="#" class="text-decoration-none">
                          <span class="badge rounded-pill text-bg-info">apple</span>
                        </a>
                        <a href="#" class="text-decoration-none">
                          <span class="badge rounded-pill text-bg-info">sdasdasd</span>
                        </a>
                      </div>

                      <div class="d-flex">
                        <div class="flex-grow-1">
                          <div class="d-grid">
                            <a href="<?= BASE_PATH ?>products/details/1" class="btn btn-link-secondary btn-prod-card">Ver detalles</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <?php include "../layouts/footer.php" ?>

  <?php include "../layouts/scripts.php" ?>

  <?php include "../layouts/modals.php" ?>
</body>

</html>