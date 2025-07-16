<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .table th {
            background-color: #0c8b00;
            color: #fff;
            text-align: center;
        }

        .table td {
            vertical-align: middle;
            color: #000 !important;
        }

        .table tbody {
            color: #000 !important;
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

        .page-tittle {
            font-weight: 700;
            font-size: 2.5rem;
            color: #ffffff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
            margin-bottom: 40px;
        }

        .img-thumbnail {
            max-width: 50px;
            height: auto;
        }

        #lampiranModal .modal-body {
            max-height: 80vh;
            overflow-y: auto;
        }

        .rupiah {
            text-align: right;
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

        .pagination {
            justify-content: center;
        }

        .page-item.active .page-link {
            background-color: #0c8b00;
            border-color: #0c8b00;
        }

        .page-link {
            color: #0c8b00;
        }

        .page-link:hover {
            color: #6d0000;
        }


        /* Gaya dasar tombol */
        .btn.btn-primary {
            background-color: #f9fcfa !important;
            border-color: #f9fcfa !important;
            color: #666262 !important;
            font-weight: bold !important;
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

        /* Warna teks tab biasa */
        .nav-tabs .nav-link {
            color: #666262 !important;
            font-weight: bold !important;
        }

        /* Warna teks tab aktif */
        .nav-tabs .nav-link.active {
            color: #0c8b00 !important;
            font-weight: bold !important;
            border-bottom: 2px solid #0c8b00 !important;
            /* Garis bawah tab aktif */
        }

        a:hover {
            color: #0c8b00 !important;
        }

        /* Warna hover tab */
        .nav-tabs .nav-link:hover {
            color: #0c8b00 !important;
            opacity: 0.8;
            /* Sedikit transparan saat hover */
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <!-- Tambahkan tombol Kembali di sini -->
        <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('operator/donasi'); ?>'">
            <i class=""></i> Kembali
        </button>

        <h1 class="page-tittle"><?= $title; ?></h1>

        <!-- Flashdata message -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php endif; ?>

        <!-- Filter Section -->
        <div class="card mb-4 filter-card">
            <div class="card-header bg-red text-white">
                <i class="fas fa-filter me-2"></i>Filter Data
            </div>
            <div class="card-body">
                <form method="get" action="<?= base_url('operator/pengeluaran') ?>">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" value="<?= $filter['start_date'] ?? '' ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" value="<?= $filter['end_date'] ?? '' ?>">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="jenis_donasi_id" class="form-label">Jenis Donasi</label>
                            <select class="form-select" id="jenis_donasi_id" name="jenis_donasi_id">
                                <option value="">Semua Jenis</option>
                                <?php foreach ($jenis_donasi as $jd) : ?>
                                    <option value="<?= $jd->id ?>" <?= isset($filter['jenis_donasi_id']) && $filter['jenis_donasi_id'] == $jd->id ? 'selected' : '' ?>>
                                        <?= $jd->nama ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-search me-1"></i> Filter
                        </button>
                        <a href="<?= base_url('operator/pengeluaran') ?>" class="btn btn-secondary">
                            <i class="fas fa-sync-alt me-1"></i> Reset
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pengeluaran</h6>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pengeluaran_uang-tab" data-toggle="tab" href="#pengeluaran_uang" role="tab">Pengeluaran Uang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pengeluaran_barang-tab" data-toggle="tab" href="#pengeluaran_barang" role="tab">Pengeluaran Barang</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Tab Pengeluaran Uang -->
                    <div class="tab-pane fade show active" id="pengeluaran_uang" role="tabpanel" aria-labelledby="pengeluaran_uang-tab">
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalPengeluaranUang" onclick="resetFormUang()">
                            <i class="fas fa-plus"></i> Tambah Pengeluaran Uang
                        </button>

                        <!-- Tabel Pengeluaran Uang -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran Uang</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped align-middle">
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Donasi</th>
                                                <th>Jumlah</th>
                                                <th>Sumber Dana</th>
                                                <th>Keterangan</th>
                                                <th>Lampiran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($pengeluaran_uang)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($pengeluaran_uang as $p) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= date('d-m-Y', strtotime($p->tanggal)) ?></td>
                                                        <td><?= $p->jenis_donasi ?></td>
                                                        <td class="text-right">Rp <?= number_format($p->jumlah, 0, ',', '.') ?></td>
                                                        <td><?= $p->sumber_dana ?></td>
                                                        <td><?= $p->keterangan ?></td>
                                                        <td>
                                                            <?php if (!empty($p->lampiran)) : ?>
                                                                <a href="#" onclick="showLampiran('<?= base_url($p->lampiran) ?>')">
                                                                    <img src="<?= base_url($p->lampiran) ?>" alt="Lampiran" width="50" class="img-thumbnail">
                                                                </a>
                                                            <?php else : ?>
                                                                -
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button onclick="editDataUang(<?= htmlspecialchars(json_encode($p), ENT_QUOTES, 'UTF-8') ?>)"
                                                                    class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalPengeluaranUang">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Tidak ada data Pengeluaran Uang</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-3">
                                <?= $pagination_links ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pengeluaran Barang -->
                    <div class="tab-pane fade" id="pengeluaran_barang" role="tabpanel" aria-labelledby="pengeluaran_barang-tab">
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalPengeluaranBarang" onclick="resetFormBarang()">
                            <i class="fas fa-plus"></i> Tambah Pengeluaran Barang
                        </button>

                        <!-- Tabel Pengeluaran Barang -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Pengeluaran Barang</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped align-middle">
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Jenis Donasi</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Keterangan</th>
                                                <th>Lampiran</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($pengeluaran_barang)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($pengeluaran_barang as $b) : ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= date('d-m-Y', strtotime($b->tanggal)) ?></td>
                                                        <td><?= $b->jenis_donasi ?></td>
                                                        <td><?= $b->nama_barang ?></td>
                                                        <td><?= $b->jumlah ?></td>
                                                        <td><?= $b->satuan ?></td>
                                                        <td><?= $b->keterangan ?></td>
                                                        <td>
                                                            <?php if (!empty($b->lampiran)) : ?>
                                                                <a href="#" onclick="showLampiran('<?= base_url($b->lampiran) ?>')">
                                                                    <img src="<?= base_url($b->lampiran) ?>" alt="Lampiran" width="50" class="img-thumbnail">
                                                                </a>
                                                            <?php else : ?>
                                                                -
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button onclick="editDataBarang(<?= htmlspecialchars(json_encode($b), ENT_QUOTES, 'UTF-8') ?>)"
                                                                    class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalPengeluaranBarang">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="9" class="text-center">Tidak ada data Pengeluaran Barang</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            <?= $pagination_links ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pengeluaran Uang -->
        <div class="modal fade" id="modalPengeluaranUang" tabindex="-1" role="dialog" aria-labelledby="modalPengeluaranUangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('operator/save_pengeluaran') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPengeluaranUangLabel">Form Pengeluaran Uang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_uang">
                            <input type="hidden" name="type" value="uang">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_uang">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_uang" name="tanggal" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_donasi_id_uang">Jenis Donasi</label>
                                        <select class="form-control" id="jenis_donasi_id_uang" name="jenis_donasi_id" required>
                                            <option value="">Pilih Jenis Donasi</option>
                                            <?php foreach ($jenis_donasi as $jd) : ?>
                                                <option value="<?= $jd->id ?>"><?= $jd->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jumlah_uang">Jumlah (Rp)</label>
                                        <input type="text" class="form-control rupiah" id="jumlah_uang" name="jumlah" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sumber_dana">Sumber Dana</label>
                                        <select class="form-control" id="sumber_dana" name="sumber_dana" required>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Rek Bank NU">Rekening Bank NU</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan_uang">Keterangan</label>
                                <textarea class="form-control" id="keterangan_uang" name="keterangan" rows="2"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="lampiran_uang">Lampiran</label>
                                <input type="file" class="form-control-file" id="lampiran_uang" name="lampiran">
                                <small class="text-muted">Format: PDF, JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Pengeluaran Barang -->
        <div class="modal fade" id="modalPengeluaranBarang" tabindex="-1" role="dialog" aria-labelledby="modalPengeluaranBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('operator/save_pengeluaran') ?>" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPengeluaranBarangLabel">Form Pengeluaran Barang</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_barang">
                            <input type="hidden" name="type" value="barang">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal_barang">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_barang" name="tanggal" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_donasi_id_barang">Jenis Donasi</label>
                                        <select class="form-control" id="jenis_donasi_id_barang" name="jenis_donasi_id" required>
                                            <option value="">Pilih Jenis Donasi</option>
                                            <?php foreach ($jenis_donasi as $jd) : ?>
                                                <option value="<?= $jd->id ?>"><?= $jd->nama ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_barang">Jumlah</label>
                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="satuan">Satuan</label>
                                        <select class="form-control" id="satuan" name="satuan" required>
                                            <option value="">Pilih Satuan</option>
                                            <option value="Kg">Kg</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Pcs">Pcs</option>
                                            <option value="Unit">Unit</option>
                                            <option value="Dus">Dus</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lampiran_barang">Lampiran</label>
                                        <input type="file" class="form-control-file" id="lampiran_barang" name="lampiran">
                                        <small class="text-muted">Format: PDF, JPG, JPEG, PNG (Maks. 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="keterangan_barang">Keterangan</label>
                                <textarea class="form-control" id="keterangan_barang" name="keterangan" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Lampiran -->
        <div class="modal fade" id="lampiranModal" tabindex="-1" aria-labelledby="lampiranModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lampiranModalLabel">Lampiran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="lampiranContent">
                        <!-- Lampiran akan dimuat di sini lewat JS -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Format Rupiah
        $(document).ready(function() {
            $('.rupiah').on('input', function() {
                var value = $(this).val().replace(/[^0-9]/g, '');
                $(this).val(formatRupiah(value));
            });

            function formatRupiah(angka) {
                var number_string = angka.replace(/[^,\d]/g, '').toString(),
                    split = number_string.split(','),
                    sisa = split[0].length % 3,
                    rupiah = split[0].substr(0, sisa),
                    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                return rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            }
        });

        // Reset Form Uang
        function resetFormUang() {
            $('#id_uang').val('');
            $('#tanggal_uang').val('');
            $('#jenis_donasi_id_uang').val('');
            $('#jumlah_uang').val('');
            $('#sumber_dana').val('Tunai');
            $('#keterangan_uang').val('');
            $('#lampiran_uang').val('');
        }

        // Reset Form Barang
        function resetFormBarang() {
            $('#id_barang').val('');
            $('#tanggal_barang').val('');
            $('#jenis_donasi_id_barang').val('');
            $('#nama_barang').val('');
            $('#jumlah_barang').val('');
            $('#satuan').val('');
            $('#keterangan_barang').val('');
            $('#lampiran_barang').val('');
        }

        // Edit Data Uang
        function editDataUang(data) {
            $('#id_uang').val(data.id);
            $('#tanggal_uang').val(data.tanggal);
            $('#jenis_donasi_id_uang').val(data.jenis_donasi_id);
            $('#jumlah_uang').val(data.jumlah);
            $('#sumber_dana').val(data.sumber_dana);
            $('#keterangan_uang').val(data.keterangan);

            // Show modal
            $('#modalPengeluaranUang').modal('show');
        }

        // Edit Data Barang
        function editDataBarang(data) {
            $('#id_barang').val(data.id);
            $('#tanggal_barang').val(data.tanggal);
            $('#jenis_donasi_id_barang').val(data.jenis_donasi_id);
            $('#nama_barang').val(data.nama_barang);
            $('#jumlah_barang').val(data.jumlah);
            $('#satuan').val(data.satuan);
            $('#keterangan_barang').val(data.keterangan);

            // Show modal
            $('#modalPengeluaranBarang').modal('show');
        }

        // Tampilkan Lampiran
        function showLampiran(url) {
            const ext = url.split('.').pop().toLowerCase();
            let content = '';

            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(ext)) {
                content = `<img src="${url}" class="img-fluid rounded" alt="Lampiran">`;
            } else if (ext === 'pdf') {
                content = `<embed src="${url}" type="application/pdf" width="100%" height="500px"/>`;
            } else {
                content = `<a href="${url}" class="btn btn-primary" target="_blank">Unduh Lampiran</a>`;
            }

            $('#lampiranContent').html(content);
            const modal = new bootstrap.Modal(document.getElementById('lampiranModal'));
            modal.show();
        }
    </script>
</body>

</html>