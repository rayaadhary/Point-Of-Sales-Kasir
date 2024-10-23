<?php
include_once "../../functions.php";
$menu = 'transaksi';
$title = 'transaksi_list';
if (!isset($_SESSION["id_pengguna"]))
  header(
    "Location: " . BASEURL
  );
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
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
  <script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>

  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<?php
include_once "../layout/header.php"
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <?php flash(); ?>
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Transaksi</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">DataTable with default features</h3> -->
              <!-- <a href="barang-tambah.php"><button type="button" class="btn btn-primary rounded">Tambah</button></a> -->
              <!-- Button trigger modal -->
              <a href="<?= BASEURL ?>/pages/transaksi/transaksi.php" class="btn btn-primary" type="button">Tambah</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No Faktur</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>JatuhTempo</th>
                    <th>Potongan</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
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
    </div>
    <!-- /.container-fluid -->
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
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Sweetalert -->
<script src="<?= BASEURL ?>/dist/js/pages/js-hapus.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>

<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "getDaftarTransaksi.php", // Ensure this URL is correct
            datatype: "json",
        },
        "columns": [
            { "data": "no_faktur" },   // Column for no_faktur
            { "data": "nama_pelanggan" },   // Column for no_faktur
            { "data": "tanggal" },      // Column for tanggal
            { "data": "jatuh_tempo" },  // Column for jatuh_tempo
            { "data": "diskon" },       // Column for diskon
            { "data": "total" },        // Column for total
            { "data": "bayar" },        // Column for bayar
            { "data": "kembali" },      // Column for kembali
            { "data": "status" },       // Column for status
            { "data": "actions" }       // Column for action buttons
        ],
        "order": [
            [0, 'desc'] // Order by the first column (no_faktur)
        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json' // Indonesian language support
        }
    });
});
</script>

</body>

</html>