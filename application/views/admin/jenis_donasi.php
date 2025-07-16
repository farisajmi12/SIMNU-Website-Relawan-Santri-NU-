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
    </style>
</head>

<body>

    <div class="container-fluid">
        <!-- Tambahkan tombol Kembali di sini -->
        <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('admin/donasi'); ?>'">
            <i class=""></i> Kembali
        </button>
        <h1 class="page-tittle"><?= $title; ?></h1>

        <!-- Notifikasi -->
        <?php if ($this->session->flashdata('success')) : ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
        <?php elseif ($this->session->flashdata('error')) : ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <!-- Button Tambah -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalJenisDonasi" onclick="resetForm()">
            <i class="fas fa-plus"></i> Tambah Jenis Donasi
        </button>

        <!-- Tabel Data Jenis Donasi -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Jenis Donasi</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($jenis_donasi as $jd) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $jd->nama ?></td>
                                    <td><?= $jd->deskripsi ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-warning"
                                                onclick="editJenisDonasi(<?= htmlspecialchars(json_encode($jd), ENT_QUOTES, 'UTF-8') ?>)"
                                                data-toggle="modal" data-target="#modalJenisDonasi">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger deleteJenisDonasiBtn" data-id="<?= $jd->id ?>" data-toggle="modal" data-target="#deleteJenisDonasiModal">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Jenis Donasi -->
    <div class="modal fade" id="modalJenisDonasi" tabindex="-1" role="dialog" aria-labelledby="modalJenisDonasiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('admin/save_jenis_donasi') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalJenisDonasiLabel">Form Jenis Donasi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="nama">Nama Jenis Donasi</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"></textarea>
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

    <!-- Modal Hapus Jenis Donasi -->
    <div class="modal fade" id="deleteJenisDonasiModal" tabindex="-1" role="dialog" aria-labelledby="deleteJenisDonasiModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus data jenis donasi ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Reset form
        function resetForm() {
            $('#id').val('');
            $('#nama').val('');
            $('#deskripsi').val('');
        }

        // Edit data
        function editJenisDonasi(jenis_donasi) {
            $('#id').val(jenis_donasi.id);
            $('#nama').val(jenis_donasi.nama);
            $('#deskripsi').val(jenis_donasi.deskripsi);
        }

        // Handle delete button click
        $(document).on('click', '.deleteJenisDonasiBtn', function() {
            const jenisDonasiId = $(this).data('id');
            $('#confirmDeleteBtn').attr('href', '<?= base_url("admin/delete_jenis_donasi/") ?>' + jenisDonasiId);
        });
    </script>

</body>

</html>