<?php

include "../../app/config.php";
require_once "../../app/ProductsController.php";
require_once "../../app/BrandsController.php";

$productController = new controllerProducts();
$product = $productController->getDetailProduct();

if (isset($product->brand_id) && !empty($product->brand_id)) {
  $brandController = new BrandsController();
  $_GET['id'] = $product->brand_id;
  $marca = $brandController->getSpecificBrand();
} else {
  $marca = (object) ['name' => 'Marca no disponible'];
}


?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
  <?php include "../layouts/head.php" ?>
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
                <li class="breadcrumb-item" aria-current="page">Detalle de producto</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Detalle de producto</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->


      <?php
      if (isset($_SESSION['error_message'])) {
        echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
        unset($_SESSION['error_message']);
      }
      ?>


      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="d-sm-flex align-items-center mb-4">
            <div class="list-inline ms-auto my-1">
              <div class="list-inline-item">
                <a href="<?= BASE_PATH ?>products/update/<?= $product->id ?>" class="btn btn-outline-warning d-inline-flex me-2">
                  <i class="ti ti-edit me-1"></i>Actualizar Producto
                </a>
                <button class="btn btn-outline-danger d-inline-flex" data-bs-toggle="modal" data-bs-target="#productModal">
                  <i class="ti ti-trash me-1"></i>Eliminar
                </button>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="sticky-md-top product-sticky">
                    <div id="carouselExampleCaptions" class="carousel slide ecomm-prod-slider" data-bs-ride="carousel">
                      <div class="carousel-inner bg-light rounded position-relative">
                        <div class="card-body position-absolute bottom-0 end-0">
                          <ul class="list-inline ms-auto mb-0 prod-likes">
                            <li class="list-inline-item m-0">
                              <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                <i class="ti ti-zoom-in f-18"></i>
                              </a>
                            </li>
                            <li class="list-inline-item m-0">
                              <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                <i class="ti ti-zoom-out f-18"></i>
                              </a>
                            </li>
                            <li class="list-inline-item m-0">
                              <a href="#" class="avtar avtar-xs text-white text-hover-primary">
                                <i class="ti ti-rotate-clockwise f-18"></i>
                              </a>
                            </li>
                          </ul>
                        </div>
                        <div class="carousel-item active">
                          <img src="<?= $product->cover ?>" alt="<?= htmlspecialchars(string: $product->name) ?>" class="img-prod img-fluid" />
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <h3 class="my-3"><?= $product->name ?></h3>
                  <?php if (isset($product->presentations[0]->stock) && $product->presentations[0]->stock > 0) : ?>
                    <span class="badge bg-success f-14">Con stock disponible (<?= $product->presentations[0]->stock ?>)</span>
                  <?php else : ?>
                    <span class="badge bg-danger f-14">Sin stock</span>
                  <?php endif; ?>
                  <p class="mt-4 mb-sm-3 mb-2 fs-5 f-w-300">Sobre este producto</p>
                  <p><?= $product->description ?></p>

                  <div id="categories-container" class="mb-3">
                    <p class="mb-2">Categorias</p>
                    <div class="d-flex flex-wrap gap-1">
                      <?php foreach ($product->categories as $category) : ?>
                        <a href="#" class="text-decoration-none">
                          <span class="badge rounded-pill text-bg-secondary"><?= htmlspecialchars($category->name) ?></span>
                        </a>
                      <?php endforeach; ?>
                    </div>
                  </div>

                  <div id="categories-container" class="mb-3">
                    <p class="mb-2">Tags</p>
                    <div class="d-flex flex-wrap gap-1">
                      <?php foreach ($product->tags as $tag) : ?>
                        <a href="#" class="text-decoration-none">
                          <span class="badge rounded-pill text-bg-dark"><?= htmlspecialchars($tag->name) ?></span>
                        </a>
                      <?php endforeach; ?>
                    </div>
                  </div>


                  <?php if (!empty($product->presentations[0]->price)) : ?>
                    <h3 class="mb-4">
                      <b>$<?= number_format($product->presentations[0]->price[0]->amount, 2) ?>
                    </h3>
                  <?php endif; ?>

                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header pb-0">
              <ul class="nav nav-tabs profile-tabs mb-0" id="myTab" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="ecomtab-tab-1"
                    data-bs-toggle="tab"
                    href="#ecomtab-1"
                    role="tab"
                    aria-controls="ecomtab-1"
                    aria-selected="true">Características
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane show active" id="ecomtab-1" role="tabpanel" aria-labelledby="ecomtab-tab-1">
                  <div class="table-responsive">
                    <table class="table table-borderless mb-0">
                      <tbody>
                        <tr>
                          <td class="text-muted py-1">Marca :</td>
                          <td class="py-1"><?= $marca->name ?></td>
                        </tr>
                        <tr>
                          <td class="text-muted py-1">Tags :</td>
                          <td class="py-1">
                            <?php
                            if (isset($product->tags) && !empty($product->tags)) :
                              $tags = array_map(function ($tag) {
                                return htmlspecialchars($tag->name);
                              }, $product->tags);

                              echo implode(' | ', $tags);
                            else :
                              echo 'No disponible';
                            endif;
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-muted py-1">Categorias :</td>
                          <td class="py-1">
                            <?php
                            if (isset($product->categories) && !empty($product->categories)) :
                              $categories = array_map(function ($category) {
                                return htmlspecialchars($category->name);
                              }, $product->categories);

                              echo implode(' | ', $categories);
                            else :
                              echo 'No disponible';
                            endif;
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="text-muted py-1">Peso :</td>
                          <td class="py-1"><?= isset($product->presentations[0]->weight_in_grams) ? $product->presentations[0]->weight_in_grams . ' g' : 'No disponible' ?></td>
                        </tr>
                        <tr>
                          <td class="text-muted py-1">Codigo :</td>
                          <td class="py-1"><?= isset($product->presentations[0]->code) ? $product->presentations[0]->code : 'No disponible' ?></td>
                        </tr>
                        <tr>
                          <td class="text-muted py-1">Status :</td>
                          <td class="py-1"><?= isset($product->presentations[0]->status) ? $product->presentations[0]->status : 'No disponible' ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <h5>Presentaciones</h5>
              <h3 class="mt-4 mb-sm-3 mb-2 f-18">Descripción</h3>
              <p>Reemplaza tu antigua estufa por una elegante y moderna, elige esta de piso de la marca Whirlpool, la cual tiene un tamaño de 30</p>
              <div id="categories-container" class="d-flex flex-wrap gap-1 mb-3">
                <p>peso : 100g</p>
              </div>
            </div>
            <div class="card-body table-border-style">
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Last Name</th>
                      <th>Username</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Larry</td>
                      <td>the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>
  <!-- [ Main Content ] end -->

  <!-- Modal personalizado -->
  <div id="productModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Producto</h5>
        </div>
        <div class="modal-body">
          <p>¿Seguro que deseas eliminar el producto?</p>
        </div>
        <div class="modal-footer">
          <form method="POST" action="../../product">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
            <input type="hidden" name="action" value="delete_product">
              <input type="hidden" name="id_product" value="<?= $product->id ?>" />
          </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <?php include "../layouts/footer.php" ?>

  <?php include "../layouts/scripts.php" ?>

  <?php include "../layouts/modals.php" ?>
</body>

</html>