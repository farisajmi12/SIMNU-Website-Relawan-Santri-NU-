<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
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
        }

        a:hover {
            color: #0c8b00 !important;
        }

        /* Warna hover tab */
        .nav-tabs .nav-link:hover {
            color: #0c8b00 !important;
            opacity: 0.8;
        }

        /* ===== MODAL BUTTON FIXES ===== */
        /* Modal header styling */
        .modal-header {
            background-color: #0c8b00 !important;
            color: white !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        .modal-title {
            color: white !important;
        }

        /* Close button styling */
        .modal-header .btn-close {
            filter: invert(1) brightness(100%) !important;
            opacity: 1 !important;
            background-size: 1.5em !important;
            padding: 0.5rem 0.5rem !important;
            margin: -0.5rem -0.5rem -0.5rem auto !important;
        }
        
        .modal-header .btn-close:hover {
            opacity: 0.75 !important;
        }

        /* Fix untuk modal backdrop */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        /* Fix untuk modal yang tidak mau tutup */
        body.modal-open {
            overflow: hidden;
            padding-right: 0 !important;
        }

        /* Modal footer buttons */
        .modal-footer .btn {
            min-width: 80px;
            padding: 8px 16px;
            font-weight: 500;
            border-radius: 4px;
            transition: all 0.2s ease;
        }

        /* Secondary button (Tutup/Batal) */
        .modal-footer .btn-secondary {
            background-color: #6c757d !important;
            border-color: #6c757d !important;
            color: white !important;
        }

        .modal-footer .btn-secondary:hover {
            background-color: #5a6268 !important;
            border-color: #545b62 !important;
        }

        /* Primary button (Simpan) - FIXED VERSION */
        .modal-footer .btn-primary {
            background-color: #0c8b00 !important;
            border-color: #0c8b00 !important;
            color: white !important;
            display: inline-block !important;
            opacity: 1 !important;
            visibility: visible !important;
        }

        .modal-footer .btn-primary:hover {
            background-color: #0a7a00 !important;
            border-color: #0a7a00 !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .modal-footer .btn-primary:active,
        .modal-footer .btn-primary:focus {
            background-color: #096900 !important;
            border-color: #096900 !important;
            box-shadow: 0 0 0 0.2rem rgba(12, 139, 0, 0.5) !important;
        }

        /* Delete button in delete modal */
        .modal-footer .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        /* Ensure buttons are properly aligned */
        .modal-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
        }

        /* Make sure the modal content is properly styled */
        .modal-content {
            border-radius: 8px !important;
            overflow: hidden !important;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2) !important;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-footer {
                flex-wrap: wrap;
            }

            .modal-footer .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <!-- Tambahkan tombol Kembali di sini -->
        <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('admin/donasi'); ?>'">
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
                <form method="get" action="<?= base_url('admin/pengeluaran') ?>">
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
                        <a href="<?= base_url('admin/pengeluaran') ?>" class="btn btn-secondary">
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
                        <a class="nav-link active" id="pengeluaran_uang-tab" data-bs-toggle="tab" href="#pengeluaran_uang" role="tab">Pengeluaran Uang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pengeluaran_barang-tab" data-bs-toggle="tab" href="#pengeluaran_barang" role="tab">Pengeluaran Barang</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Tab Pengeluaran Uang -->
                    <div class="tab-pane fade show active" id="pengeluaran_uang" role="tabpanel" aria-labelledby="pengeluaran_uang-tab">
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalPengeluaranUang" onclick="resetFormUang()">
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
                                                                    class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalPengeluaranUang">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-danger deletePengeluaranBtn" data-id="<?= $p->id ?>" data-type="uang" data-bs-toggle="modal" data-bs-target="#deletePengeluaranModal">
                                                                    <i class="fas fa-trash"></i>
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
                        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalPengeluaranBarang" onclick="resetFormBarang()">
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
                                                                    class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalPengeluaranBarang">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button class="btn btn-sm btn-danger deletePengeluaranBtn" data-id="<?= $b->id ?>" data-type="barang" data-bs-toggle="modal" data-bs-target="#deletePengeluaranModal">
                                                                    <i class="fas fa-trash"></i>
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
                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-3">
                                <?= $pagination_links ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pengeluaran Uang -->
        <div class="modal fade" id="modalPengeluaranUang" tabindex="-1" aria-labelledby="modalPengeluaranUangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('admin/save_pengeluaran') ?>" method="post" enctype="multipart/form-data" id="formPengeluaranUang">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalPengeluaranUangLabel">Form Pengeluaran Uang</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_uang">
                            <input type="hidden" name="type" value="uang">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_uang">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_uang" name="tanggal" required>
                                    </div>

                                    <div class="form-group mb-3">
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
                                    <div class="form-group mb-3">
                                        <label for="jumlah_uang">Jumlah (Rp)</label>
                                        <input type="text" class="form-control rupiah" id="jumlah_uang" name="jumlah" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="sumber_dana">Sumber Dana</label>
                                        <select class="form-control" id="sumber_dana" name="sumber_dana" required>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Rek Bank NU">Rekening Bank NU</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="keterangan_uang">Keterangan</label>
                                <textarea class="form-control" id="keterangan_uang" name="keterangan" rows="2"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="lampiran_uang">Lampiran</label>
                                <input type="file" class="form-control" id="lampiran_uang" name="lampiran">
                                <small class="text-muted">Format: PDF, JPG, JPEG, PNG (Maks. 2MB)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Pengeluaran Barang -->
        <div class="modal fade" id="modalPengeluaranBarang" tabindex="-1" aria-labelledby="modalPengeluaranBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="<?= base_url('admin/save_pengeluaran') ?>" method="post" enctype="multipart/form-data" id="formPengeluaranBarang">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="modalPengeluaranBarangLabel">Form Pengeluaran Barang</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id_barang">
                            <input type="hidden" name="type" value="barang">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="tanggal_barang">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal_barang" name="tanggal" required>
                                    </div>

                                    <div class="form-group mb-3">
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
                                    <div class="form-group mb-3">
                                        <label for="nama_barang">Nama Barang</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="jumlah_barang">Jumlah</label>
                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
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
                                    <div class="form-group mb-3">
                                        <label for="lampiran_barang">Lampiran</label>
                                        <input type="file" class="form-control" id="lampiran_barang" name="lampiran">
                                        <small class="text-muted">Format: PDF, JPG, JPEG, PNG (Maks. 2MB)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="keterangan_barang">Keterangan</label>
                                <textarea class="form-control" id="keterangan_barang" name="keterangan" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Hapus Pengeluaran -->
        <div class="modal fade" id="deletePengeluaranModal" tabindex="-1" aria-labelledby="deletePengeluaranModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <a href="#" id="confirmDeletePengeluaranBtn" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Lampiran -->
        <div class="modal fade" id="lampiranModal" tabindex="-1" aria-labelledby="lampiranModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="lampiranModalLabel">Lampiran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center" id="lampiranContent">
                        <!-- Lampiran akan dimuat di sini lewat JS -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
        // Inisialisasi variabel modal global
        let pengeluaranUangModal = null;
        let pengeluaranBarangModal = null;
        let lampiranModal = null;
        let deletePengeluaranModal = null;

        $(document).ready(function() {
            // Inisialisasi modal saat dokumen siap
            pengeluaranUangModal = new bootstrap.Modal(document.getElementById('modalPengeluaranUang'));
            pengeluaranBarangModal = new bootstrap.Modal(document.getElementById('modalPengeluaranBarang'));
            lampiranModal = new bootstrap.Modal(document.getElementById('lampiranModal'));
            deletePengeluaranModal = new bootstrap.Modal(document.getElementById('deletePengeluaranModal'));

            // Format Rupiah
            $('.rupiah').on('input', function() {
                var value = $(this).val().replace(/[^0-9]/g, '');
                $(this).val(formatRupiah(value));
            });

            // Handle delete button click
            $(document).on('click', '.deletePengeluaranBtn', function() {
                const id = $(this).data('id');
                const type = $(this).data('type');
                const deleteUrl = '<?= base_url("admin/delete_pengeluaran/") ?>' + type + '/' + id;
                $('#confirmDeletePengeluaranBtn').attr('href', deleteUrl);
            });

            // Fix untuk modal yang tidak mau tutup
            $(document).on('hidden.bs.modal', '.modal', function () {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        });

        // Reset Form Uang
        function resetFormUang() {
            $('#formPengeluaranUang')[0].reset();
            $('#id_uang').val('');
            $('#lampiran_uang').val('');
        }

        // Reset Form Barang
        function resetFormBarang() {
            $('#formPengeluaranBarang')[0].reset();
            $('#id_barang').val('');
            $('#lampiran_barang').val('');
        }

        // Edit Data Uang (VERSI DIPERBAIKI)
        function editDataUang(data) {
            try {
                // Reset form terlebih dahulu
                resetFormUang();
                
                // Isi data ke form
                $('#id_uang').val(data.id);
                $('#tanggal_uang').val(data.tanggal.split('T')[0] || data.tanggal.split(' ')[0]); // Format tanggal ISO atau biasa
                $('#jenis_donasi_id_uang').val(data.jenis_donasi_id);
                $('#jumlah_uang').val(formatRupiah(data.jumlah.toString()));
                $('#sumber_dana').val(data.sumber_dana);
                $('#keterangan_uang').val(data.keterangan);
                
                // Gunakan modal yang sudah diinisialisasi
                pengeluaranUangModal.show();
                
            } catch (error) {
                console.error('Error in editDataUang:', error);
                alert('Terjadi kesalahan saat memuat form edit');
            }
        }

        // Edit Data Barang (VERSI DIPERBAIKI)
        function editDataBarang(data) {
            try {
                // Reset form terlebih dahulu
                resetFormBarang();
                
                // Isi data ke form
                $('#id_barang').val(data.id);
                $('#tanggal_barang').val(data.tanggal.split('T')[0] || data.tanggal.split(' ')[0]); // Format tanggal ISO atau biasa
                $('#jenis_donasi_id_barang').val(data.jenis_donasi_id);
                $('#nama_barang').val(data.nama_barang);
                $('#jumlah_barang').val(data.jumlah);
                $('#satuan').val(data.satuan);
                $('#keterangan_barang').val(data.keterangan);
                
                // Gunakan modal yang sudah diinisialisasi
                pengeluaranBarangModal.show();
                
            } catch (error) {
                console.error('Error in editDataBarang:', error);
                alert('Terjadi kesalahan saat memuat form edit');
            }
        }

        // Tampilkan Lampiran (VERSI DIPERBAIKI)
        function showLampiran(url) {
            try {
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
                
                // Gunakan modal yang sudah diinisialisasi
                lampiranModal.show();
                
            } catch (error) {
                console.error('Error in showLampiran:', error);
                alert('Terjadi kesalahan saat menampilkan lampiran');
            }
        }

        // Format Rupiah helper function
        function formatRupiah(angka) {
            var number_string = angka.toString(),
                sisa = number_string.length % 3,
                rupiah = number_string.substr(0, sisa),
                ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }
            return rupiah;
        }
    </script>
</body>

</html>