<?php
include_once "../../functions.php";
$title = "prive";
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
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>


  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>


  <link rel="stylesheet" href="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.css">
  <script src="../../dist/jquery/jquery-3.6.3.min.js"></script>
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="../../dist/jquery/moment.js"></script>

  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
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
          <h1>Prive</h1>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  Tambah
                </button>
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
                    <th>ID Prive</th>
                    <th>Nama Prive</th>
                    <th>Tanggal</th>
                    <th>Biaya</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php

                  $filter_tanggal_awal = isset($_GET['filter_tanggal_awal']) ? $_GET['filter_tanggal_awal'] : '';
                  $filter_tanggal_akhir = isset($_GET['filter_tanggal_akhir']) ? $_GET['filter_tanggal_akhir'] : '';

                  $data = getAllPrive($filter_tanggal_awal, $filter_tanggal_akhir);
                  foreach ($data as $item) {
                  ?>
                    <tr>
                      <td><?= $item['id_prive']; ?></td>
                      <td><?= $item['nama_prive']; ?></td>
                      <td><?= $item['tanggal']; ?></td>
                      <td>Rp. <?= number_format($item['biaya'], 0, ',', '.') ?></td>
                      <td>
                        <!-- a href -->
                        <a href="#" type="button" data-toggle="modal" data-target="#myModal<?= $item['id_prive'] ?>" class="btn btn-success btn-circle btn-sm">
                          <i class="fas fa-edit"></i>
                        </a>
                        <!-- a href -->
                        <a href="prive-hapus.php?id_prive=<?= $item['id_prive']; ?>" class="btn btn-danger btn-circle btn-sm hapus">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                    <!-- Modal Edit Data -->
                    <div class="modal fade" id="myModal<?= $item['id_prive'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" role="dialog">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Form Edit Prive</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body edit">
                            <form action="prive-edit.php" method="post">
                              <?php
                              $id_prive = $item['id_prive'];
                              $data = getPriveById($id_prive);
                              ?>
                              <div class="card-body">
                                <div class="form-group">
                                  <label for="id_prive">ID Prive</label>
                                  <input type="text" class="form-control" name="id_prive" id="id_prive" value="<?= $data['id_prive'] ?>" readonly>
                                </div>
                                <div class="form-group">
                                  <label for="nama_prive">Nama Prive</label>
                                  <input type="text" class="form-control" id="nama_prive" name="nama_prive" placeholder="Masukan Nama Prive" value="<?= $data['nama_prive'] ?>">
                                </div>
                                <div class="form-group">
                                  <label for="tanggal">Tanggal</label>
                                  <input type="date" class="form-control" id="tanggal-edit" name="tanggal" placeholder="Masukan Tanggal" value="<?= $data['tanggal'] ?>">
                                </div>
                                <div class="form-group">
                                  <label for="biaya">Biaya</label>
                                  <input type="text" class="form-control" id="biaya-edit" name="biaya" placeholder="Masukan Biaya Prive" value="Rp. <?= number_format($item['biaya'], 0, ',', '.') ?>">
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary" name="btn-simpan">Simpan</button>
                            </div>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Akhir modal -->
                  <?php
                  }
                  ?>
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

<!-- Modal Tambah Data -->

<!-- Modal Tambah Data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form Tambah Prive</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body tambah">
        <form action="prive-tambah.php" method="post">
          <div class="card-body">
            <div class="form-group">
              <?php
              $kode_prive = kodePrive();
              ?>
              <label for="id_prive">ID Prive</label>
              <input type="text" class="form-control" name="id_prive" id="id_prive" value="<?= $kode_prive ?>" placeholder="Masukan ID Prive" readonly>
            </div>
            <div class="form-group">
              <label for="nama_prive">Nama Prive</label>
              <input type="text" class="form-control" id="nama_prive" name="nama_prive" placeholder="Masukan Nama Prive">
            </div>
            <div class="form-group">
              <label for="biaya">Biaya</label>
              <input type="text" class="form-control" id="biaya-tambah" name="biaya" placeholder="Masukan Biaya Prive">
            </div>
            <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" class="form-control" id="tanggal-tambah" value="<?= date('Y-m-d'); ?>" name="tanggal" placeholder="Masukan Tanggal Prive">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <div class="text-center">
          <button type="submit" class="btn btn-primary" name="btn-simpan">Simpan</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Akhir modal -->



<!-- jQuery -->
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<!-- <script src="../../dist/jquery/jquery-3.6.3.min.js"></script> -->

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
    $("#example1").DataTable({
      "responsive": true,
      // "lengthChange": false,
      "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      language: {
        url: 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/id.json'
      }
    });
  });
  $("input[type=date]").on('click', function() {
    return false;
  });

  $(document).ready(function() {
    var today = moment().format('YYYY-MM-DD');

    $('#tanggal-tambah').datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true
    });

    $(document).on('focus', '#tanggal-edit', function() {
      $(this).datepicker({
        dateFormat: 'yy-mm-dd',
        changeYear: true
      });
    });

    $(document).ready(function() {
      // Inisialisasi datepicker untuk tanggal awal dan tanggal akhir
      $('#filter_tanggal_awal, #filter_tanggal_akhir').datepicker({
        dateFormat: 'yy-mm-dd', // Format tanggal
        changeYear: true, // Menampilkan pemilih tahun
        changeMonth: true,
      });
    });

    $(document).on('click', '.tambah', function() {
      $('#biaya-tambah').on('keyup', function() {
        var rupiah = formatRupiah($(this).val(), 'Rp. ');
        $(this).val(rupiah);
      })
    });
    $(document).on('click', '.edit', function() {
      $('#biaya-edit').on('keyup', function() {
        var rupiah = formatRupiah($(this).val(), 'Rp. ');
        $(this).val(rupiah);
      })
    });
  })
</script>
</body>

</html>