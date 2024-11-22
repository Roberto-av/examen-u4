<?php

include "../../app/config.php";
require_once "../../app/OrdersController.php";

$orderController = new ordersController();
$orders = $orderController->getAllOrders();

$title = "Lista de ordenes";
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
                                <li class="breadcrumb-item" aria-current="page">Lista de ordenes</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de ordenes</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Ordenes</h5>
                        </div>
                        <div class="card-body">
                            <div class="dt-responsive table-responsive">
                                <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                                    <thead>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Método de pago</th>
                                            <th>Dirección</th>
                                            <th>Cupón</th>
                                            <th>Status</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($orders) && count($orders)): ?>
                                            <?php foreach ($orders as $order): ?>
                                                <tr>
                                                    <td><a href="<?= BASE_PATH ?>orders/details/<?= $order->id ?>"><?= $order->folio ?></a></td>
                                                    <td>
                                                        <?php if (isset($order->client)): ?>
                                                            <a href="<?= BASE_PATH ?>clients/details/<?= $order->client->id ?>"><?= htmlspecialchars($order->client->name) ?></a>
                                                        <?php else: ?>
                                                            <span>Cliente no disponible</span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>$<?= number_format($order->total, 2) ?></td>
                                                    <td><?= $order->payment_type->name ?></td>
                                                    <td style="white-space: normal; word-break: break-word; max-width: 150px;">
                                                        <?= $order->address->street_and_use_number ?>,
                                                        <?= $order->address->city ?>,
                                                        <?= $order->address->province ?>,
                                                        <?= $order->address->postal_code ?>
                                                    </td>
                                                    <td>
                                                        <?php if (isset($order->coupon)): ?>
                                                            <a href="<?= BASE_PATH ?>coupons/details/<?= $order->coupon->id ?>"><?= $order->coupon->name ?></a>
                                                        <?php else: ?>
                                                            Sin cupón
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $order->order_status->name ?></td>
                                                    <td>
                                                        <button
                                                            type="button"
                                                            class="btn btn-icon btn-warning"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#updateOrderStatus"
                                                            onclick="setOrderStatus(<?= $order->id ?>, <?= $order->order_status_id ?>)">
                                                            <i class="ti ti-pencil"></i>
                                                        </button>

                                                        <button type="button" class="btn btn-icon btn-danger" data-bs-toggle="modal" data-bs-target="#deleteOrder" onclick="setCouponIdToDelete(<?= $order->id ?>)">
                                                            <i class="ti ti-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Folio</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Dirección</th>
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
        </div>
    </div>

    <div id="updateOrderStatus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateOrderStatusTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateOrderStatusTitle">Actualizar Estado de la Orden</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?= BASE_PATH ?>order">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="order-status-select" class="form-label">Status de Orden</label>
                            <select class="form-control" name="order_status_id" id="order-status-select" required>
                                <option value="" disabled>Seleccione una opción</option>
                                <option value="1">Pendiente de pago</option>
                                <option value="2">Pagada</option>
                                <option value="3">Enviada</option>
                                <option value="4">Abandonada</option>
                                <option value="5">Pendiente de enviar</option>
                                <option value="6">Cancelada</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="update_order">
                        <input type="hidden" id="order-id-input" name="id" value="" />
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="deleteOrder" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Orden</h5>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar la ordern?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="<?= BASE_PATH ?>order">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="delete_order">
                        <input type="hidden" id="coupon-id-input" name="id_order" value="" />
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

        function setOrderStatus(orderId, currentStatusId) {
            document.getElementById('order-id-input').value = orderId;

            const statusSelect = document.getElementById('order-status-select');
            if (statusSelect) {
                statusSelect.value = currentStatusId;
            }
        }
    </script>

    <?php include "../layouts/footer.php" ?>
    <?php include "../layouts/scripts.php" ?>
    <?php include "../layouts/modals.php" ?>

</body>
<!-- [Body] end -->

</html>