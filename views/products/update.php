<?php
include "../../app/config.php";
require_once "../../app/BrandsController.php";
require_once "../../app/TagsController.php";
require_once "../../app/CategoriesController.php";
require_once "../../app/ProductsController.php";

$brandController = new BrandsController();
$marcas = $brandController->getAllBrands();

$productController = new controllerProducts();
$product = $productController->getDetailProduct();

$tagController = new tagsCrontoller();
$tags = $tagController->getAllTags();

$categoryController = new categoriesController();
$categories = $categoryController->getAllCategories();

$title = isset($product->name) ? $product->name . " | Actualizar" : "Acualizar producto";
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
                <li class="breadcrumb-item" aria-current="page">Actualizar producto</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0 mt-2">Actualizar Producto</h2>
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
              <h5>Detalles Producto</h5>
            </div>
            <div class="card-body row">

              <form class="editProduct-form" method="POST" action="../../product" enctype="multipart/form-data">

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="name" value="<?= $product->name ?>" placeholder="Ingrese el nombre del producto" />
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Slug</label>
                    <input type="text" class="form-control" name="slug" value="<?= $product->slug ?>" placeholder="Ingrese el slug del producto" />
                  </div>
                </div>
                <div class="mb-3">
                  <label for="brand" class="form-label">Marcas</label>
                  <select id="brand" class="form-select" name="id_brand">
                    <option value="" selected disabled>Seleccione una marca</option>
                    <?php if (isset($marcas) && count($marcas)): ?>
                      <?php foreach ($marcas as $marca_option): ?>
                        <option value="<?= $marca_option->id ?>"
                          <?php if (isset($product->brand_id) && $product->brand_id == $marca_option->id): ?>selected<?php endif; ?>>
                          <?= $marca_option->name ?>
                        </option>
                      <?php endforeach ?>
                    <?php endif ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="categories-multiple-select" class="form-label">Categorías</label>
                  <select id="categories-multiple-select" name="categories[]" class="form-select" multiple>
                    <?php if (isset($categories) && count($categories)): ?>
                      <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id ?>"
                          <?php if (isset($product->categories) && in_array($category->id, array_column($product->categories, 'id'))): ?>selected<?php endif; ?>>
                          <?= $category->name ?>
                        </option>
                      <?php endforeach ?>
                    <?php endif ?>
                  </select>
                </div>

                <div class="mb-3">
                  <label class="form-label">Tags</label>
                  <select id="tags-multiple-select" name="tags[]" class="form-control" multiple>
                    <?php if (isset($tags) && count($tags)): ?>
                      <?php foreach ($tags as $tag): ?>
                        <option value="<?= $tag->id ?>"
                          <?php if (isset($product->tags) && in_array($tag->id, array_column($product->tags, 'id'))): ?>selected<?php endif; ?>>
                          <?= $tag->name ?>
                        </option>
                      <?php endforeach ?>
                    <?php endif ?>
                  </select>
                </div>
                <div class="mb-0">
                  <label class="form-label">Descripción</label>
                  <textarea class="form-control" name="description" placeholder="Ingrese la descripción del producto"><?= htmlspecialchars($product->description) ?></textarea>
                </div>
                <div class="mb-0 mt-2">
                  <label class="form-label">Características</label>
                  <textarea class="form-control" name="features" placeholder="Ingrese las características del producto"><?= htmlspecialchars($product->features) ?></textarea>
                </div>
                <div class="mb-0 mt-2">
                  <label class="form-label">Subir imagen</label>
                  <input type="file" name="cover" class="form-control" accept="image/*" />
                </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body text-end btn-page">
              <button type="reset" class="btn btn-outline-secondary mb-0">Vaciar datos</button>
              <button type="submit" class="btn btn-primary mb-0">Guardar producto</button>
            </div>
          </div>
        </div>
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
        <input type="hidden" name="action" value="update_product">
        <input type="hidden" name="id" value="<?= $product->id ?>" />
        </form>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const categoriesSelect = document.getElementById('categories-multiple-select');
      new Choices(categoriesSelect, {
        removeItemButton: true,
        placeholderValue: 'Selecciona las categorías',
        searchPlaceholderValue: 'Buscar categoría',
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      const tagsSelect = document.getElementById('tags-multiple-select');
      new Choices(tagsSelect, {
        removeItemButton: true,
        placeholderValue: 'Selecciona los tags',
        searchPlaceholderValue: 'Buscar tag',
      });
    });
  </script>

  <?php include "../layouts/footer.php" ?>

  <?php include "../layouts/scripts.php" ?>

  <?php include "../layouts/modals.php" ?>
  
   <script src="../../assets\js\validations\validations.js"  defer></script>
</body>

</html>