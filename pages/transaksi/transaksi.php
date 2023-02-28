<?php
include_once "../../functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | DataTables</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
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
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
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
              <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah
              </button> -->

              <label for="tanggal">Tanggal Transaksi</label>
              <input type="datetime-local" class="form-control" name="tanggal" id="tanggal" value="<?= waktu() ?>" style="width: 180px;">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="post">
                <?php
                ?>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="no-faktur">No Faktur</label>
                      <input type="text" class="form-control" name="no_faktur" id="no-faktur">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-barang">Nama Barang</label>
                      <input type="text" class="form-control" name="nama_barang" id="nama-barang">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="id-barang">ID Barang</label>
                      <input type="text" class="form-control" name="id_barang" id="id-barang" readonly>
                    </div>
                  </div>
                </div>
              </form>
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
<footer class=" main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 3.1.0
  </div>
  <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>


<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<!-- Sweetalert -->
<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->

<script type="text/javascript">
  $(function() {
    var data = "<?= BASEURL ?>/pages/transaksi/autocomplete.php";
    var results = [];
    $("#nama-barang").autocomplete({
      source: data,
      select: function(event, ui) {
        $("#id-barang").val(ui.item.id_barang);
      }
    });
  });
</script>

</body>

</html>