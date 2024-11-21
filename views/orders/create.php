<?php
include "../../app/config.php";
require_once "../../app/ClientController.php";
require_once "../../app/CuponsController.php";
require_once "../../app/PresentationsController.php";

$clientController = new client();
$clients = $clientController->getAllClients();

$couponController = new cuponsController();
$coupons = $couponController->getAllCupons();

$presentationController = new controllerPresentations();
$presentations = $presentationController->getPresentationsProducts();

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
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>orders/">Orders</a></li>
                                <li class="breadcrumb-item" aria-current="page">Crear orden</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Crear nueva orden</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Nuevo Orden</h5>
                        </div>
                        <div class="card-body row">
                            <form class="createorden-form" method="POST" action="<?= BASE_PATH ?>order">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Folio</label>
                                        <input type="text" class="form-control" id="folio" name="folio" placeholder="Ingrese el folio de la orden" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Total</label>
                                        <input type="text" class="form-control" name="total" placeholder="Ingrese el código del cupón" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cliente</label>
                                        <select class="form-control" name="client_id" id="client_id" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <?php if (isset($clients) && count($clients)): ?>
                                                <?php foreach ($clients as $client): ?>
                                                    <option value="<?= $client->id ?>"><?= $client->name ?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status de order</label>
                                        <select class="form-control" name="order_status_id" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="1">Pediente de pago</option>
                                            <option value="2">Pagada</option>
                                            <option value="3">Enviada</option>
                                            <option value="4">Abandonada</option>
                                            <option value="5">Pendiente de enviar</option>
                                            <option value="6">Cancelada</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tipo de pago</label>
                                        <select class="form-control" name="payment_type_id" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <option value="1">Efectivo</option>
                                            <option value="2">Tarjeta</option>
                                            <option value="3">Transferencia</option>
                                        </select>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cupon</label>
                                        <select class="form-control" name="cupon_id" id="cupon_id" required>
                                            <option value="" selected disabled>Seleccione una opción</option>
                                            <?php if (isset($coupons) && count($coupons)): ?>
                                                <?php foreach ($coupons as $coupon): ?>
                                                    <option value="<?= $coupon->id ?>"><?= $coupon->name ?></option>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Seleccionar presentaciones</label>
                                        <div id="presentations-container">
                                            <div class="presentation-item">
                                                <select class="form-control" name="presentations[0][id]" required>
                                                    <option value="" selected disabled>Seleccione una presentación</option>
                                                    <?php if (isset($presentations) && count($presentations)): ?>
                                                        <?php foreach ($presentations as $presentation): ?>
                                                            <option value="<?= $presentation->id ?>"><?= $presentation->description ?></option>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </select>
                                                <input type="number" class="form-control mt-2" name="presentations[0][quantity]" placeholder="Cantidad" required />
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-outline-primary mt-2" id="add-presentation">Agregar otra presentación</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-end btn-page">
                            <button type="reset" class="btn btn-outline-secondary mb-0">Vaciar datos</button>
                            <button type="submit" class="btn btn-primary mb-0">Guardar cupón</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="is_paid" value="1">
                <input type="hidden" name="address_id" value="1">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                <input type="hidden" name="action" value="add_order">
                </form>
                <!-- [ sample-page ] end -->
            </div>

        </div>
    </div>
    <script>
    document.getElementById('add-presentation').addEventListener('click', function() {
        var container = document.getElementById('presentations-container');
        var index = container.getElementsByClassName('presentation-item').length;
        
        var newItem = document.createElement('div');
        newItem.classList.add('presentation-item');

        newItem.innerHTML = `
            <select class="form-control mt-2" name="presentations[${index}][id]" required>
                <option value="" selected disabled>Seleccione una presentación</option>
                <?php if (isset($presentations) && count($presentations)): ?>
                    <?php foreach ($presentations as $presentation): ?>
                        <option value="<?= $presentation->id ?>"><?= $presentation->description ?></option>
                    <?php endforeach ?>
                <?php endif ?>
            </select>
            <input type="number" class="form-control mt-2" name="presentations[${index}][quantity]" placeholder="Cantidad" required />
        `;
        
        container.appendChild(newItem);
    });

    document.addEventListener("DOMContentLoaded", function () {
        
        function generarFolio() {
            return Math.floor(100000000 + Math.random() * 900000000).toString();
        }
        var folioInput = document.getElementById("folio");
        if (folioInput) {
            folioInput.value = generarFolio();
        }
    });



</script>


    <?php include "../layouts/footer.php" ?>
    <?php include "../layouts/scripts.php" ?>
    <?php include "../layouts/modals.php" ?>
    <script src="../../assets\js\validations\validations.js"  defer></script>


</body>
<!-- [Body] end -->

</html>