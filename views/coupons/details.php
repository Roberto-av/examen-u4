<?php

include "../../app/config.php";
require_once "../../app/CuponsController.php";


$couponController = new cuponsController();
$coupon = $couponController->getSpecificCupon();

$totalDescontado = 0;

foreach ($coupon->orders as $order) {
    if ($order->is_paid == 1) { 
        if (isset($coupon->percentage_discount) && $coupon->percentage_discount > 0) {
            $descuentoAplicado = ($coupon->percentage_discount / 100) * $order->total;
        } elseif (isset($coupon->amount_discount) && $coupon->amount_discount > 0) {
            $descuentoAplicado = min($coupon->amount_discount, $order->total);
        } else {
            $descuentoAplicado = 0;
        }
        $totalDescontado += $descuentoAplicado;
    }
}

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
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>coupons/">Coupons</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de cupón</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de cupón</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="col-md-4 col-sm-12">
                        <div class="card statistics-card-1 overflow-hidden bg-brand-color-3">
                            <div class="card-body">
                                <img src="<?= BASE_PATH ?>assets/images/widget/img-status-6.svg" alt="img" class="img-fluid img-bg" />
                                <h5 class="mb-4 text-white">Total descontado</h5>
                                <div class="d-flex align-items-center mt-3">
                                    <h3 class="text-white f-w-300 d-flex align-items-center m-b-0">$<?= number_format($totalDescontado, 2) ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Detalles</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 pt-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Nombre</p>
                                            <p class="mb-0"><?= $coupon->name ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">codigo</p>
                                            <span class="badge bg-success"><?= $coupon->code ?></span>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Porcentaje de descuento</p>
                                            <p class="mb-0"><?= $coupon->percentage_discount ?>%</p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Monto fijo</p>
                                            <p class="mb-0">$<?= $coupon->amount_discount ?: '0' ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Monto minimo</p>
                                            <p class="mb-0"><?= $coupon->min_amount_required ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Productos minimos</p>
                                            <p class="mb-0"><?= $coupon->min_product_required ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Fecha inicial</p>
                                            <p class="mb-0"><?= $coupon->start_date ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Fecha de finalización</p>
                                            <p class="mb-0"><?= $coupon->end_date ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Usuarios maximos</p>
                                            <p class="mb-0"><?= $coupon->max_uses ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Total de usos</p>
                                            <p class="mb-0"><?= $coupon->count_uses ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Status</p>
                                            <?php if ($coupon->status == 1): ?>
                                                <span class="badge bg-success">Activo</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">No activo</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">valido solo en la primer compra</p>
                                            <?php if ($coupon->valid_only_first_purchase == 1): ?>
                                                Si
                                            <?php else: ?>
                                                No
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Órdenes</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($coupon->orders as $order): ?>
                                            <tr>
                                                <td><?= $order->folio ?></td>
                                                <td>$<?= number_format($order->total, 2) ?></td>
                                                <td>
                                                    <?php if ($order->is_paid == 1): ?>
                                                        Pagado
                                                    <?php else: ?>
                                                        No pagado
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_PATH ?>orders/details/<?= $order->id ?>" class="btn btn-primary btn-sm">Ver</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
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
                "pageLength": 5,
                "lengthMenu": [5, 10, 25, 50],
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
    </script>

    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>


</body>
<!-- [Body] end -->

</html>