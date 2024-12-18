<?php
include_once "../../functions.php";
$title = 'cashflow';
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
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/dist/jquery/monthpicker.css">
  <script src="../../dist/jquery/monthpicker.js"></script>

  <!-- Theme style -->
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>


  <link rel="stylesheet" href="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.css">
  <script src="../../dist/jquery/jquery-3.6.3.min.js"></script>
  <script src="../../dist/jquery/jquery-ui-1.13.2.custom/jquery-ui.js"></script>

  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="../../dist/jquery/moment.js"></script>


  <link rel="stylesheet" href="<?= BASEURL ?>/dist/css/adminlte.min.css">
  <!-- Sweetalert 2 -->
  <link rel="stylesheet" href="<?= BASEURL ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <style>
    /* Kartu dengan bayangan */
    .card-shadow {
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      border-radius: 12px;
      overflow: hidden;
      /* Untuk menghilangkan overflow pada sudut */
      transition: transform 0.3s, box-shadow 0.3s;
      background-color: #fff;
    }

    /* Hover efek untuk kartu */
    .card-shadow:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    /* Header dengan gradien warna */
    .bg-gradient {
      background: linear-gradient(135deg, #4caf50, #81c784);
      padding: 12px 16px;
    }

    .bg-gradient-blue {
      background: linear-gradient(135deg, rgb(38, 45, 139), #81c784);
      padding: 12px 16px;
    }

    .card-title {
      font-weight: bold;
      font-size: 16px;
      margin: 0;
    }

    /* Gaya untuk jumlah total */
    .total-amount {
      font-weight: bold;
      color: #28a745;
      font-size: 24px;
      margin-bottom: 8px;
    }

    /* Gaya untuk informasi persentase */
    .percentage-info {
      font-size: 14px;
      color: #6c757d;
    }

    /* Tambahkan ikon kecil di teks */
    .percentage-info i {
      margin-right: 4px;
    }
  </style>
</head>

<?php
include_once "../layout/header.php";
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
// var_dump($bulan);
// die;
function getIconAndColor($direction)
{
  switch ($direction) {
    case 'up':
      return [
        'icon' => '<i class="fas fa-arrow-up" style="color: #28a745;"></i>',
        'color' => 'text-success'
      ];
    case 'down':
      return [
        'icon' => '<i class="fas fa-arrow-down" style="color: #dc3545;"></i>',
        'color' => 'text-danger'
      ];
    default:
      return [
        'icon' => '<i class="fas fa-minus" style="color: #6c757d;"></i>',
        'color' => 'text-secondary'
      ];
  }
}

// $bulan = ""; // parameter bulan yang diberikan

$dataTypes = [
  'transaksi' => getTotalTransaksiComparison($bulan),
  'barangMasuk' => getTotalBarangMasukComparison($bulan),
  'beban' => getTotalBebanComparison($bulan),
  'modal' => getTotalModalComparison($bulan),
  'prive' => getTotalPriveComparison($bulan),
  'selisih' => getTotalSelisihComparison($bulan)
];

$transaksiResult = $dataTypes['transaksi'];
$barangMasukResult = $dataTypes['barangMasuk'];
$bebanResult = $dataTypes['beban'];
$priveResult = $dataTypes['prive'];
$modalResult = $dataTypes['modal'];
$selisihResult = $dataTypes['selisih'];

$totalTransaksi = $transaksiResult['currentTotal'];
$persentasePerubahan = round($transaksiResult['changePercentage'], 0);

$totalBarangMasuk = $barangMasukResult['currentTotal'];
$persentasePerubahanBarangMasuk = round($barangMasukResult['changePercentage'], 0);

$totalBeban = $bebanResult['currentTotal'];
$persentasePerubahanBeban = round($bebanResult['changePercentage'], 0);

$totalPrive = $priveResult['currentTotal'];
$persentasePerubahanPrive = round($priveResult['changePercentage'], 0);

$totalSelisih = $selisihResult['currentTotal'];
$persentasePerubahanSelisih = round($selisihResult['changePercentage'], 0);

$totalModal = $modalResult['currentTotal'];
$persentasePerubahanModal = round($modalResult['changePercentage'], 0);

$transaksiDisplay = getIconAndColor($transaksiResult['direction']);
$barangMasukDisplay = getIconAndColor($barangMasukResult['direction']);
$bebanDisplay = getIconAndColor($bebanResult['direction']);
$priveDisplay = getIconAndColor($priveResult['direction']);
$modalDisplay = getIconAndColor($modalResult['direction']);
$selisihDisplay = getIconAndColor($selisihResult['direction']);

$keuntungan = $totalTransaksi - $totalBarangMasuk - $totalBeban - ($totalPrive + $totalModal);
$keuntunganPeriodeBefore = getKeuntunganPeriodeBefore($bulan);

if(isset($_GET['bulan'])) {
  $tahun = substr($bulan, 0, 4);
} else {
  $tahun = '';
}   

  

$keuntunganSetahun = getKeuntunganPerBulanSetahun($tahun);


$persentasePerubahanKeuntungan = $keuntunganPeriodeBefore != 0
  ? round((($keuntungan - $keuntunganPeriodeBefore) / $keuntunganPeriodeBefore) * 100, 0)
  : 0;

// Tentukan arah perubahan keuntungan
$arahKeuntungan = $keuntungan <=> $keuntunganPeriodeBefore;
$keuntunganDisplay = getIconAndColor(
  $arahKeuntungan === 1 ? 'up' : ($arahKeuntungan === -1 ? 'down' : 'same')
);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Cashflow</h1>
        </div>
        <div class="col-sm-2">
          <form action="" method="get">
            <input type="text" name="bulan" id="bulan" class="form-control"
              value="<?= isset($_GET['bulan']) ? $_GET['bulan'] : '' ?>" required>
          </form>
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
              <div class="card card-shadow">
                <div class="card-header bg-gradient">
                  <h6 class="card-title text-center text-light">
                    <i class="fas fa-chart-line"></i> Total Penjualan
                  </h6>
                </div>
                <div class="card-body text-right">
                  <h4 class="text-right total-amount <?= $transaksiDisplay['color'] ?>">
                    Rp. <?= number_format($totalTransaksi, 0, ',', '.') ?>
                  </h4>
                  <p class="percentage-info <?= $transaksiDisplay['color'] ?>">
                    <?= $transaksiDisplay['icon'] ?> <?= abs($persentasePerubahan) ?>%
                    <?php switch ($transaksiResult['direction']):
                      case 'up':
                        echo '';
                        break;
                      case 'down':
                        echo '';
                        break;
                      default:
                        echo '';
                    endswitch; ?>
                    dari bulan lalu
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-shadow">
                <div class="card-header bg-gradient-blue">
                  <h6 class="card-title text-center text-light">
                    <i class="fas fa-shopping-cart"></i> Total Pembelian
                  </h6>
                </div>
                <div class="card-body text-right">
                  <h4 class="text-right total-amount <?= $barangMasukDisplay['color'] ?>">
                    Rp. <?= number_format($totalBarangMasuk, 0, ',', '.') ?>
                  </h4>
                  <p class="percentage-info <?= $barangMasukDisplay['color'] ?>">
                    <?= $barangMasukDisplay['icon'] ?> <?= abs($persentasePerubahanBarangMasuk) ?>%
                    <?php switch ($barangMasukResult['direction']):
                      case 'up':
                        echo '';
                        break;
                      case 'down':
                        echo '';
                        break;
                      default:
                        echo '';
                    endswitch; ?>
                    dari bulan lalu
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-shadow">
                <div class="card-header bg-gradient-blue">
                  <h6 class="card-title text-center text-light">
                    <i class="fas fa-shopping-cart"></i> Total Beban Usaha
                  </h6>
                </div>
                <div class="card-body text-right">
                  <h4 class="text-right total-amount <?= $bebanDisplay['color'] ?>">
                    Rp. <?= number_format($totalBeban, 0, ',', '.') ?>
                  </h4>
                  <p class="percentage-info <?= $bebanDisplay['color'] ?>">
                    <?= $bebanDisplay['icon'] ?> <?= abs($persentasePerubahanBeban) ?>%
                    <?php switch ($bebanResult['direction']):
                      case 'up':
                        echo '';
                        break;
                      case 'down':
                        echo '';
                        break;
                      default:
                        echo '';
                    endswitch; ?>
                    dari bulan lalu
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-shadow">
                <div class="card-header bg-gradient-blue">
                  <h6 class="card-title text-center text-light">
                    <i class="fas fa-shopping-cart"></i> Total Prive
                  </h6>
                </div>
                <div class="card-body text-right">
                  <h4 class="text-right total-amount <?= $priveDisplay['color'] ?>">
                    Rp. <?= number_format($totalPrive, 0, ',', '.') ?>
                  </h4>
                  <p class="percentage-info <?= $priveDisplay['color'] ?>">
                    <?= $priveDisplay['icon'] ?> <?= abs($persentasePerubahanPrive) ?>%
                    <?php switch ($priveResult['direction']):
                      case 'up':
                        echo '';
                        break;
                      case 'down':
                        echo '';
                        break;
                      default:
                        echo '';
                    endswitch; ?>
                    dari bulan lalu
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-3">
              <div class="card card-shadow">
                <div class="card-header bg-gradient-blue">
                  <h6 class="card-title text-center text-light">
                    <i class="fas fa-shopping-cart"></i> Total Modal
                  </h6>
                </div>
                <div class="card-body text-right">
                  <h4 class="text-right total-amount <?= $modalDisplay['color'] ?>">
                    Rp. <?= number_format($totalModal, 0, ',', '.') ?>
                  </h4>
                  <p class="percentage-info <?= $modalDisplay['color'] ?>">
                    <?= $modalDisplay['icon'] ?> <?= abs($persentasePerubahanModal) ?>%
                    <?php switch ($modalResult['direction']):
                      case 'up':
                        echo '';
                        break;
                      case 'down':
                        echo '';
                        break;
                      default:
                        echo '';
                    endswitch; ?>
                    dari bulan lalu
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="card card-shadow">
                <div class="card-header bg-gradient">
                  <h6 class="card-title text-center text-light">
                    <i class="fas fa-chart-line"></i> Total Selisih
                  </h6>
                </div>
                <div class="card-body text-right">
                  <h4 class="text-right total-amount <?= $selisihDisplay['color'] ?>">
                    Rp. <?= number_format($totalSelisih, 0, ',', '.') ?>
                  </h4>
                  <p class="percentage-info <?= $selisihDisplay['color'] ?>">
                    <?= $selisihDisplay['icon'] ?> <?= abs($persentasePerubahanSelisih) ?>%
                    <?php switch ($selisihResult['direction']):
                      case 'up':
                        echo '';
                        break;
                      case 'down':
                        echo '';
                        break;
                      default:
                        echo '';
                    endswitch; ?>
                    dari bulan lalu
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <div class="d-flex justify-content-center">
              <div class="col-md-3">
                <div class="card card-shadow">
                  <div class="card-header bg-gradient">
                    <h6 class="card-title text-center text-light">
                      <i class="fas fa-chart-line"></i> Total Keuangan
                    </h6>
                  </div>
                  <div class="card-body text-right">
                    <h4 class="text-right total-amount <?= $keuntunganDisplay['color'] ?>">
                      Rp. <?= number_format($keuntungan, 0, ',', '.') ?>
                    </h4>
                    <p class="percentage-info <?= $keuntunganDisplay['color'] ?>">
                      <?= $keuntunganDisplay['icon'] ?> <?= abs($persentasePerubahanKeuntungan) ?>%
                      <?= $arahKeuntungan === 'up' ? '' : ($arahKeuntungan === 'down' ? '' : '') ?>
                      dari bulan lalu
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
      <div id="keuntunganChart" class="w-full"></div>
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
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Data keuntungan dari PHP
    const keuntunganData = <?= json_encode(array_column($keuntunganSetahun, 'keuntungan')) ?>;
    
    // Buat array nama bulan
    const bulanNama = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];

    // Fungsi untuk memformat angka menjadi format IDR
    const formatIDR = (value) => new Intl.NumberFormat('id-ID', {
      style: 'currency',
      currency: 'IDR',
      minimumFractionDigits: 0,
      maximumFractionDigits: 0
    }).format(value);

    // Hitung perubahan keuntungan (bulan ini - bulan lalu)
    const perubahanKeuntungan = keuntunganData.map((value, index) => index === 0 ? 0 : value - keuntunganData[index - 1]);

    // Cari penurunan terbesar
    const { maxDrop, maxDropIndex } = perubahanKeuntungan.reduce((acc, current, index) => {
      if (current < acc.maxDrop) {
        acc.maxDrop = current;
        acc.maxDropIndex = index;
      }
      return acc;
    }, { maxDrop: 0, maxDropIndex: 0 });

    // Konfigurasi ApexCharts
    const options = {
      series: [
        { name: 'Keuangan', data: keuntunganData },
      ],
      chart: { 
        type: 'line', 
        height: 350, 
        toolbar: { show: true },
      },
      stroke: { curve: 'straight', width: 2 },
      markers: {
        size: 5, 
        colors: ['#FFFFFF'], 
        strokeColors: '#4CAF50', 
        strokeWidth: 2,
        shape: 'circle', // Bisa diganti dengan bentuk lain
        discrete: [{
          seriesIndex: 0,
          dataPointIndex: maxDropIndex,
          fillColor: '#FF0000', // Warna merah untuk marker penurunan terbesar
          strokeColor: '#FF0000',
          size: 5
        }]
      },
      xaxis: { categories: bulanNama, title: { text: 'Bulan' } },
      yaxis: {
        title: { text: 'Keuangan (Rp)' },
        labels: { formatter: formatIDR }
      },
      grid: { show: false },
      title: { text: `Keuangan Bulanan Tahun ${<?= json_encode($tahun) ?>}`, align: 'center' },
      tooltip: {
        enabled: true, // Tooltip akan muncul saat hover
        shared: true, // Menampilkan tooltip untuk semua series yang dihover
        followCursor: true, // Tooltip mengikuti posisi kursor
        intersect: false, // Tooltip muncul di titik data meskipun tidak tepat di bawah titik
        y: {
          formatter: (value, { seriesIndex, dataPointIndex }) => {
            const perubahan = perubahanKeuntungan[dataPointIndex];
            let perubahanText = '';
            // Cek jika ini adalah penurunan terbesar
            if (seriesIndex === 0 && dataPointIndex === maxDropIndex) {
              perubahanText = `(${formatIDR(perubahan)})`;
            } else if (perubahan > 0) {
              perubahanText = `(+${formatIDR(perubahan)})`;
            } else if (perubahan < 0) {
              perubahanText = `(${formatIDR(perubahan)})`;
            } else {
              perubahanText = '(Tidak ada perubahan)';
            }
            return `${formatIDR(value)} ${perubahanText}`;
          }
        }
      },
      annotations: {
        xaxis: [
          {
            x: bulanNama[maxDropIndex], // Menandai bulan dengan penurunan terbesar
            borderColor: '#FF0000',
            borderWidth: 2,
            label: {
              text: 'Penurunan Terbesar',
              style: {
                color: '#FF0000',
                background: '#ffffff'
              }
            }
          }
        ]
      },
      colors: ['#4CAF50'] // Warna hijau untuk garis utama
    };

    // Inisialisasi chart
    const chart = new ApexCharts(document.getElementById('keuntunganChart'), options);
    chart.render();
});

</script>




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


  $(document).ready(function() {
    $("input[type=date]").on('click', function() {
      return false;
    });

    // Inisialisasi datepicker untuk tanggal awal dan tanggal akhir
    $(function() {
      // Apply jQuery UI date picker for "month" input (with no day)
      $("#bulan").datepicker({
        dateFormat: "yy-mm", // This will set format as year-month
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        onClose: function(dateText, inst) {
          var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
          var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
          $(this).val(year + "-" + ("0" + (parseInt(month) + 1)).slice(-2));
          $(this).closest("form").submit(); // Submit the form automatically after selecting the month
        }
      }).focus(function() {
        $(".ui-datepicker-calendar").hide();
        $("#ui-datepicker-div").position({
          my: "center top",
          at: "center bottom",
          of: $(this)
        });
      });
    });
  });
</script>
</body>

</html>