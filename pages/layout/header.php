<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= BASEURL ?>/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= BASEURL ?>/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="<?= BASEURL ?>/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= BASEURL ?>/logout.php" class="nav-link logout" role="button"><i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= BASEURL ?>/dist/img/logo_psm.jpeg" alt="Logo PSM" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">Putra Subur Makmur</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <!-- <img src="<?= BASEURL ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            <i class="fas fa-user-circle fa-2x" style="color: #fff;"></i>
          </div>
          <div class="info">
            <a class="d-block"><?= $_SESSION['nama']; ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?= BASEURL ?>/dashboard.php" class="nav-link <?= ($title == 'dashboard') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASEURL ?>/pages/barang/barang.php" class="nav-link <?= ($title == 'barang') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-box"></i>
                <p>
                  Barang
                </p>
              </a>
            </li>
            <li class="nav-item <?= ($menu == 'barang_masuk') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= ($menu == 'barang_masuk') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-boxes"></i>
                <p>
                  Barang Masuk
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= BASEURL ?>/pages/barang-masuk/barang-masuk.php" class="nav-link <?= ($title == 'barang_masuk') ? 'active' : '' ?>">
                    <i class=" far fa-circle nav-icon"></i>
                    <p>Barang Masuk</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= BASEURL ?>/pages/barang-masuk/barang-masuk-utang.php" class="nav-link <?= ($title == 'barang_masuk_utang') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Barang Masuk Utang</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item <?= ($menu == 'transaksi') ? 'menu-open' : '' ?>">
              <a href="#" class="nav-link <?= ($menu == 'transaksi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-shopping-cart"></i>
                <p>
                  Transaksi
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="<?= BASEURL ?>/pages/transaksi/transaksi-list.php" class="nav-link <?= ($title == 'transaksi_list') ? 'active' : '' ?>">
                    <i class=" far fa-circle nav-icon"></i>
                    <p>Daftar Transaksi</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= BASEURL ?>/pages/transaksi/transaksi.php" class="nav-link <?= ($title == 'transaksi_tambah') ? 'active' : '' ?>">
                    <i class=" far fa-circle nav-icon"></i>
                    <p>Transaksi Tambah</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="<?= BASEURL ?>/pages/transaksi/transaksi-utang.php" class="nav-link <?= ($title == 'transaksi_utang') ? 'active' : '' ?>">
                    <i class=" far fa-circle nav-icon"></i>
                    <p>Transaksi Utang</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="<?= BASEURL ?>/pages/beban/beban.php" class="nav-link <?= ($title == 'beban') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-balance-scale-right"></i>
                <p>
                  Beban
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASEURL ?>/pages/pelanggan/pelanggan.php" class="nav-link <?= ($title == 'pelanggan') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Pelanggan
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASEURL ?>/pages/prive/prive.php" class="nav-link <?= ($title == 'prive') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                  Prive
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASEURL ?>/pages/supplier/supplier.php" class="nav-link <?= ($title == 'supplier') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-shipping-fast"></i>
                <p>
                  Supplier
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= BASEURL ?>/pages/cashflow/cashflow.php" class="nav-link <?= ($title == 'cashflow') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-search-dollar"></i>
                <p>
                  Cashflow
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>