<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
  <div class="navbar-wrapper">
    <div class="m-header">
      <a href="../dashboard/index.html" class="b-brand text-primary">
        <img src="<?= BASE_PATH ?>assets/images/logo-dark.svg" alt="logo image" class="logo-lg" />
      </a>
    </div>
    <div class="navbar-content">
      <ul class="pc-navbar">
        <li class="pc-item pc-caption">
          <label>
            Navigation
          </label>
          <i class="ph-duotone ph-gauge"></i>
        </li>
        <li class="pc-item">
          <a href="<?= BASE_PATH ?>home" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-gauge"></i>
            </span>
            <span class="pc-mtext">
              Dashboard
            </span>
          </a>
        </li>
        <li class="pc-item pc-caption">
          <label>Widget</label>
          <i class="ph-duotone ph-chart-pie"></i>
        </li>
        <li class="pc-item">
          <a href="<?= BASE_PATH ?>products/" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-shopping-bag-open"></i>
            </span>
            <span class="pc-mtext">
              Productos
            </span>
          </a>
        </li>
        <li class="pc-item">
          <a href="<?= BASE_PATH ?>users/" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-user-circle"></i>
            </span>
            <span class="pc-mtext">Users</span>
          </a>
        </li>
        <li class="pc-item">
          <a href="<?= BASE_PATH ?>clients/" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-user-circle"></i>
            </span>
            <span class="pc-mtext">Clientes</span>
          </a>
        </li>
        <li class="pc-item pc-hasmenu">
          <a href="#!" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-stack"></i>
            </span>
            <span class="pc-mtext">Catálogos</span><span class="pc-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg></span></a>
          <ul class="pc-submenu" style="display: none;">
            <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>categories/">Categorías</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>brands/">Marcas</a></li>
            <li class="pc-item"><a class="pc-link" href="<?= BASE_PATH ?>tags/">Etiquetas</a></li>
          </ul>
        </li>
        <li class="pc-item">
          <a href="<?= BASE_PATH ?>coupons/" class="pc-link">
            <span class="pc-micon">
              <i class="ph-duotone ph-gift"></i>
            </span>
            <span class="pc-mtext">Cupones</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="card pc-user-card">
      <div class="card-body">
        <div class="d-flex align-items-center">
          <div class="flex-shrink-0">
            <img src="<?= BASE_PATH ?>assets/images/user/avatar-1.jpg" alt="user-image" class="user-avtar wid-45 rounded-circle" />
          </div>
          <div class="flex-grow-1 ms-3">
            <div class="dropdown">
              <a href="#" class="arrow-none dropdown-toggle">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 me-2">
                    <h6 class="mb-0">Roberto Antonio</h6>
                    <small>Administrator</small>
                  </div>
                  <div class="flex-shrink-0">
                    <div class="btn btn-icon btn-link-secondary avtar">
                      <i class="ph-duotone ph-windows-logo"></i>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>