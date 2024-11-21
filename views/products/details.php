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
  <style>
    .clic-cursor {
      cursor: pointer;
    }
  </style>
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
                  
                  <div class="col-6">
                    <div class="d-grid">
                      <a href="<?= BASE_PATH ?>orders/create/<?= $product->id ?>" type="button" class="btn btn-primary">Hacer orden</a>
                    </div>
                  </div>

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
            <div class="card-header d-flex justify-content-between align-items-center">
              <h5>Presentaciones</h5>
              <div>
                <button class="btn btn-outline-primary d-inline-flex" data-bs-toggle="modal" data-bs-target="#addPresentation">
                  <i class="ti ti-new-section me-1"></i>Añadir presentación
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="dt-responsive">
                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                  <thead>
                    <tr>
                      <th>id</th>
                      <th>Descripción</th>
                      <th>Codigo</th>
                      <th>Precio</th>
                      <th>Stock</th>
                      <th>Min. Stock</th>
                      <th>Max. Stock</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($product->presentations as $presentation): ?>
                      <tr id="presentation-<?= $presentation->id ?>" class="clic-cursor presentation-row" data-presentation-id="<?= $presentation->id ?>" onclick="toggleOrders(<?= $presentation->id ?>)">
                        <td><?= $presentation->id ?></td>
                        <td style="white-space: normal; word-break: break-word; max-width: 150px;">
                          <?= $presentation->description ?>
                        </td>
                        <td><?= $presentation->code ?></td>
                        <td>$<?= number_format($presentation->price[0]->amount, 2) ?></td>
                        <td><?= $presentation->stock ?></td>
                        <td><?= $presentation->stock_min ?></td>
                        <td><?= $presentation->stock_max ?></td>
                        <td>
                          <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#editPresentation" onclick='event.stopPropagation(); editPresentation(this)' data-presentation='<?php echo htmlspecialchars(json_encode($presentation)); ?>'>
                            <i class="ti ti-pencil"></i>
                          </button>
                          <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deletePresentation" onclick="event.stopPropagation(); setPresentationIdToDelete(<?= $presentation->id ?>)">
                            <i class="ti ti-trash"></i>
                          </button>
                        </td>
                      </tr>

                      <!-- Fila de órdenes asociadas a esta presentación (inicialmente oculta) -->
                      <tr id="orders-row-<?= $presentation->id ?>" class="orders-row" style="display: none;">
                        <td colspan="8">
                          <!-- Aquí se mostrarán las órdenes relacionadas a la presentación -->
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Folio</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Acciones</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if (!empty($presentation->orders)): ?>
                                <?php foreach ($presentation->orders as $order): ?>
                                  <tr>
                                    <td><?= $order->folio ?></td>
                                    <td>$<?= number_format($order->total, 2) ?></td>
                                    <td><?= $order->is_paid == 1 ? "Pagado" : "No pagado" ?></td>
                                    <td>
                                      <a href="<?= BASE_PATH ?>orders/details/<?= $order->id ?>" class="btn btn-primary btn-sm">
                                        Ver
                                      </a>
                                    </td>
                                  </tr>
                                <?php endforeach; ?>
                              <?php else: ?>
                                <tr>
                                  <td colspan="4">No hay órdenes para esta presentación.</td>
                                </tr>
                              <?php endif; ?>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>DESCRIPCIÓN</th>
                      <th>CÓDIGO</th>
                      <th>PESO</th>
                      <th>STOCK</th>
                      <th>MIN. STOCK</th>
                      <th>MAX. STOCK</th>
                      <th>ACCIONES</th>
                    </tr>
                  </tfoot>
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

  <div id="addPresentation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addPresentationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPresentationLabel">Agregar Presentación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="presentacion-form" method="POST" action="<?= BASE_PATH ?>presentation" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="row">
              <!-- Primera fila -->
              <div class="col-md-6 mb-3">
                <label for="description_add" class="form-label">Descripción</label>
                <textarea class="form-control" id="description_add" name="description" rows="3" required></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label for="code_add" class="form-label">Código</label>
                <input type="text" class="form-control" id="code_add" name="code" required>
              </div>
            </div>

            <!-- Segunda fila -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="weight_add" class="form-label">Peso</label>
                <input type="number" class="form-control" id="weight_add" name="weight" step="0.01" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="amount_add" class="form-label">Precio</label>
                <input type="number" class="form-control" id="amount_add" name="amount" step="0.01" required>
              </div>
            </div>

            <!-- Tercera fila -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="status_add" class="form-label">Estado</label>
                <select class="form-control" id="status_add" name="status" required>
                  <option value="activo">Activo</option>
                  <option value="inactivo">Inactivo</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label for="stock_add" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock_add" name="stock" required>
              </div>
            </div>

            <!-- Cuarta fila -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="stockMin_add" class="form-label">Stock Mínimo</label>
                <input type="number" class="form-control" id="stockMin_add" name="stock_min" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="stockMax_add" class="form-label">Stock Máximo</label>
                <input type="number" class="form-control" id="stockMax_add" name="stock_max" required>
              </div>
            </div>

            <!-- Quinta fila -->
            <div class="row">
              <div class="col-md-12 mb-3">
                <label for="cover_add" class="form-label">Imagen</label>
                <input type="file" class="form-control" id="cover_add" name="cover" required>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
          <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
          <input type="hidden" id="product_id_add" name="product_id" value="<?= $product->id ?>">
          <input type="hidden" name="action" value="add_presentation">
        </form>
      </div>
    </div>
  </div>




  <div id="editPresentation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editPresentationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPresentationLabel">Editar Presentación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form  method="POST" action="<?= BASE_PATH ?>presentation">
          <div class="modal-body">
            <div class="mb-3">
              <label for="description_edit" class="form-label">Descripción</label>
              <textarea class="form-control" id="description_edit" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="code_edit" class="form-label">Código</label>
              <input type="text" class="form-control" id="code_edit" name="code" required>
            </div>
            <div class="mb-3">
              <label for="weight_edit" class="form-label">Peso</label>
              <input type="number" class="form-control" id="weight_edit" name="weight" step="0.01" required>
            </div>
            <div class="mb-3">
              <label for="amount_edit" class="form-label">Precio</label>
              <input type="number" class="form-control" id="amount_edit" name="amount" step="0.01" required>
            </div>
            <div class="mb-3">
              <label for="status_edit" class="form-label">Estado</label>
              <select class="form-control" id="status_edit" name="status" required>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="stock_edit" class="form-label">Stock</label>
              <input type="number" class="form-control" id="stock_edit" name="stock" required>
            </div>
            <div class="mb-3">
              <label for="stockMin_edit" class="form-label">Stock Mínimo</label>
              <input type="number" class="form-control" id="stockMin_edit" name="stock_min" required>
            </div>
            <div class="mb-3">
              <label for="stockMax_edit" class="form-label">Stock Máximo</label>
              <input type="number" class="form-control" id="stockMax_edit" name="stock_max" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
          <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
          <input type="hidden" id="presentation_id_edit" name="presentation_id" value="">
          <input type="hidden" id="product_id_edit" name="product_id" value="">
          <input type="hidden" name="action" value="update_presentation">
        </form>
      </div>
    </div>
  </div>



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

  <div id="deletePresentation" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Presentación</h5>
        </div>
        <div class="modal-body">
          <p>¿Seguro que deseas eliminar la presentación?</p>
        </div>
        <div class="modal-footer">
          <form method="POST" action="<?= BASE_PATH ?>presentation">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
            <input type="hidden" name="action" value="delete_presentation">
            <input type="hidden" id="product_id" name="id" value="<?= $product->id ?>" />
            <input type="hidden" id="presentation-id-input" name="id_presentation" value="" />
          </form>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function editPresentation(button) {
      let presentation = JSON.parse(button.dataset.presentation);

      document.getElementById('product_id_edit').value = presentation.product_id;
      document.getElementById('presentation_id_edit').value = presentation.id;
      document.getElementById('description_edit').value = presentation.description;
      document.getElementById('code_edit').value = presentation.code;
      document.getElementById('weight_edit').value = presentation.weight_in_grams;
      document.getElementById('status_edit').value = presentation.status;
      document.getElementById('stock_edit').value = presentation.stock;
      document.getElementById('stockMin_edit').value = presentation.stock_min;
      document.getElementById('stockMax_edit').value = presentation.stock_max;
      document.getElementById('amount_edit').value = presentation.price[0].amount;
    }

    function setPresentationIdToDelete(presentationId) {
      document.getElementById('presentation-id-input').value = presentationId;
    }

    function toggleOrders(presentationId) {
      const ordersRow = document.getElementById(`orders-row-${presentationId}`);

      if (ordersRow.style.display === "none") {
        ordersRow.style.display = "table-row";
      } else {
        ordersRow.style.display = "none";
      }
    }
  </script>


  <?php include "../layouts/footer.php" ?>

  <?php include "../layouts/scripts.php" ?>

  <?php include "../layouts/modals.php" ?>
</body>

</html>