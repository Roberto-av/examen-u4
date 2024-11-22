<?php

include "../../app/config.php";
require_once "../../app/CuponsController.php";

$couponController = new cuponsController();
$coupons = $couponController->getAllCupons();

$title = "Lista de cupones";
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
                                <li class="breadcrumb-item" aria-current="page">Lista de cupones</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de cupones</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="d-flex justify-content-end my-3">
                        <a href="<?= BASE_PATH ?>coupons/create" class="btn btn-outline-primary d-inline-flex">
                            <i class="ti ti-new-section me-1"></i>Añadir cupón
                        </a>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h5>Cupones</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Código</th>
                                            <th>Porcentaje de descuento</th>
                                            <th>Monto fijo</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($coupons) && count($coupons)): ?>
                                            <?php foreach ($coupons as $coupon): ?>
                                                <tr>
                                                    <td><a href="<?= BASE_PATH ?>coupons/details/<?= $coupon->id ?>"><?= $coupon->name ?></a></td>
                                                    <td><?= $coupon->code ?></td>
                                                    <td><?= $coupon->percentage_discount ?>%</td>
                                                    <td>$<?= $coupon->amount_discount ?: "0" ?></td>
                                                    <td>
                                                        <a href="<?= BASE_PATH ?>coupons/update/<?= $coupon->id ?>" type="button" class="btn btn-icon btn-warning">
                                                            <i class=" ti ti-pencil"></i>
                                                        </a>

                                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCoupon" onclick="setCouponIdToDelete(<?= $coupon->id ?>)">
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
                                            <th>Código</th>
                                            <th>Porcentaje de descuento</th>
                                            <th>Monto fijo</th>
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

    <div id="deleteCoupon" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Cupón</h5>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar el cupón?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="<?= BASE_PATH ?>coupon">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="delete_cupon">
                        <input type="hidden" id="coupon-id-input" name="id" value="" />
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
                    [4, "asc"]
                ],
                "scrollX": true,
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

        function setCouponIdToDelete(couponId) {
            document.getElementById('coupon-id-input').value = couponId;
        }
    </script>

    <?php include "../layouts/footer.php" ?>
    <?php include "../layouts/scripts.php" ?>
    <?php include "../layouts/modals.php" ?>

</body>
<!-- [Body] end -->

</html>