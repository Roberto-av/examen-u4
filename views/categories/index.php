<?php

include "../../app/config.php";
require_once "../../app/CategoriesController.php";

$categoryController = new categoriesController();
$categories = $categoryController->getAllCategories();
?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->

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
                                <li class="breadcrumb-item" aria-current="page">Lista de categorías</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de categorías</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-end my-3">
                        <button class="btn btn-outline-primary d-inline-flex" data-bs-toggle="modal" data-bs-target="#addCategory">
                            <i class="ti ti-new-section me-1"></i>Añadir categoría
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Categorías</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>slug</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($categories) && count($categories)): ?>
                                            <?php foreach ($categories as $category): ?>
                                                <tr>
                                                    <td><?= $category->name ?></td>
                                                    <td><?= $category->slug ?></td>
                                                    <td><?= $category->description ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#editCategory" onclick='uploadCategory(this)' data-category='<?php echo htmlspecialchars(json_encode($category)); ?>'>
                                                            <i class=" ti ti-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCategory" onclick="setCategoryIdToDelete(<?= $category->id ?>)">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>slug</th>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="addCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Añadir Nueva Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="newcategory-form" method="POST" action="<?= BASE_PATH ?>category"  novalidate>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="categorySlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="categorySlug" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label for="categoryDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="categoryDescription" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="add_categories">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryLabel">Editar Categoría</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="edit-categoryform"method="POST" action="<?= BASE_PATH ?>category">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editCategoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategorySlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="editCategorySlug" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label for="editCategoryDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editCategoryDescription" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="update_category">
                        <input type="hidden" id="editCategoryId" name="id" value="" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Usuario</h5>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar la categoría?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="<?= BASE_PATH ?>category">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" id="category-id-input" name="id" value="" />
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/dataTables.min.js"></script>
    <script src="<?= BASE_PATH ?>assets/js/plugins/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dom-jqry').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "order": [
                    [3, "asc"]
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_ entradas por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    "infoEmpty": "No hay entradas disponibles",
                    "infoFiltered": "(filtrado de _MAX_ entradas en total)",
                    "search": "Buscar:"
                }
            });
        });

        function uploadCategory(button) {
            let category = JSON.parse(button.dataset.category);

            document.getElementById("editCategoryId").value = category.id;
            document.getElementById("editCategoryName").value = category.name;
            document.getElementById("editCategorySlug").value = category.slug;
            document.getElementById("editCategoryDescription").value = category.description;
        }

        function setCategoryIdToDelete(categoryId) {
            document.getElementById('category-id-input').value = categoryId;
        }
    </script>


    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>

    <script src="../assets\js\validations\validations.js"  defer></script>


</body>
<!-- [Body] end -->

</html>