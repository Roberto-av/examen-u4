<?php

include "../../app/config.php";
require_once "../../app/ClientController.php";


$clienController = new client();
$client = $clienController->getSpecificClient();

$totalCompras = 0;
foreach ($client->orders as $order) {
    if ($order->order_status_id == 2 || $order->order_status_id == 3 || $order->order_status_id == 5) {
        $totalCompras++;
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
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>clients/">Clients</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de cliente</h2>
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
                                <h5 class="mb-4 text-white">Total de compras</h5>
                                <div class="d-flex align-items-center mt-3">
                                    <h3 class="text-white f-w-300 d-flex align-items-center m-b-0"><?= $totalCompras ?></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-xxl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body position-relative">
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <img
                                                class="rounded-circle img-fluid wid-90 img-thumbnail"
                                                src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg"
                                                alt="User image" />
                                            <i class="chat-badge bg-success me-2 mb-2"></i>
                                        </div>
                                        <h5 class="mb-0"><?= $client->name ?></h5>
                                        <span class="badge bg-primary mt-1 mb-1"><?= $client->level->name ?></span>
                                        <p class="text-muted text-sm"><?= $client->level->percentage_discount ?>% de descuento</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 col-xxl-9">
                            <div class="tab-content" id="user-set-tabContent">
                                <div class="tab-pane fade show active" id="user-set-profile" role="tabpanel" aria-labelledby="user-set-profile-tab">
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
                                                            <p class="mb-0"><?= $client->name ?></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <?php if ($client->is_suscribed == 1): ?>
                                                                <span class="badge bg-success">Suscrito</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary">No suscrito</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="">
                                                        <p class="mb-1 text-muted">Numero de telefono</p>
                                                        <p class="mb-0"><?= $client->phone_number ?: '-' ?></p>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="">
                                                        <p class="mb-1 text-muted">Email</p>
                                                        <p class="mb-0"><?= $client->email ?></p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
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
                                                    <th>Estado</th>
                                                    <th>Método de pago</th>
                                                    <th>Dirección</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($client->orders as $order): ?>
                                                    <tr>
                                                        <td><?= $order->folio ?></td>
                                                        <td>$<?= number_format($order->total, 2) ?></td>
                                                        <td><?= $order->order_status->name ?></td>
                                                        <td><?= $order->payment_type->name ?></td>
                                                        <td style="white-space: normal; word-break: break-word; max-width: 150px;">
                                                            <?= $order->address->street_and_use_number ?>,
                                                            <?= $order->address->city ?>,
                                                            <?= $order->address->province ?>,
                                                            <?= $order->address->postal_code ?>
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
                                                    <th>Estado</th>
                                                    <th>Método de pago</th>
                                                    <th>Dirección</th>
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