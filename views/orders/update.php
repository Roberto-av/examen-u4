<?php

include "../../app/config.php";
require_once "../../app/CuponsController.php";


$couponController = new cuponsController();
$coupon = $couponController->getSpecificCupon();

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
                                <li class="breadcrumb-item"><a href="<?= BASE_PATH ?>coupons/">coupon</a></li>
                                <li class="breadcrumb-item" aria-current="page">Actualizar cupón</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Actualizar cupón</h2>
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
                            <h5>Nuevo Cliente</h5>
                        </div>
                        <div class="card-body row">
                            <form class="editorden-form" method="POST" action="<?= BASE_PATH ?>coupon">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nombre del cupón</label>
                                        <input type="text" class="form-control" name="name" value="<?= $coupon->name ?>" placeholder="Ingrese el nombre del cupón" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Código del cupón</label>
                                        <input type="text" class="form-control" name="code" value="<?= $coupon->code ?>" placeholder="Ingrese el código del cupón" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Porcentaje de descuento (%)</label>
                                        <input type="number" class="form-control" name="percentage" value="<?= $coupon->percentage_discount ?>" placeholder="Ingrese el porcentaje de descuento" min="0" max="100" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Monto mínimo requerido</label>
                                        <input type="number" class="form-control" name="min_amount" value="<?= $coupon->min_amount_required ?>" placeholder="Ingrese el monto mínimo requerido" min="0" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fecha de inicio</label>
                                        <input type="date" class="form-control" name="start_date" value="<?= $coupon->start_date ?>" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Fecha de finalización</label>
                                        <input type="date" class="form-control" name="end_date" value="<?= $coupon->end_date ?>" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Cantidad mínima de productos</label>
                                        <input type="number" class="form-control" name="min_product" value="<?= $coupon->min_product_required ?>" placeholder="Ingrese la cantidad mínima de productos" min="0" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Número máximo de usos</label>
                                        <input type="number" class="form-control" name="max_uses" value="<?= $coupon->max_uses ?>" placeholder="Ingrese el número máximo de usos" min="1" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Solo válido para primera compra</label>
                                        <select class="form-control" name="valid_only_first_purchase">
                                            <option value="" disabled>Seleccione una opción</option>
                                            <option value="1" <?= $coupon->valid_only_first_purchase == 1 ? 'selected' : '' ?>>Sí</option>
                                            <option value="0" <?= $coupon->valid_only_first_purchase == 0 ? 'selected' : '' ?>>No</option>
                                        </select>
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
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                <input type="hidden" name="count" value="0">
                <input type="hidden" name="id" value="<?= $coupon->id ?>">
                <input type="hidden" name="action" value="update_cupon">
                </form>
                <!-- [ sample-page ] end -->
            </div>

        </div>
    </div>

    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>
    
    <script src="../../assets\js\validations\validations.js"  defer></script>


</body>
<!-- [Body] end -->

</html>