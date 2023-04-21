<?php
include_once "../../functions.php";
$title = 'cashflow';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Putra Subur Makmur</title>


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<?php
include_once "../layout/header.php";
$totalTransaksi = getTotalTransaksi();
$totalBarangMasuk = getTotalBarangMasuk();
$totalBeban = getTotalBeban();
$totalPrive = getTotalPrive();

$keuntungan = $totalTransaksi - $totalBarangMasuk - $totalBeban - $totalPrive;

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cashflow</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row mb-4">
            <div class="col-md-3">
              <div class="text-center">
                <label for="total-transaksi">Total Penjualan</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalTransaksi, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_transaksi" id="total-transaksi" readonly />
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <label for="total-pembelian">Total Pembelian</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalBarangMasuk, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_transaksi" id="total-transaksi" readonly />
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <label for="total-beban">Beban Usaha</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalBeban, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_beban" id="total-beban" readonly />
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <label for="total-prive">Total Prive</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalPrive, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_prive" id="total-prive" readonly />
            </div>
          </div>
          <div class="text-center">
            <label for="total-keuntungan">Total Keuntungan</label>
            <div class="d-flex justify-content-center">
              <div class="col-md-3">
                <input type="text" class="form-control" value="Rp. <?= number_format($keuntungan, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_keuntungan" id="total-keuntungan" readonly />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Transaksi</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered dataTable">
              <thead>
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Tanggal</th>
                  <th>Penjualan</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <!-- <th style="width: 40px">Label</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $data = getAllTransaksi();
                foreach ($data as $item) {
                ?>
                  <tr>
                    <td><?= $item['tanggal'] ?></td>
                    <td>Rp. <?= number_format($item['total'], 0, ',', '.') ?></td>
                    <td><?= $item['jumlahBanyak'] ?></td>
                    <td><?= $item['nama_pelanggan'] ?></td>
                  </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Beban</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered dataTable">
              <thead>
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Tanggal</th>
                  <th>Beban</th>
                  <th>Keterangan</th>
                  <!-- <th style="width: 40px">Label</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $data = getAllBeban();
                foreach ($data as $item) {
                ?>
                  <tr>
                    <td><?= $item['tanggal'] ?></td>
                    <td>Rp. <?= number_format($item['biaya'], 0, ',', '.') ?></td>
                    <td><?= $item['nama_beban'] ?></td>
                  </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Barang Masuk</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered dataTable">
              <thead>
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Tanggal</th>
                  <th>Pembelian</th>
                  <th>Jumlah</th>
                  <th>Keterangan</th>
                  <!-- <th style="width: 40px">Label</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $data = getAllBarangMasuk();
                foreach ($data as $item) {
                ?>
                  <tr>
                    <td><?= $item['tanggal_beli'] ?></td>
                    <td>Rp. <?= number_format($item['total'], 0, ',', '.') ?></td>
                    <td><?= $item['jumlahBanyak'] ?></td>
                    <td><?= $item['nama_supplier'] ?></td>
                  </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Prive</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered dataTable">
              <thead>
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Tanggal</th>
                  <th>Prive</th>
                  <th>Keterangan</th>
                  <!-- <th style="width: 40px">Label</th> -->
                </tr>
              </thead>
              <tbody>
                <?php
                $data = getAllPrive();
                foreach ($data as $item) {
                ?>
                  <tr>
                    <td><?= $item['tanggal'] ?></td>
                    <td>Rp. <?= number_format($item['biaya'], 0, ',', '.') ?></td>
                    <td><?= $item['nama_prive'] ?></td>
                  </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- <footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer> -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>
<!-- SweetAlert2 -->
<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script>
  $(function() {
    $(".dataTable").DataTable({
      "responsive": true,
      "autoWidth": false,
      "order": [
        [0, "desc"]
      ],
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
      },
      "pageLength": 5,
      "lengthChange": false,
      "info": false
    });
  });
</script>
</body>

</html>