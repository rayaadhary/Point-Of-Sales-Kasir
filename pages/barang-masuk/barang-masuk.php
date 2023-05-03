<?php
include_once "../../functions.php";
$title = "barang_masuk";
$menu  = "barang_masuk";
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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css"> -->
  <link rel="stylesheet" href="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="../../dist/jquery/jquery-3.6.3.min.js"></script>
  <script src="../../dist/jquery/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>
  <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
  <link rel="stylesheet" href="../../dist/jquery/select2-4.1.0-rc.0/dist/css/select2.min.css">
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
          <h1>Barang Masuk</h1>
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
            <!-- <div class="card-header"> -->
            <!-- <h3 class="card-title">DataTable with default features</h3> -->
            <!-- <a href="barang-tambah.php"><button type="button" class="btn btn-primary rounded">Tambah</button></a> -->
            <!-- Button trigger modal -->
            <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah
              </button> -->
            <!-- <h3></h3> -->

            <!-- </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <form action="barang-masuk-tambah.php" method="post">
                <div class="row mb-4">
                  <div class="col-md-2">
                    <label for="tanggal">Tanggal Beli</label>
                    <input type="date" class="form-control" name="tanggal_beli" id="tanggal-beli" style="width: 140px;">
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-supplier">Nama Supplier</label>
                      <input type="text" class="form-control" name="nama_supplier" id="nama-supplier" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="id-supplier">ID Supplier</label>
                      <input type="text" class="form-control" name="id_supplier" id="id-supplier" readonly>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="telepon-supplier">Telepon Supplier</label>
                      <input type="number" class="form-control" name="telepon_supplier" id="telepon-supplier" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Alamat Supplier</label>
                      <textarea class="form-control" rows="1" name="alamat_supplier" id="alamat-supplier" placeholder="Masukan Alamat supplier" required></textarea>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <?php
                      $waktu = date_format(date_create(), 'Y-m-d');
                      $barangMasuk = barangMasuk($waktu);
                      ?>
                      <label for="no-faktur">Barang Masuk</label>
                      <input type="text" class="form-control" name="barang_masuk" id="barang-masuk" value="<?= $barangMasuk ?>" readonly style="width: 120px;">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="nama-barang">Nama Barang</label>
                      <!-- <select name="nama_barang" id="nama-barang" class="form-control"></select> -->
                      <input type="text" class="form-control" name="nama_barang" id="nama-barang">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="id-barang">ID Barang</label>
                      <input type="text" class="form-control" name="id_barang" id="id-barang">
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="harga_beli">Harga Beli</label>
                      <input type="number" class="form-control" name="harga_beli" id="harga-beli">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label for="harga_jual">Harga Jual</label>
                      <input type="number" class="form-control" name="harga_jual" id="harga-jual">
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label for="banyak">Banyak</label>
                      <input type="number" class="form-control" name="banyak" id="banyak">
                    </div>
                  </div>
                  <!-- <input type="hidden" id="harga"> -->
                  <input type="hidden" name="no" id="no" value="1">
                  <div class="col-md-2">
                    <div class="d-flex justify-content-end">
                      <a href="#" class="btn btn-primary" id="tambah">Tambah</a>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-8">
                    <div class="list">
                      <div class="row">
                        <div class="col-md-3">
                          <span>Nama Barang</span>
                        </div>
                        <div class="col-md-2">
                          <span>Harga Beli</span>
                        </div>
                        <div class="col-md-2">
                          <span>Harga Jual</span>
                        </div>
                        <div class="col-md-2">
                          <span>Banyak</span>
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
                      <span>Potongan</span>
                      <input type="number" id="diskon" name="diskon" class="form-control" value="0">
                    </div>
                    <br>
                    <div class="row">
                      <span>Bayar</span>
                      <input type="text" id="bayar" name="bayar" class="form-control">
                    </div>
                    <br>
                    <div class="row">
                      <span>Sisa</span>
                      <input type="text" name="kembalian" id="kembalian" value="0" class="form-control" readonly>
                    </div>
                    <br>
                    <div class="row">
                      <span>Status</span>
                      <input type="text" name="status" id="status" class="form-control" readonly>
                    </div>
                    <br>
                    <div class="d-flex">
                      <div class="justify-content-start">
                        <button type="submit" name="simpan" class="btn btn-primary">
                          Simpan
                        </button>
                      </div>
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
<!-- <footer class=" main-footer">
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


<!-- jQuery -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>

<!-- Sweetalert -->
<script src="<?= BASEURL ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page specific script -->

<script type="text/javascript">
  // Use datepicker on the date inputs
  // $("input[type=date]").datepicker({
  //   dateFormat: 'yy-dd-mm',
  //   onSelect: function(dateText, inst) {
  //     $(inst).val(dateText); // Write the value in the input
  //   }
  // });

  // Code below to avoid the classic date-picker
  $("input[type=date]").on('click', function() {
    return false;
  });

  $(document).ready(function() {
    // Mendapatkan tanggal sekarang dengan format yyyy-mm-dd
    var today = moment().format('YYYY-MM-DD');

    // Menetapkan nilai awal input tanggal dan jatuh tempo dengan tanggal sekarang
    $('#tanggal-beli').val(today);

    $('#tanggal-beli').datepicker({
      dateFormat: 'yy-mm-dd',
      changeYear: true
    });
  });

  // format nominal rupiah
  // var bayar = document.getElementById('bayar');
  // bayar.addEventListener('keyup', function(e) {
  // tambahkan 'Rp.' pada saat ketik nominal di form kolom input
  // gunakan fungsi formatRupiah() untuk mengubah nominal angka yang di ketik menjadi format angka
  //   bayar.value = formatRupiah(this.value, 'Rp. ');
  // });
  /* Fungsi formatRupiah */
  // function formatRupiah(angka, prefix) {
  //   var number_string = angka.replace(/[^,\d]/g, '').toString(),
  //     split = number_string.split(','),
  //     sisa = split[0].length % 3,
  //     bayar = split[0].substr(0, sisa),
  //     ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  // tambahkan titik jika yang di input sudah menjadi angka satuan ribuan
  //   if (ribuan) {
  //     separator = sisa ? '.' : '';
  //     bayar += separator + ribuan.join('.');
  //   }

  //   bayar = split[1] != undefined ? bayar + ',' + split[1] : bayar;
  //   return prefix == undefined ? bayar : (bayar ? 'Rp. ' + bayar : '');
  // }

  // function formatToInteger(angka) {
  //   var number_string = angka.replace(/[^,\d]/g, '').toString(),
  //     split = number_string.split(','),
  //     bayar = split[0],
  //     ribuan = split[0].substr(sisa).match(/\d{3}/gi);
  //   if (ribuan) {
  //     bayar += ribuan.join('');
  //   }
  //   return parseInt(bayar);
  // }

  // var inputRupiah = document.getElementById('inputRupiah').value;
  // var rupiahInteger = formatToInteger(inputRupiah);
  // var bayarRupiah = document.getElementById('bayar').value;
  // var bayarInteger = formatToInteger(bayarRupiah);

  function del(no) {
    var stotal = parseInt($('#subTotal' + no).val());
    var alltotal = parseInt($('#stotal').val());
    var newtotal = alltotal - stotal;

    $('#stotal').val(newtotal);
    $('#row' + no).remove();
  }



  $(function() {


    $('#nama-supplier').autocomplete({
      source: "<?= BASEURL ?>/pages/barang-masuk/nama-supplier.php",
      select: function(event, ui) {
        $('#id-supplier').val(ui.item.id_supplier);
        $('#telepon-supplier').val(ui.item.telepon_supplier);
        $('#alamat-supplier').val(ui.item.alamat_supplier);
      }
    });

    $('#nama-barang').autocomplete({
      source: "<?= BASEURL ?>/pages/barang-masuk/nama-barang.php",
      select: function(event, ui) {
        $('#id-barang').val(ui.item.id_barang);
        $('#harga-jual').val(ui.item.harga_jual);
        $('#harga-beli').val(ui.item.harga_beli);
      }
    });

    $('#tambah').on('click', function() {
      var no = $('#no').val();
      var id_barang = $('#id-barang').val();
      var nama_barang = $('#nama-barang').val();
      // var nama_barang = $('#nama-barang option:selected').text();
      var banyak = $('#banyak').val();
      var harga_beli = $('#harga-beli').val();
      var harga_jual = $('#harga-jual').val();
      var total = $('#stotal').val();
      // var subtotal = banyak * harga_beli;
      var subtotal = banyak * harga_beli;
      var total = parseInt(total) + parseInt(subtotal);
      var html = '<div class="row mb-2" id="row' + no + '">' +
        '<div class="col-md-3">' +
        '<input class="form-control" id="namaBarang' + no + '" name="nama_barang[]" readonly>' +
        '<input type="hidden" id="idBarang' + no + '" name="idBarang[]" readonly>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input class="form-control" id="hargaBeliBarang' + no + '" name="harga_beli[]" readonly>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input class="form-control" id="hargaJualBarang' + no + '" name="harga_jual[]" readonly>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input class="form-control" id="qty' + no + '" name="banyak[]" readonly>' +
        '</div>' +
        '<div class="col-md-2">' +
        '<input class="form-control" id="subTotal' + no + '"  name="subtotal[]" readonly>' +
        '</div>' +
        '<a class="btn btn-sm btn-danger rounded" onClick="del(' + no + ')"> X </a>' +
        '</div>';
      $('.list').append(html);
      $('#stotal').val(total);
      $('#namaBarang' + no).val(nama_barang);
      $('#idBarang' + no).val(id_barang);
      $('#hargaJualBarang' + no).val(harga_jual);
      $('#hargaBeliBarang' + no).val(harga_beli);
      $('#qty' + no).val(banyak);
      $('#subTotal' + no).val(subtotal);
      $('#banyak').val('');
      var no = (no - 1) + 2;
      $('#no').val(no);
      $('#nama-barang').val(null).trigger('change');
      $('#id-barang').val(null).trigger('change');
      $('#harga-jual').val(null).trigger('change');
      $('#harga-beli').val(null).trigger('change');
    });

    $('#diskon').on('keyup', function() {
      var total = parseInt($('#stotal').val());
      var diskon = parseInt($(this).val());
      var bayar = parseInt($('#bayar').val());
      var kembalian = bayar - (total - diskon >= 0 ? total - diskon : 0);
      if (kembalian >= 0) {
        $('#kembalian').val(kembalian);
        $('#status').val('Lunas');
      } else {
        $('#status').val('Utang');
        $('#kembalian').val(kembalian);
      }
    })

    $('#bayar').on('keyup', function() {
      var total = parseInt($('#stotal').val());
      var diskon = parseInt($('#diskon').val());
      var bayar = parseInt($(this).val());
      var kembalian = bayar - (total - diskon >= 0 ? total - diskon : 0);
      if (kembalian >= 0) {
        $('#kembalian').val(kembalian);
        $('#status').val('Lunas');
      } else if (total == 0) {
        $('#status').val('');
      } else {
        $('#status').val('Utang');
        $('#kembalian').val(kembalian);
      }
    })
  });
</script>

</body>

</html>