<?php

include "../../app/config.php";
require_once "../../app/ClientController.php";


$clientController = new client();
$clients = $clientController->getAllClients();
?>
<!doctype html>
<html lang="en">
<!-- [Head] start -->

<head>
    <?php include "../layouts/head.php" ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" />
    <style>
        .table-hover tbody tr:hover .badge {
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
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
                                <li class="breadcrumb-item" aria-current="page">Lista de clientes</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de clientes</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12">
                    <div class="d-sm-flex align-items-center mb-4">
                        <div class="list-inline ms-auto my-1">
                            <div class="list-inline-item">
                                <a href="<?= BASE_PATH ?>clients/create" class="btn btn-outline-primary d-inline-flex">
                                    <i class="ti ti-new-section me-1"></i>Añadir cliente
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card border-0 table-card user-profile-list">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="pc-dt-simple">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Teléfono</th>
                                            <th>Suscrito</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clients as $client) : ?>
                                            <tr onclick="window.location.href='<?= BASE_PATH ?>clients/details/<?= $client->id ?>'">
                                                <td>
                                                    <div class="d-inline-block align-middle">
                                                        <img
                                                            src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg"
                                                            alt="user image"
                                                            class="img-radius align-top m-r-15"
                                                            style="width: 40px" />
                                                        <div class="d-inline-block">
                                                            <div style="display: flex; align-items: center;">
                                                                <h6 class="m-b-0" style="margin-right: 10px;"><?= $client->name ?></h6>
                                                                <!-- Badge para mostrar el nivel de cliente -->
                                                                <span class="badge bg-light-primary"><?= $client->level->name ?></span>
                                                            </div>
                                                            <p class="m-b-0 text-primary"><?= $client->email ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $client->phone_number ?></td>
                                                <td>
                                                    <?php if ($client->is_suscribed == 1): ?>
                                                        <span class="badge bg-light-success">Suscrito</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-light-secondary">No suscrito</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="<?= BASE_PATH ?>clients/update/<?= $client->id ?>" class="btn btn-icon btn-warning">
                                                        <i class=" ti ti-pencil"></i>
                                                    </a>

                                                    <button class="btn btn-icon btn-danger d-inline-flex" data-bs-toggle="modal" data-bs-target="#userDelete" onclick="event.stopPropagation(); setUserIdToDelete(<?= $client->id ?>)">
                                                        <i class="ti ti-trash me-1"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>

        </div>
    </div>
    <div id="userDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Cliente</h5>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar el cliente?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="<?= BASE_PATH ?>client">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="deleteClient">
                        <input type="hidden" id="user-id-input" name="id_client" value="" />
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= BASE_PATH ?>assets/js/plugins/simple-datatables.js"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable('#pc-dt-simple', {
            sortable: false,
            perPage: 5
        });

        function setUserIdToDelete(userId) {
            document.getElementById('user-id-input').value = userId;
        }
    </script>

    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>


</body>
<!-- [Body] end -->

</html>