<?php

include "../../app/config.php";
require_once "../../app/OrdersController.php";

$orderController = new ordersController();
$order = $orderController->getSpecificOrder();

$title = isset($order->folio) ? $order->folio . " | Detalles" : "Detalles de orden";
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
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>orders/">orders</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de orden</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de orden</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <h5>Detalles</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 pt-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Folio</p>
                                            <p class="mb-0"><?= $order->folio ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Cupon</p>
                                            <?php if (isset($order->coupon)): ?>
                                                <span class="badge bg-light-success"><?= $order->coupon->name ?></span>
                                            <?php else: ?>
                                                <span class="badge bg-light-dark">Sin cupón</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Cliente</p>
                                            <?php if (isset($order->client)): ?>
                                                <p class="mb-0"><?= $order->client->name ?></p>
                                            <?php else: ?>
                                                <p class="mb-0">Cliente no disponible</p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-1 text-muted">Direccion</p>
                                            <p class="mb-0"><?= $order->address->street_and_use_number ?>,
                                                <?= $order->address->city ?>,
                                                <?= $order->address->province ?>,
                                                <?= $order->address->postal_code ?></p>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item px-0">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Total</p>
                                            <p class="mb-0">$<?= number_format($order->total, 2) ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Estatus de orden</p>
                                            <p class="mb-0"><?= $order->order_status->name ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Tipo de pago</p>
                                            <p class="mb-0"><?= $order->payment_type->name ?></p>
                                        </div>
                                        <div class="col-md-3">
                                            <p class="mb-1 text-muted">Pagado</p>
                                            <p class="mb-0"><?= $order->is_paid == 1 ? "Si" : "No" ?></p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5>Presentaciones de producto</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Nombre</th>
                                            <th>Codigo</th>
                                            <th>Precio</th>
                                            <th>Peso</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($order->presentations as $presentation): ?>
                                            <tr>
                                                <td><?= $presentation->id ?></td>
                                                <td style="white-space: normal; word-break: break-word; max-width: 150px;">
                                                    <?= $presentation->description ?>
                                                </td>
                                                <td><?= $presentation->code ?></td>
                                                <td>$<?= number_format($presentation->current_price->amount, 2) ?></td>
                                                <td><?= $presentation->weight_in_grams ?>g</td>
                                                <td>
                                                    <a href="<?= BASE_PATH ?>products/details/<?= $presentation->product_id ?>" class="btn btn-primary btn-sm">
                                                        Ver producto
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>CÓDIGO</th>
                                            <th>PRECIO</th>
                                            <th>PESO</th>
                                            <th>ACCIONES</th>
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
    </script>

    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>


</body>
<!-- [Body] end -->

</html>