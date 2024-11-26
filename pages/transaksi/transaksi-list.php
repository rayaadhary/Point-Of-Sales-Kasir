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
  <link rel="stylesheet" href="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.css">
  <script src="../../dist/jquery/jquery-3.6.3.min.js"></script>
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="../../dist/jquery/moment.js"></script>
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
              <div class="d-flex justify-content-between align-items-center">
                <!-- Tombol Tambah -->
                <a href="<?= BASEURL ?>/pages/transaksi/transaksi.php" class="btn btn-primary" type="button">Tambah</a>

                <form method="GET" action="" class="form-inline">
                  <div class="form-group mr-2">
                    <label for="filter_tanggal_awal" class="mr-2">Tanggal Awal:</label>
                    <input type="date" name="filter_tanggal_awal" id="filter_tanggal_awal" class="form-control"
                      value="<?= isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '' ?>" required>
                  </div>
                  <div class="form-group mr-2">
                    <label for="filter_tanggal_akhir" class="mr-2">Tanggal Akhir:</label>
                    <input type="date" name="filter_tanggal_akhir" id="filter_tanggal_akhir" class="form-control"
                      value="<?= isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '' ?>" required>
                  </div>
                  <button type="submit" class="btn btn-primary filter">Filter</button>
                </form>


              </div>
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
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
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
<script src="<?= BASEURL ?>/dist/js/pages/js-rupiah.js"></script>

<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function() {
    const table = $("#example1").DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      searching: true,
      ajax: {
        url: "getDaftarTransaksi.php",
        type: "GET",
        data: function(d) {
          d.start_date = $("#filter_tanggal_awal").val(); // Tambahkan parameter tanggal awal
          d.end_date = $("#filter_tanggal_akhir").val(); // Tambahkan parameter tanggal akhir
        },
      },
      pageLength: 10,
      lengthMenu: [
        [10],
        [10]
      ],
      columns: [{
          data: "no_faktur"
        },
        {
          data: "nama_pelanggan"
        },
        {
          data: "tanggal"
        },
        {
          data: "jatuh_tempo"
        },
        {
          data: "diskon"
        },
        {
          data: "total"
        },
        {
          data: "bayar"
        },
        {
          data: "kembali"
        },
        {
          data: "status"
        },
        {
          data: "actions"
        },
      ],
      order: [
        [2, "desc"]
      ], // Order by tanggal
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json",
      },
    });

    // Event filter
    $("#filter_date").on("click", function() {
      table.ajax.reload(); // Reload table data sesuai filter
    });
  });

  $("input[type=date]").on('click', function() {
    return false;
  });
  $(document).on('click', '.filter', function(e) {
  // Ambil nilai dari input tanggal
  var tanggal_awal = $('#filter_tanggal_awal').val();
  var tanggal_akhir = $('#filter_tanggal_akhir').val();

  // Cek apakah kedua tanggal sudah diisi
  if (!tanggal_awal || !tanggal_akhir) {
    // Jika salah satu atau kedua tanggal tidak diisi, tampilkan SweetAlert
    e.preventDefault(); // Mencegah form untuk disubmit
    Swal.fire({
      icon: 'error',
      title: 'Peringatan!',
      text: 'Kedua tanggal harus diisi!',
    });
  }
});

  $(document).ready(function() {

    var today = moment().format('YYYY-MM-DD');

    $(document).ready(function() {
      // Inisialisasi datepicker untuk tanggal awal dan tanggal akhir
      $('#filter_tanggal_awal, #filter_tanggal_akhir').datepicker({
        dateFormat: 'yy-mm-dd', // Format tanggal
        changeYear: true, // Menampilkan pemilih tahun
        changeMonth: true,
      });
    });
  })
</script>

</body>

</html>