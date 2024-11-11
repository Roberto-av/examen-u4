<?php

include "../../app/config.php";
require_once "../../app/UserController.php";


$userController = new users();
$users = $userController->getAllUsers();
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
                                <li class="breadcrumb-item" aria-current="page">Lista de usuarios</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Lista de usuarios</h2>
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
                                <a href="<?= BASE_PATH ?>users/create" class="btn btn-outline-primary d-inline-flex">
                                    <i class="ti ti-new-section me-1"></i>Añadir usuario
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
                                            <th>Apellidos</th>
                                            <th>email</th>
                                            <th>Numero de telefono</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <?php foreach ($users as $user) : ?>
                                        <tbody>
                                            <tr onclick="window.location.href='<?= BASE_PATH ?>users/details/<?= $user->id ?>'">

                                                <td>
                                                    <div class="d-inline-block align-middle">
                                                        <img
                                                            src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg"
                                                            alt="user image"
                                                            class="img-radius align-top m-r-15"
                                                            style="width: 40px" />
                                                        <div class="d-inline-block">
                                                            <h6 class="m-b-0"><?= $user->name ?></h6>
                                                            <p class="m-b-0 text-primary"><?= $user->role ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $user->lastname ?></td>
                                                <td><?= $user->email ?></td>
                                                <td><?= $user->phone_number ?></td>
                                                <td>
                                                    <div class="list-inline-item">
                                                        <button class="btn btn-outline-danger d-inline-flex" data-bs-toggle="modal" data-bs-target="#userDelete" onclick="event.stopPropagation(); setUserIdToDelete(<?= $user->id ?>)">
                                                            <i class="ti ti-trash me-1"></i>Eliminar
                                                        </button>
                                                    </div>
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Eliminar Usuario</h5>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar el usuario?</p>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="../user">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                        <input type="hidden" name="action" value="deleteUser">
                        <input type="hidden" id="user-id-input" name="id_user" value="" />
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
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