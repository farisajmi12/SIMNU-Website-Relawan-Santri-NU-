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
        <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('operator/donasi'); ?>'">
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
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalDonatur" onclick="resetForm()">
            <i class="fas fa-plus"></i> Tambah Donatur
        </button>

        <!-- Tabel Data Donatur -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-striped align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>No</th>
                                <th>NIK/Kode</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Tipe</th>
                                <th>Agama</th>
                                <th>Alamat</th>
                                <th>Kode Pos</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($donatur as $d) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $d->nik_kode ?></td>
                                    <td><?= $d->nama ?></td>
                                    <td><?= ucfirst($d->jenis_kelamin) ?></td>
                                    <td><?= $d->tipe ?></td>
                                    <td><?= $d->agama ?></td>
                                    <td><?= $d->alamat ?></td>
                                    <td><?= $d->kode_pos ?></td>
                                    <td><?= $d->no_hp ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-warning"
                                                onclick="editDonatur(<?= htmlspecialchars(json_encode($d), ENT_QUOTES, 'UTF-8') ?>)"
                                                data-toggle="modal" data-target="#modalDonatur">
                                                <i class="fas fa-edit"></i>
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

    <!-- Modal Donatur -->
    <div class="modal fade" id="modalDonatur" tabindex="-1" role="dialog" aria-labelledby="modalDonaturLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="<?= base_url('operator/save_donatur') ?>" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalDonaturLabel">Form Donatur</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nik_kode">NIK/Kode Donatur</label>
                                    <input type="text" class="form-control" id="nik_kode" name="nik_kode" required>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipe">Tipe Donatur</label>
                                    <select class="form-control" id="tipe" name="tipe" required>
                                        <option value="Individu">Individu</option>
                                        <option value="Institusi">Institusi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="agama">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="kode_pos">Kode Pos</label>
                                    <input type="text" class="form-control" id="kode_pos" name="kode_pos" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                </div>
                            </div>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Reset form
        function resetForm() {
            $('#id').val('');
            $('#nik_kode').val('');
            $('#nama').val('');
            $('#jenis_kelamin').val('pria');
            $('#tipe').val('Individu');
            $('#agama').val('');
            $('#alamat').val('');
            $('#kode_pos').val('');
            $('#no_hp').val('');
        }

        // Edit data
        function editDonatur(donatur) {
            $('#id').val(donatur.id);
            $('#nik_kode').val(donatur.nik_kode);
            $('#nama').val(donatur.nama);
            $('#jenis_kelamin').val(donatur.jenis_kelamin);
            $('#tipe').val(donatur.tipe);
            $('#agama').val(donatur.agama);
            $('#alamat').val(donatur.alamat);
            $('#kode_pos').val(donatur.kode_pos);
            $('#no_hp').val(donatur.no_hp);
        }
    </script>

</body>

</html>