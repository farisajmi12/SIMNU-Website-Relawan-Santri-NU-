<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Laporan Keuangan Manual</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <style>
    .table th {
      background-color: #0c8b00;
      color: #fff;
      text-align: center;
      vertical-align: middle;
    }

    .table td {
      vertical-align: middle;
      text-align: center;
    }

    tfoot {
      background-color: #f0f0f0;
      font-weight: bold;
    }

    .export-buttons {
      margin-bottom: 1rem;
    }


    /* Fix untuk dropdown filter */
    .card-body .form-select,
    .card-body .form-select:focus,
    .card-body .form-select option {
      color: #000 !important;
      background-color: #fff !important;
    }

    /* Untuk dark mode */
    .card-body .form-select:not(:disabled):not([readonly]) {
      background-color: #fff !important;
      background-image: none !important;
    }

    /* Untuk option yang hover */
    .card-body .form-select option:hover {
      background-color: #f8f9fa !important;
      color: #000 !important;
    }

    .filter-card {
      border-color: #0c8b00;
      margin-bottom: 20px;
    }

    .filter-card .card-header {
      background-color: #0c8b00 !important;
      color: white;
    }

    .filter-card .form-control,
    .filter-card .form-select {
      border-color: #0c8b00;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
      border-color: #0c8b00;
      box-shadow: 0 0 0 0.25rem rgba(139, 0, 0, 0.25);
    }

    /* Style untuk tombol */
    .filter-card .btn-primary {
      background-color: #0c8b00;
      border-color: #0c8b00;
    }

    .filter-card .btn-primary:hover {
      background-color: #0c8b00;
      border-color: #0c8b00;
    }

    .pagination {
      justify-content: center;
    }

    .page-item.active .page-link {
      background-color: #8B0000;
      border-color: #8B0000;
    }

    .page-link {
      color: #8B0000;
    }

    .page-link:hover {
      color: #0c8b00;
    }

    .btn.btn-primary {
      background-color: #f9fcfa !important;
      border-color: #f9fcfa !important;
      color: #666262 !important;
      transition: all 0.3s ease !important;
    }

    /* Gaya ikon dalam tombol */
    .btn.btn-primary i.fas.fa-plus {
      color: #666262 !important;
      transition: all 0.3s ease !important;
    }

    /* Efek hover - hijau dengan teks/ikon putih */
    .btn.btn-primary:hover {
      background-color: #0c8b00 !important;
      border-color: #0c8b00 !important;
      color: white !important;
    }

    .btn.btn-primary:hover i.fas.fa-plus {
      color: white !important;
    }

    /* Efek saat aktif/diklik - tetap hijau dengan putih */
    .btn.btn-primary:active,
    .btn.btn-primary:focus,
    .btn.btn-primary.active {
      background-color: #0c8b00 !important;
      border-color: #0c8b00 !important;
      color: white !important;
    }

    .btn.btn-primary:active i.fas.fa-plus,
    .btn.btn-primary:focus i.fas.fa-plus,
    .btn.btn-primary.active i.fas.fa-plus {
      color: white !important;
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <h1 class="page-tittle">Laporan Keuangan</h1>

    <!-- Notifikasi -->
    <?php if ($this->session->flashdata('success')) : ?>
      <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
    <?php elseif ($this->session->flashdata('error')) : ?>
      <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
    <?php endif; ?>

    <!-- Ganti bagian form filter dengan ini -->
    <div class="card mb-4">
      <div class="card-header bg-red text-white">
        <i class="fas fa-filter me-2"></i>Filter Laporan
      </div>
      <div class="card-body">
        <form method="get" action="<?= base_url('admin/laporan') ?>">
          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="start_date" class="form-label">Tanggal Mulai</label>
              <input type="date" class="form-control" id="start_date" name="start_date" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
            </div>
            <div class="col-md-4 mb-3">
              <label for="end_date" class="form-label">Tanggal Akhir</label>
              <input type="date" class="form-control" id="end_date" name="end_date" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
            </div>
            <!-- Bagian Filter -->
            <div class="col-md-4 mb-3">
              <label for="jenis_donasi_id" class="form-label">Jenis Donasi</label>
              <select class="form-select" id="jenis_donasi_id" name="jenis_donasi_id">
                <option value="">Semua Jenis Donasi</option>
                <?php foreach ($jenis_donasi as $jenis) : ?>
                  <option value="<?= $jenis->id ?>"
                    <?= (!empty($filter['jenis_donasi_id']) && $filter['jenis_donasi_id'] == $jenis->id) ? 'selected' : '' ?>>
                    <?= $jenis->nama ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-primary me-2">
              <i class="fas fa-search me-1"></i> Filter
            </button>
            <a href="<?= base_url('admin/laporan') ?>" class="btn btn-secondary">
              <i class="fas fa-sync-alt me-1"></i> Reset
            </a>
          </div>
        </form>
      </div>
    </div>

    <!-- Ganti bagian tombol dengan ini -->
    <div class="container mb-4">
      <div class="row justify-content-center g-2">
        <div class="col-auto">
          <button type="button" class="btn btn-secondary" onclick="window.location.href='<?= base_url('admin/lkknu'); ?>'">
            <i class=""></i> Kembali
          </button>
        </div>
        <div class="col-auto">
          <button onclick="printTable()" class="btn btn-primary">
            <i class="fas fa-print me-1"></i> Print
          </button>
        </div>
        <div class="col-auto">
          <button onclick="exportToCSV()" class="btn btn-success">
            <i class="fas fa-file-excel me-1"></i> <span class="d-none d-sm-inline">Export </span>Excel
          </button>
        </div>
        <div class="col-auto">
          <button onclick="exportToPDF()" class="btn btn-danger">
            <i class="fas fa-file-pdf me-1"></i> <span class="d-none d-sm-inline">Export </span>PDF
          </button>
        </div>
      </div>
    </div>

    <div class="table-responsive">
      <table id="laporanKeuangan" class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama/Keterangan</th>
            <th>Penerimaan</th>
            <th>Pengeluaran</th>
            <th>Saldo</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $saldo = $saldo_awal; // Mulai dari saldo awal
          $total_penerimaan = 0;
          $total_pengeluaran = 0;

          foreach ($laporan as $row) {
            // Baris Saldo Awal
            if (isset($row->is_saldo_awal) && $row->is_saldo_awal) {
              echo "<tr>
                    <td>{$no}</td>
                    <td>" . date('d-m-Y', strtotime($row->tanggal)) . "</td>
                    <td>{$row->keterangan}</td>
                    <td>0</td>
                    <td>0</td>
                    <td>" . number_format($row->saldo, 0, ',', '.') . "</td>
                </tr>";
              $no++;
              continue;
            }

            // Baris Transaksi Biasa
            $saldo += $row->penerimaan - $row->pengeluaran;
            $total_penerimaan += $row->penerimaan;
            $total_pengeluaran += $row->pengeluaran;

            echo "<tr>
                <td>{$no}</td>
                <td>" . date('d-m-Y', strtotime($row->tanggal)) . "</td>
                <td>{$row->keterangan}</td>
                <td>" . number_format($row->penerimaan, 0, ',', '.') . "</td>
                <td>" . number_format($row->pengeluaran, 0, ',', '.') . "</td>
                <td>" . number_format($saldo, 0, ',', '.') . "</td>
            </tr>";
            $no++;
          }
          ?>
        </tbody>

        <tfoot>
          <tr>
            <td colspan="3">TOTAL</td>
            <td><?= number_format($total_penerimaan, 0, ',', '.') ?></td>
            <td><?= number_format($total_pengeluaran, 0, ',', '.') ?></td>
            <td><?= number_format($saldo, 0, ',', '.') ?></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>


  <!-- Tambahkan pagination di sini -->
  <div class="d-flex justify-content-center mt-3">
    <?php echo $pagination_links; ?>
  </div>
  </div>

  <!-- jsPDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    function printTable() {
      const printContents = document.getElementById('laporanKeuangan').outerHTML;
      const originalContents = document.body.innerHTML;
      document.body.innerHTML = `
                <html>
                    <head>
                        <title>Laporan Keuangan</title>
                        <style>
                            table { width: 100%; border-collapse: collapse; }
                            th, td { border: 1px solid #000; padding: 8px; text-align: center; }
                            th { background-color: #0c8b00 ; color: white; }
                            tfoot { font-weight: bold; background-color: #f0f0f0; }
                            @media print {
                                @page { size: landscape; }
                            }
                        </style>
                    </head>
                    <body>
                        <h2 style="text-align: center; margin-bottom: 20px;">Laporan Keuangan</h2>
                        ${printContents}
                    </body>
                </html>
            `;
      window.print();
      document.body.innerHTML = originalContents;
    }

    function exportToCSV() {
      let table = document.getElementById("laporanKeuangan");
      let rows = table.querySelectorAll("tr");
      let csv = [];

      rows.forEach(row => {
        let cols = row.querySelectorAll("td, th");
        let rowData = Array.from(cols).map(cell => '"' + cell.innerText.replace(/"/g, '""') + '"').join(",");
        csv.push(rowData);
      });

      let csvFile = new Blob([csv.join("\n")], {
        type: "text/csv"
      });
      let downloadLink = document.createElement("a");
      downloadLink.download = "laporan_keuangan_" + new Date().toISOString().slice(0, 10) + ".csv";
      downloadLink.href = window.URL.createObjectURL(csvFile);
      downloadLink.style.display = "none";
      document.body.appendChild(downloadLink);
      downloadLink.click();
      document.body.removeChild(downloadLink);
    }

    function exportToPDF() {
      const {
        jsPDF
      } = window.jspdf;
      const doc = new jsPDF('landscape');

      // Header
      doc.setFontSize(14);
      doc.text("Laporan Keuangan", 140, 15, null, null, 'center');
      doc.setFontSize(10);
      doc.text("Dicetak pada: " + new Date().toLocaleString(), 140, 22, null, null, 'center');

      // Ambil data dari tabel
      const table = document.getElementById("laporanKeuangan");
      const headers = [];
      const data = [];

      // Ambil header
      const headerRow = table.querySelector("thead tr");
      headerRow.querySelectorAll("th").forEach(th => {
        headers.push(th.innerText);
      });

      // Ambil data
      table.querySelectorAll("tbody tr").forEach(row => {
        const rowData = [];
        row.querySelectorAll("td").forEach(cell => {
          rowData.push(cell.innerText);
        });
        data.push(rowData);
      });

      // Footer Total
      const footerRow = table.querySelector("tfoot tr");
      const footerData = [];
      footerRow.querySelectorAll("td").forEach(cell => {
        footerData.push(cell.innerText);
      });

      // Tampilkan tabel ke PDF
      doc.autoTable({
        head: [headers],
        body: data,
        startY: 30,
        theme: 'grid',
        styles: {
          fontSize: 8,
          halign: 'center',
          cellPadding: 2
        },
        foot: [footerData],
        footStyles: {
          fillColor: [240, 240, 240],
          textColor: 0,
          fontStyle: 'bold'
        }
      });

      doc.save("laporan_keuangan_" + new Date().toISOString().slice(0, 10) + ".pdf");
    }

    $(document).ready(function() {
      $('#laporanKeuangan').DataTable({
        "pageLength": 10, // Jumlah item per halaman
        "dom": '<"top"lf>rt<"bottom"ip>',
        "language": {
          "paginate": {
            "previous": "<i class='fas fa-chevron-left'></i>",
            "next": "<i class='fas fa-chevron-right'></i>"
          },
          "search": "Cari:",
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          "infoEmpty": "Tidak ada data",
          "infoFiltered": "(disaring dari _MAX_ total data)"
        }
      });
    });
  </script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>