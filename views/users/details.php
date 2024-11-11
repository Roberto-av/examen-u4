<?php

include "../../app/config.php";
require_once "../../app/UserController.php";


$userController = new users();
$user = $userController->getUser();
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
                                <li class="breadcrumb-item"><a href="javascript: void(0)">Users</a></li>
                                <li class="breadcrumb-item" aria-current="page">Detalles de usuario</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Detalles de usuario</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-5 col-xxl-3">
                            <div class="card overflow-hidden">
                                <div class="card-body position-relative">
                                    <div class="text-center mt-3">
                                        <div class="chat-avtar d-inline-flex mx-auto">
                                            <img
                                                class="rounded-circle img-fluid wid-90 img-thumbnail"
                                                src="<?= $user->avatar ?>" alt="<?= htmlspecialchars(string: $user->name) ?>"
                                                alt="User image" />
                                            <i class="chat-badge bg-success me-2 mb-2"></i>
                                        </div>
                                        <h5 class="mb-0"><?= $user->name ?></h5>
                                        <p class="text-muted text-sm"><?= $user->role ?></p>

                                        <span class="mb-0">Creado por:</span>
                                        <p class="text-muted text-sm"><?= $user->created_by ?></p>
                                    </div>
                                </div>
                                <div
                                    class="nav flex-column nav-pills list-group list-group-flush account-pills mb-0"
                                    id="user-set-tab"
                                    role="tablist"
                                    aria-orientation="vertical">
                                    <a
                                        class="nav-link list-group-item list-group-item-action active"
                                        id="user-set-profile-tab"
                                        data-bs-toggle="pill"
                                        href="#user-set-profile"
                                        role="tab"
                                        aria-controls="user-set-profile"
                                        aria-selected="true">
                                        <span class="f-w-500"><i class="ph-duotone ph-user-circle m-r-10"></i>Detalles de perfil</span>
                                    </a>
                                    <a
                                        class="nav-link list-group-item list-group-item-action"
                                        id="user-set-information-tab"
                                        data-bs-toggle="pill"
                                        href="#user-set-information"
                                        role="tab"
                                        aria-controls="user-set-information"
                                        aria-selected="false">
                                        <span class="f-w-500"><i class="ph-duotone ph-clipboard-text m-r-10"></i>Editar Usuario</span>
                                    </a>
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
                                                            <p class="mb-0"><?= $user->name ?></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mb-1 text-muted">Apellidos</p>
                                                            <p class="mb-0"><?= $user->lastname ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="">
                                                        <p class="mb-1 text-muted">Numero de telefono</p>
                                                        <p class="mb-0"><?= $user->phone_number ?: '-' ?></p>
                                                    </div>
                                                </li>
                                                <li class="list-group-item px-0">
                                                    <div class="">
                                                        <p class="mb-1 text-muted">Email</p>
                                                        <p class="mb-0"><?= $user->email ?></p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="user-set-information" role="tabpanel" aria-labelledby="user-set-information-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Editar Usuario</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="../../user" enctype="multipart/form-data">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nombre</label>
                                                        <input type="text" class="form-control" name="name" value="<?= $user->name ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Apellidos</label>
                                                        <input type="text" class="form-control" name="lastname"  value="<?= $user->lastname ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Rol</label>
                                                        <input type="text" class="form-control" name="role"  value="<?= $user->role ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-3">
                                                        <label class="form-label">Numero de telefono</label>
                                                        <input type="text" class="form-control" name="phone_number"  value="<?= $user->phone_number ?>" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" class="form-control" name="email"  value="<?= $user->email ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="text-end btn-page">
                                    <button class="btn btn-outline-secondary">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                                </div>
                                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                                <input type="hidden" name="action" value="updateUser">
                                <input type="hidden" name="id" value="<?= $user->id ?>" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ sample-page ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>

    <?php include "../layouts/footer.php" ?>

    <?php include "../layouts/scripts.php" ?>

    <?php include "../layouts/modals.php" ?>


</body>
<!-- [Body] end -->

</html>