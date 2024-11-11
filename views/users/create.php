<?php

include "../../app/config.php";

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
                                <li class="breadcrumb-item" aria-current="page">Crear usuario</li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Crear nuevo usuario</h2>
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
                            <h5>Nuevo Usuario</h5>
                        </div>
                        <div class="card-body row">
                            <form method="POST" action="../user" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" class="form-control" name="name" placeholder="Ingrese el nombre del usuario" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="lastname" placeholder="Ingrese los apellidos del usuario" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Ingrese el email del usuario" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Numero de telefono</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Ingrese el telefono del usuario" />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Rol</label>
                                        <input type="text" class="form-control" name="role" placeholder="Ingrese el rol del usuario" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <input type="password" class="form-control" name="password" placeholder="Ingrese la contraseña del usuario" />
                                    </div>
                                </div>
                                <div class="mb-0 mt-2">
                                    <label class="form-label">Avatar</label>
                                    <input type="file" name="profile_photo_file" class="form-control" />
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
                <input type="hidden" name="created_by" value="<?= $_SESSION['user_data']->name ?>" />
                <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>" />
                <input type="hidden" name="action" value="addUser">
                </form>
                <!-- [ sample-page ] end -->
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