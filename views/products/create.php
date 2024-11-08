<?php

include "../../app/config.php";

?>
<!doctype html>
<html lang="en">

<head>
  <?php include "../layouts/head.php" ?>
</head>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
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
                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>products">Productos</a></li>
                <li class="breadcrumb-item" aria-current="page">Nuevo producto</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0 mt-2">Agregar un nuevo producto</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->

      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h5>Nuevo Producto</h5>
            </div>
            <div class="card-body row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" class="form-control" placeholder="Enter Product Name" />
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">slug</label>
                <input type="text" class="form-control" placeholder="Enter Product Name" />
              </div>
              <div class="mb-3">
                <label class="form-label">Marca</label>
                <select class="form-select">
                  <option>Nike</option>
                  <option>Category 1</option>
                  <option>Category 2</option>
                  <option>Category 3</option>
                  <option>Category 4</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Categorias</label>
                <select class="form-select">
                  <option>Sneakers</option>
                  <option>Category 1</option>
                  <option>Category 2</option>
                  <option>Category 3</option>
                  <option>Category 4</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Tags</label>
                <select class="form-select">
                  <option>Hogar</option>
                  <option>Category 1</option>
                  <option>Category 2</option>
                  <option>Category 3</option>
                  <option>Category 4</option>
                </select>
              </div>
              <div class="mb-0">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" placeholder="Enter Product Description"></textarea>
              </div>
              <div class="mb-0 mt-2">
                <label class="form-label">features</label>
                <textarea class="form-control" placeholder="Enter Product Description"></textarea>
              </div>
              <div class="mb-0 card-body">
                <label class="form-label">Subir imagen</label>
                <form action="<?= BASE_PATH ?>assets/json/file-upload.php" class="dropzone" id="my-dropzone" enctype="multipart/form-data">
                  <div class="dz-default dz-message">
                    <button class="dz-button" type="button">Suelta la imagene aqui</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body text-end btn-page">
              <button class="btn btn-primary mb-0">Save product</button>
              <button class="btn btn-outline-secondary mb-0">Reset</button>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <?php include "../layouts/footer.php" ?>

  <?php include "../layouts/scripts.php" ?>

  <?php include "../layouts/modals.php" ?>
</body>

</html>