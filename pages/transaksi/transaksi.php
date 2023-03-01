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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                      <select name="nama_barang" id="nama-barang" class="form-control"></select>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="id-barang">ID Barang</label>
                      <input type="text" class="form-control" name="id_barang" id="id-barang" readonly>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="banyak">Banyak</label>
                      <input type="text" class="form-control" name="banyak" id="banyak">
                    </div>
                  </div>
                  <input type="hidden" id="harga">
                  <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                      <!-- <button class="btn btn-primary">Tambah</button> -->
                      <a href="#" class="btn btn-primary" id="tambah">Tambah</a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="list">
                      <div class="row">
                        <div class="col-md-4">
                          <span>Nama Barang</span>
                        </div>
                        <div class="col-md-2">
                          <span>Harga</span>
                        </div>
                        <div class="col-md-2">
                          <span>QTY</span>
                        </div>
                        <div class="col-md-3">
                          <span>Subtotal</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3 col-md-offset-1">
                    <div class="row">
                      <span>Total</span>
                      <input type="text" id="stotal" name="total" class="form-control" value="0" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Bayar</span>
                      <input type="text" id="bayar" name="bayar" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                      <span>Kembalian</span>
                      <input type="text" name="kembalian" id="kembalian" value="0" class="form-control" readonly>
                    </div>
                    <br>
                    <button type="submit" name="simpan" class="btn btn-default"> Simpan</button>
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
    $('#nama-barang').select2({
      theme: "classic",
      placeholder: 'Pilih Nama Barang',
      ajax: {
        url: "<?= BASEURL ?>/pages/transaksi/autocomplete.php",
        type: 'GET',
        dataType: 'json',
        delay: 250,
        data: function(params) {
          return {
            term: params.term
          };
        },
        processResults: function(data) {
          var results = [];
          $.each(data, function(index, item) {
            results.push({
              id: item.id_barang,
              text: item.nama_barang,
              harga: item.harga
            });
          });
          return {
            results: results
          };
        },
        cache: true
      }
    });
    // Fungsi untuk mengambil id barang dari input field terpisah saat user memilih nama barang
    $('#nama-barang').on('select2:select', function(e) {
      var data = e.params.data;
      $('#id-barang').val(data.id);
      $('#harga').val(data.harga);
    });

    $('#tambah').on('click', function() {
      var id_barang = $('#id-barang').val();
      var nama_barang = $('#nama-barang option:selected').text();
      var banyak = $('#banyak').val();
      var harga = $('#harga').val();
      var total = $('#stotal').val();
      var subtotal = banyak * harga;
      var total = parseInt(total) + parseInt(subtotal);
      var html = '<div class="row">' +
        '<div class="col-md-4">' +
        '<span>' + nama_barang + '</span>' +
        '<input type="hidden" name="nama_barang[]" value="' + nama_barang + '">' +
        '</div>' +
        '<div class="col-md-2">' +
        '<span>' + harga + '</span>' +
        '<input type="hidden" name="harga[]" value="' + harga + '">' +
        '</div>' +
        '<div class="col-md-2">' +
        '<span>' + banyak + '</span>' +
        '<input type="hidden" name="banyak[]" value="' + banyak + '">' +
        '</div>' +
        '<div class="col-md-3">' +
        '<span>' + subtotal + '</span>' +
        '<input type="hidden" name="subtotal[]" value="' + subtotal + '">' +
        '</div>' +
        '<a class="btn btn-sm btn-danger"> X </a>' +
        '</div>';
      $('.list').append(html);
      $('#stotal').val(total);
      $('#banyak').val('');
      $('#nama-barang').val(null).trigger('change');
      $('#id-barang').val(null).trigger('change');
    });
  });
</script>

</body>

</html>