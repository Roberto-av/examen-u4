<?php

include "../../app/config.php";
require_once "../../app/ClientController.php";


$clienController = new client();
$client = $clienController->getSpecificClient();

$title = isset($client->name) ? $client->name . " | Actualizar" : "Actualizar cliente";
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
                                <li class="breadcrumb-item" aria-current="page">Actualizar cliente</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Actualizar cliente</h2>
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
                            <form class="editClient-form" method="POST" action="<?= BASE_PATH ?>client" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" value="<?= $client->name ?>" placeholder="Ingrese el nombre del usuario" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" value="<?= $client->email ?>" placeholder="Ingrese el email del usuario" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Numero de telefono</label>
                                        <input type="text" class="form-control" name="phone_number" value="<?= $client->phone_number ?>" placeholder="Ingrese el telefono del usuario" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Suscripción</label>
                                        <select class="form-control" name="suscribed">
                                            <option value="" disabled>Seleccione una opción</option>
                                            <option value="1" <?= $client->is_suscribed == 1 ? 'selected' : '' ?>>Sí</option>
                                            <option value="0" <?= $client->is_suscribed == 0 ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Ingrese una nueva contraseña" />
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-end btn-page">
                            <button type="reset" class="btn btn-outline-secondary mb-0">Vaciar datos</button>
                            <button type="submit" class="btn btn-primary mb-0">Guardar usuario</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="level_id" value="<?= $client->level_id ?>">
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                <input type="hidden" name="id" value="<?= $client->id ?>">
                <input type="hidden" name="action" value="updateClient">
                </form>
                <!-- [ sample-page ] end -->
            </div>

        </div>
    </div>

    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>

    <script src="../assets\js\validations\validations.js"  defer></script>


</body>
<!-- [Body] end -->

</html>