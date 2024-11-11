<?php
include "../../app/config.php";
require_once "../../app/ProductsController.php";

$productController = new controllerProducts();
$products = $productController->getProducts();

?>
<!doctype html>
<html lang="en">

<head>
  <?php include "../layouts/head.php" ?>
  <style>
    .product-card {
      width: 100%;
      height: 400px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .img-prod {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-body {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
  </style>
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
                <?php foreach ($products as $product) : ?>
                  <div class="col-sm-6 col-xl-3">
                    <div class="card product-card">
                      <div class="card-img-top">
                        <a href="<?= BASE_PATH ?>products/details/<?= $product->id ?>">
                          <img src="<?= $product->cover ?>" alt="<?= htmlspecialchars($product->name) ?>" class="img-prod img-fluid" />
                        </a>
                      </div>
                      <div class="card-body">
                        <a href="<?= BASE_PATH ?>products/details/<?= $product->id ?>">
                          <p class="prod-content mb-0 text-muted"><?= htmlspecialchars($product->name) ?></p>
                        </a>
                        <div class="d-flex align-items-center justify-content-between mt-2 mb-2 flex-wrap gap-1">
                          <?php if (!empty($product->presentations[0]->price)) : ?>
                            <h4 class="mb-0 text-truncate">
                              <b>$<?= number_format($product->presentations[0]->price[0]->amount, 2) ?></b>
                            </h4>
                          <?php endif; ?>
                        </div>

                        <div class="d-flex flex-wrap gap-1 mb-3">
                          <?php foreach ($product->tags as $tag) : ?>
                            <a href="#" class="text-decoration-none">
                              <span class="badge rounded-pill text-bg-info"><?= htmlspecialchars($tag->name) ?></span>
                            </a>
                          <?php endforeach; ?>
                        </div>

                        <div class="d-flex">
                          <div class="flex-grow-1">
                            <div class="d-grid">
                              <a href="<?= BASE_PATH ?>products/details/<?= $product->id ?>" class="btn btn-link-secondary btn-prod-card">Ver detalles</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
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