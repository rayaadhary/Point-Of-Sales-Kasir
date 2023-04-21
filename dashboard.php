<?php
include_once "functions.php";
$title = "dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Putra Subur Makmur</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.css">
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<?php
include_once "./pages/layout/header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <?php flash(); ?>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!-- <ol class="breadcrumb float-sm-right"> -->
          <div class="d-flex justify-content-end mb-4 mr-3">
            <a href="<?= BASEURL ?>/dist/database/backup_database.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="backup"><i class="fas fa-download fa-sm text-white-50"></i> Backup Database</a>
          </div>
          <!-- </ol> -->
        </div>
      </div><!-- /.row -->

    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <?php
  $jumlahTransaksi = hitungTransaksi();
  $jumlahBarang = hitungBarang();
  $jumlahPelanggan = hitungPelanggan();
  $jumlahSupplier = hitungSupplier();
  $data_barang = getGroupBarang();
  $jumlah_barang = getJumlahBarang();
  $data_transaksi = getGroupTransaksi();
  $jumlah_transaksi = getJumlahTransaksi();
  ?>
  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?= $jumlahTransaksi ?></h3>
              <p>Jumlah Transaksi</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-cart"></i>
            </div>
            <a href="<?= BASEURL ?>/pages/transaksi/transaksi-list.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3><?= $jumlahBarang ?></h3>

              <p>Jumlah Barang</p>
            </div>
            <div class="icon">
              <i class="fas fa-shopping-bag"></i>
            </div>
            <a href="<?= BASEURL ?>/pages/barang/barang.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><?= $jumlahPelanggan ?></h3>
              <p>Jumlah Pelanggan</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?= BASEURL ?>/pages/pelanggan/pelanggan.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?= $jumlahSupplier ?></h3>
              <p>Jumlah Supplier</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="<?= BASEURL ?>/pages/supplier/supplier.php" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Transaksi</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="areaChart" style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                <input type="month" onchange="filterChart(this)" value="">
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<!-- <footer class="main-footer">
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b>Version</b> 3.1.0
  </div>
</footer> -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= BASEURL ?>/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= BASEURL ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?= BASEURL ?>/dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<!-- <script src="<?= BASEURL ?>/plugins/chart.js/Chart.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<script src="<?= BASEURL ?>/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= BASEURL ?>/dist/js/pages/dashboard3.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-backup.js"></script>

<!-- SweetAlert2 -->
<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>

<script>
  // setup
  const data = {
    labels: [<?php foreach ($data_transaksi as $row) {
                echo '"' . $row['tanggal_transaksi'] . '",';
              } ?>],
    datasets: [{
      label: 'Jumlah Transaksi',
      data: [
        <?php foreach ($jumlah_transaksi as $row) {
          echo '"' . $row['jumlah_transaksi'] . '",';
        } ?>
      ],
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 1
    }]
  };

  const currentYear = new Date().getFullYear();
  const minDate = `${currentYear}-01-01`;
  const maxDate = `${currentYear}-12-31`;

  const config = {
    type: 'bar',
    data,
    options: {
      scales: {
        x: {
          min: minDate,
          max: maxDate,
          type: 'time',
          time: {
            unit: 'day'
          }
        },
        y: {
          beginAtZero: true
        }
      }
    }
  };

  const myChart = new Chart(
    document.getElementById('areaChart'),
    config
  );

  function filterChart(date) {
    console.log(date.value);
    const year = date.value.substring(0, 4);
    const month = date.value.substring(5, 7);
    console.log(month);

    const lastDay = (y, m) => {
      return new Date(y, m, 0).getDate();
    }

    const startDate = `${date.value}-01`;
    const endDate = `${date.value}-${lastDay(year, month)}`;
    myChart.config.options.scales.x.min = startDate;
    myChart.config.options.scales.x.max = endDate;
    myChart.update();
  }
</script>

</body>

</html>