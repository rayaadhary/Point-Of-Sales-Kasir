<?php
include_once "../../functions.php";
$title = 'profit';
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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="<?= BASEURL ?>/plugins/chart.js/Chart.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/chart.js/Chart.css">
  <script src="<?= BASEURL ?>/plugins/chart.js/Chart.min.js"></script>
  <script src="<?= BASEURL ?>/plugins/chart.js/Chart.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
  <script src="../../dist/jquery/jquery-3.6.3.min.js"></script>
  <script src="../../dist/jquery/select2-4.1.0-rc.0/dist/js/select2.min.js"></script>
  <link rel="stylesheet" href="../../dist/jquery/select2-4.1.0-rc.0/dist/css/select2.min.css">
  <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
</head>

<?php
include_once "../layout/header.php";
$totalTransaksi = getTotalTransaksi();
$totalBarangMasuk = getTotalBarangMasuk();
$totalBeban = getTotalBeban();
$totalPrive = getTotalPrive();
$totalModal = getTotalModal();
$totalSelisih = getTotalSelisih();
$data_transaksi = getGroupTransaksi();
$jumlah_transaksi = getJumlahTransaksi();
$keuntungan = $totalTransaksi - $totalBarangMasuk - $totalBeban - $totalPrive + $totalModal;
$data_profit = getGroupProfit();

// var_dump($data_profit);
// die;
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
                <label for="total-beban">Beban Usaha</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalBeban, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_beban" id="total-beban" readonly />
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <label for="total-selisih">Total Selisih</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalSelisih, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="total_selisih" id="total-selisih" readonly />
            </div>
            <div class="col-md-3">
              <div class="text-center">
                <label for="profit">Profit</label>
              </div>
              <input type="text" class="form-control" value="Rp. <?= number_format($totalSelisih, 0, ',', '.') ?>" style="background-color: #fff; text-align: right;" name="profit" id="profit" readonly />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Profit</h3>

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
            <div>
              <canvas id="grafik"></canvas>
              <!-- <div class="d-flex justify-content-end"> -->
              <select id="tahun" style="width: 100px;"></select>
              <!-- </div> -->
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tabel Profit</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table class="table table-bordered dataTable">
              <thead>
                <tr>
                  <!-- <th style="width: 10px">#</th> -->
                  <th>Tanggal</th>
                  <th>Keuntungan</th>
                  <th>Jumlah</th>
                  <th>Pelanggan</th>
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
                    <td>Rp. <?= number_format($item['selisih'], 0, ',', '.') ?></td>
                    <td><?= $item['jumlahBanyak'] ?></td>
                    <td><?= $item['nama_pelanggan'] ?></td>
                  </tr>
                <?php
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

      <div class="col-md-6">
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
    </div>

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
<!-- <script src="../../plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>


<script src="<?= BASEURL ?>/dist/js/pages/js-logout.js"></script>
<script src="<?= BASEURL ?>/dist/js/pages/js-rupiah.js"></script>

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

  const dataFromSQL = <?php echo json_encode(getGroupProfit()); ?>; // Assuming you have a PHP function named getGroupProfit() that retrieves the data from SQL

  const labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', "September", "Oktober", "November", "Desember"];
  const bebanData = [];
  const selisihData = [];
  const profitData = [];

  labels.forEach((label, index) => {
    const dataItem = dataFromSQL.find(item => item.bulan == index + 1); // Assuming the 'bulan' column in your SQL query represents the month as a number (1-12)
    if (dataItem) {
      bebanData.push(dataItem.beban);
      selisihData.push(dataItem.totalSelisih);
      profitData.push(dataItem.total);
    } else {
      bebanData.push(0);
      selisihData.push(0);
      profitData.push(0);
    }
  });

  const data = {
    labels: labels,
    datasets: [{
        label: 'Beban',
        data: bebanData,
        borderWidth: 1,
        backgroundColor: 'rgba(255, 99, 132, 0.4)',
        borderColor: 'rgba(255, 99, 132, 1)'
      },
      {
        label: 'Selisih',
        data: selisihData,
        borderWidth: 1,
        backgroundColor: 'rgba(54, 162, 235, 0.4)',
        borderColor: 'rgba(54, 162, 235, 1)',
      },
      {
        label: 'Profit',
        data: profitData,
        borderWidth: 1,
        backgroundColor: 'rgba(255, 206, 86, 0.4)',
        borderColor: 'rgba(255, 206, 86, 1)',
      }
    ]
  };

  const config = {
    type: 'bar',
    data,
    options: {
      interaction: {
        mode: 'index'
      },
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  };

  const myChart = new Chart(
    document.getElementById('grafik'),
    config
  );


  $(document).ready(function() {
    $("input[type=date]").on('click', function() {
      return false;
    });

    // Get the year select element
    const yearSelect = document.getElementById('tahun');

    // Initialize Select2 on the year select element
    $(yearSelect).select2();

    // Get the current year
    const currentYear = new Date().getFullYear();

    // Generate options for the current year and the previous five years
    for (let i = 0; i <= 4; i++) {
      const year = currentYear - i;
      const option = new Option(year, year);
      yearSelect.appendChild(option);
    }

    $('#tahun').on('change', function() {
      var tahun = $(this).val();
      $.ajax({
        url: "totalProfit.php",
        type: 'POST',
        data: {
          tahun: tahun
        },
        dataType: 'json',
        success: function(data) {
          // Get the labels for the filtered data
          const labels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

          // Initialize data arrays for beban, selisih, and profit
          const bebanData = [];
          const selisihData = [];
          const profitData = [];

          // Loop through the labels to populate the data arrays
          labels.forEach((label, index) => {
            const dataItem = data.find(item => item.bulan == index + 1); // Assuming the 'bulan' column in your SQL query represents the month as a number (1-12)
            if (dataItem) {
              bebanData.push(dataItem.beban);
              selisihData.push(dataItem.totalSelisih);
              profitData.push(dataItem.total);
            } else {
              bebanData.push(0);
              selisihData.push(0);
              profitData.push(0);
            }
          });

          // Update the chart with the filtered data
          myChart.data.labels = labels;
          myChart.data.datasets[0].data = bebanData;
          myChart.data.datasets[1].data = selisihData;
          myChart.data.datasets[2].data = profitData;
          myChart.update();
        }
      })
    })

  })
</script>
</body>

</html>