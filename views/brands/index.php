<?php

include "../../app/config.php";
require_once "../../app/BrandsController.php";

$brandController = new BrandsController();
$brands = $brandController->getAllBrands();
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
                                <li class="breadcrumb-item" aria-current="page">Lista de marcas</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de marcas</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-end my-3">
                        <button class="btn btn-outline-primary d-inline-flex" data-bs-toggle="modal" data-bs-target="#addBrand">
                            <i class="ti ti-new-section me-1"></i>Añadir marca
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Marcas</h5>
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
                                        <?php if (isset($brands) && count($brands)): ?>
                                            <?php foreach ($brands as $brand): ?>
                                                <tr>
                                                    <td><?= $brand->name ?></td>
                                                    <td><?= $brand->slug ?></td>
                                                    <td><?= $brand->description ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-icon btn-warning" data-bs-toggle="modal" data-bs-target="#editBrand" onclick='uploadBrand(this)' data-brand='<?php echo htmlspecialchars(json_encode($brand)); ?>'>
                                                            <i class=" ti ti-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBrand" onclick="setBrandIdToDelete(<?= $brand->id ?>)">
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

    <div id="addBrand" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandLabel">Añadir Nueva Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= BASE_PATH ?>brand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="brandName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="brandName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="brandSlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="brandSlug" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label for="brandDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="brandDescription" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="add_brand">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editBrand" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editBrandLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBrandLabel">Editar Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= BASE_PATH ?>brand">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editBrandName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="editBrandName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBrandSlug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="editBrandSlug" name="slug" required>
                        </div>
                        <div class="mb-3">
                            <label for="editBrandDescription" class="form-label">Descripción</label>
                            <textarea class="form-control" id="editBrandDescription" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="update_brand">
                        <input type="hidden" id="editBrandId" name="id" value="" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="deleteBrand" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Marca</h5>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar la marca?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="<?= BASE_PATH ?>brand">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="delete_brand">
                        <input type="hidden" id="brand-id-input" name="id" value="" />
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

        function uploadBrand(button) {
            let brand = JSON.parse(button.dataset.brand);

            document.getElementById("editBrandId").value = brand.id;
            document.getElementById("editBrandName").value = brand.name;
            document.getElementById("editBrandSlug").value = brand.slug;
            document.getElementById("editBrandDescription").value = brand.description;
        }

        function setBrandIdToDelete(brandId) {
            document.getElementById('brand-id-input').value = brandId;
        }
    </script>


    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>


</body>
<!-- [Body] end -->

</html>
