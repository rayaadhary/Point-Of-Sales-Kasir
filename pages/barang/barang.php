<?php
include_once "../../functions.php";
$title = 'barang';
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
          <h1>Barang</h1>
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
                <?php if ($_SESSION['role'] == 'pemilik') { ?>
                <a href="<?= BASEURL ?>/pages/barang-masuk/barang-masuk.php" class="btn btn-primary" type="button">Tambah</a>
              <?php } ?>
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
                      <th>ID Barang</th>
                      <th>No Barang Masuk</th>
                      <th>Tanggal Beli</th>
                      <th>Nama Barang</th>
                      <?php if ($_SESSION['role'] == 'pemilik') { ?>
                        <th>Harga Beli</th>
                      <?php } ?>
                      <th>Harga Jual</th>
                      <th>Stok</th>
                      <th>Supplier</th>
                      <?php if ($_SESSION['role'] == 'pemilik') { ?>
                        <th>Aksi</th>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Data is loaded dynamically via DataTables -->
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Edit Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form action="barang-edit.php" method="post">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="id_barang">ID Barang</label>
                          <input type="text" class="form-control" name="id_barang" id="id_barang" readonly>
                        </div>
                        <div class="form-group">
                          <label for="nama_barang">Nama Barang</label>
                          <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukan Nama Barang">
                        </div>
                        <div class="form-group">
                          <label for="harga_jual">Harga Jual</label>
                          <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Masukan Harga Barang">
                        </div>
                        <div class="form-group">
                          <label for="stok">Stok Barang</label>
                          <input type="number" class="form-control" id="stok" name="stok">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="btn-simpan">Simpan</button>
                      </div>
                    </form>
                  </div>
                </div>
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

<!-- Modal Tambah Data -->

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
    var table = $("#example1").DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      searching: true,
      ajax: {
        url: "getDaftarBarang.php",
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
          data: "id_barang"
        },
        {
          data: "no_barang_masuk"
        },
        {
          data: "tanggal_beli"
        },
        {
          data: "nama_barang"
        },
        {
          data: "harga_beli",
          render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
        },
        {
          data: "harga_jual",
          render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
        },
        {
          data: "stok"
        },
        {
          data: "nama_supplier"
        },
        {
          data: null,
          orderable: false,
          render: function(data, type, row) {
            // Render tombol edit dan hapus
            return `
              <a href="#" type="button" data-id="${row.id_barang}" class="btn btn-success btn-circle btn-sm edit-modal">
                <i class="fas fa-edit"></i>
              </a>
              <a href="barang-hapus.php?id_barang=${row.id_barang}&no_barang_masuk=${row.no_barang_masuk}" class="btn btn-danger btn-circle btn-sm hapus">
                <i class="fas fa-trash"></i>
              </a>`;
          }
        }
      ],
      order: [
        [0, 'desc']
      ],
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
      }
    });

    // Re-bind modal triggers after DataTables redraws
    $('#example1').on('click', '.edit-modal', function(e) {
      e.preventDefault();
      var id_barang = $(this).data('id');
      console.log(id_barang);

      // Fetch data for the modal
      $.ajax({
        // url: `getBarangById.php?id_barang=${id_barang}`,
        url: 'getBarangById.php?id_barang=' + id_barang,
        type: "GET",
        success: function(response) {
          var data = JSON.parse(response); 

          $('#id_barang').val(data.id_barang);
          $('#nama_barang').val(data.nama_barang);
          $('#harga_jual').val(data.harga_jual);
          $('#stok').val(data.stok);

          // Show modal
          $('#myModal').modal('show');
        }
      });
    });
  });

  $(document).on('click', '.hapus', function(e) {
    e.preventDefault();  // Prevent the default behavior (redirect)

    var deleteUrl = $(this).attr('href');  // Get the URL for deletion from the href attribute

    // Show SweetAlert confirmation dialog
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Data ini akan dihapus secara permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user confirms, navigate to the delete URL to execute the deletion
            window.location.href = deleteUrl;
        }
    });
});

$("input[type=date]").on('click', function() {
    return false;
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
});

</script>




</body>

</html>