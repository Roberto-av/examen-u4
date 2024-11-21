<?php

include "../app/config.php";
require_once "../app/ProductsController.php";
require_once "../app/ClientController.php";
require_once "../app/OrdersController.php";

$productController = new controllerProducts();
$products = $productController->getProducts();

$clientController = new client();
$clients = $clientController->getAllClients();

$orderController = new ordersController();
$orders = $orderController->getAllOrders();

$totalProducts = count($products);
$totalClients = count($clients);
$totalOrders = count($orders);
?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
  <?php include "layouts/head.php" ?>
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>

  <!-- [ Pre-loader ] End -->
  <?php include "layouts/sidebar.php" ?>
  <?php include "layouts/navbar.php" ?>
  <!-- [ Main Content ] start -->

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
                <li class="breadcrumb-item"><a href="javascript: void(0)">Dashboard</a></li>
                <li class="breadcrumb-item" aria-current="page">Home</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Bienvenido</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <div class="col-md-4 col-sm-6">
          <div class="card statistics-card-1 overflow-hidden">
            <div class="card-body">
              <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
              <h5 class="mb-4">Total de producos</h5>
              <div class="d-flex align-items-center mt-3">
                <h3 class="f-w-300 d-flex align-items-center m-b-0"><?= $totalProducts ?></h3>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card statistics-card-1 overflow-hidden">
            <div class="card-body">
              <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
              <h5 class="mb-4">Total de clientes</h5>
              <div class="d-flex align-items-center mt-3">
                <h3 class="f-w-300 d-flex align-items-center m-b-0"><?= $totalClients ?></h3>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 col-sm-6">
          <div class="card statistics-card-1 overflow-hidden">
            <div class="card-body">
              <img src="<?= BASE_PATH ?>assets/images/widget/img-status-4.svg" alt="img" class="img-fluid img-bg" />
              <h5 class="mb-4">Total de ordenes</h5>
              <div class="d-flex align-items-center mt-3">
                <h3 class="f-w-300 d-flex align-items-center m-b-0"><?= $totalOrders ?></h3>
              </div>
            </div>
          </div>
        </div>


      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php include "layouts/footer.php" ?>
  <?php include "layouts/scripts.php" ?>
  <?php include "layouts/modals.php" ?>
</body>

</html>