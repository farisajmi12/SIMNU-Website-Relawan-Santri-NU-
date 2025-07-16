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
            /* Tambahkan ini untuk teks hitam */
        }


        /* Tambahkan ini untuk memastikan teks di body tabel hitam */
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
        <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('admin/lkknu'); ?>'">
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

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Penerima Manfaat</h6>
            </div>
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="anak_yatim-tab" data-toggle="tab" href="#anak_yatim" role="tab">Anak Yatim & Piatu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="janda_jompo-tab" data-toggle="tab" href="#janda_jompo" role="tab">Janda & Jompo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="dhuafa-tab" data-toggle="tab" href="#dhuafa" role="tab">Dhuafa</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Tab Anak Yatim -->
                    <div class="tab-pane fade show active" id="anak_yatim" role="tabpanel" aria-labelledby="anak_yatim-tab">
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalAnakYatim" onclick="resetForm()">
                            <i class="fas fa-plus"></i> Tambah Anak Yatim/Piatu
                        </button>

                        <!-- Tabel Anak Yatim -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped align-middle">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Umur</th>
                                        <th>Agama</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Kategori Anak Yatim</th>
                                        <th>Anak Ke</th>
                                        <th>Ibu Kandung</th>
                                        <th>Alamat</th>
                                        <th>Kode pos</th>
                                        <th>No HP/ WhatsApp</th>
                                        <th>Foto Profil</th>
                                        <th>Foto Rumah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($anak_yatim)) : ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($anak_yatim as $a) : ?>
                                            <tr>
                                                <td data-label="No"><?= $no++; ?></td>
                                                <td data-label="NIK"><?= $a->nik; ?></td>
                                                <td data-label="Nama"><?= $a->nama; ?></td>
                                                <td data-label="Jenis Kelamin"><?= ucfirst($a->jenis_kelamin); ?></td>
                                                <td data-label="Umur"><?= $a->umur; ?></td>
                                                <td data-label="Agama"><?= $a->agama; ?></td>
                                                <td data-label="Tempat Tanggal Lahir"><?= $a->ttl; ?></td>
                                                <td data-label="Kategori Anak Yatim"><?= $a->sub_kategori; ?></td>
                                                <td data-label="Anak Ke"><?= $a->anak_ke ?? '-'; ?></td>
                                                <td data-label="Ibu Kandung"><?= $a->ibu_kandung ?? '-'; ?></td>
                                                <td data-label="Alamat"><?= $a->alamat_lengkap ?? '-'; ?></td>
                                                <td data-label="Kode pos"><?= $a->kode_pos ?? '-'; ?></td>
                                                <td data-label="No HP/ WhatsApp"><?= $a->no_hp ?? '-'; ?></td>
                                                <td data-label="Foto Profil">
                                                    <?php if ($a->profile_photo) : ?>
                                                        <img src="<?= base_url('uploads/profile_photos/' . $a->profile_photo); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Foto Rumah">
                                                    <?php if ($a->photo_rumah) : ?>
                                                        <img src="<?= base_url('uploads/photo_rumah/' . $a->photo_rumah); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Aksi">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-warning btn-edit"
                                                            data-toggle="modal" data-target="#modalAnakYatim"
                                                            data-nik="<?= $a->nik ?>"
                                                            data-nama="<?= $a->nama ?>"
                                                            data-jk="<?= $a->jenis_kelamin ?>"
                                                            data-umur="<?= $a->umur ?>"
                                                            data-agama="<?= $a->agama ?>"
                                                            data-ttl="<?= $a->ttl ?>"
                                                            data-sub_kategori="<?= $a->sub_kategori ?>"
                                                            data-anak_ke="<?= $a->anak_ke ?>"
                                                            data-ibu_kandung="<?= $a->ibu_kandung ?>"
                                                            data-alamat="<?= $a->alamat_lengkap ?>"
                                                            data-kode_pos="<?= $a->kode_pos ?>"
                                                            data-no_hp="<?= $a->no_hp ?>"
                                                            data-profile_photo="<?= $a->profile_photo ?>"
                                                            data-photo_rumah="<?= $a->photo_rumah ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger deletePenerimaBtn"
                                                            data-id="<?= $a->nik ?>"
                                                            data-toggle="modal" data-target="#deletePenerimaModal">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="16" class="text-center">Tidak ada data Anak Yatim/Piatu</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Untuk Anak Yatim -->
                            <div class="d-flex justify-content-center mt-3">
                                <?= $pagination_links ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Janda Jompo -->
                    <div class="tab-pane fade" id="janda_jompo" role="tabpanel" aria-labelledby="janda_jompo-tab">
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalJandaJompo" onclick="resetForm()">
                            <i class="fas fa-plus"></i> Tambah Janda/Jompo
                        </button>

                        <!-- Tabel Janda Jompo -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped align-middle">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Umur</th>
                                        <th>Agama</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Kategori Janda Jompo</th>
                                        <th>Alamat</th>
                                        <th>Kode Pos</th>
                                        <th>No HP/WhatsApp</th>
                                        <th>Foto Profil</th>
                                        <th>Foto Rumah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($janda_jompo)) : ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($janda_jompo as $jj) : ?>
                                            <tr>
                                                <td data-label="No"><?= $no++; ?></td>
                                                <td data-label="NIK"><?= $jj->nik; ?></td>
                                                <td data-label="Nama"><?= $jj->nama; ?></td>
                                                <td data-label="Jenis Kelamin"><?= ucfirst($jj->jenis_kelamin); ?></td>
                                                <td data-label="Umur"><?= $jj->umur; ?></td>
                                                <td data-label="Agama"><?= $jj->agama; ?></td>
                                                <td data-label="Tempat, Tanggal Lahir"><?= $jj->ttl; ?></td>
                                                <td data-label="Kategori"><?= $jj->sub_kategori; ?></td>
                                                <td data-label="Alamat"><?= $jj->alamat_lengkap ?? '-'; ?></td>
                                                <td data-label="Kode pos"><?= $jj->kode_pos ?? '-'; ?></td>
                                                <td data-label="No HP/ WhatsApp"><?= $jj->no_hp ?? '-'; ?></td>
                                                <td data-label="Foto Profil">
                                                    <?php if ($jj->profile_photo) : ?>
                                                        <img src="<?= base_url('uploads/profile_photos/' . $jj->profile_photo); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Foto Rumah">
                                                    <?php if ($jj->photo_rumah) : ?>
                                                        <img src="<?= base_url('uploads/photo_rumah/' . $jj->photo_rumah); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Aksi">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-warning btn-edit"
                                                            data-toggle="modal" data-target="#modalJandaJompo"
                                                            data-nik="<?= $jj->nik ?>"
                                                            data-nama="<?= $jj->nama ?>"
                                                            data-jk="<?= $jj->jenis_kelamin ?>"
                                                            data-umur="<?= $jj->umur ?>"
                                                            data-agama="<?= $jj->agama ?>"
                                                            data-ttl="<?= $jj->ttl ?>"
                                                            data-sub_kategori="<?= $jj->sub_kategori ?>"
                                                            data-alamat="<?= $jj->alamat_lengkap ?>"
                                                            data-kode_pos="<?= $jj->kode_pos ?>"
                                                            data-no_hp="<?= $jj->no_hp ?>"
                                                            data-profile_photo="<?= $jj->profile_photo ?>"
                                                            data-photo_rumah="<?= $jj->photo_rumah ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger deletePenerimaBtn"
                                                            data-id="<?= $jj->nik ?>"
                                                            data-toggle="modal" data-target="#deletePenerimaModal">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="14" class="text-center">Tidak ada data Janda/Jompo</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Untuk Janda Jompo -->
                            <div class="d-flex justify-content-center mt-3">
                                <?= $pagination_links ?>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Dhuafa -->
                    <div class="tab-pane fade" id="dhuafa" role="tabpanel" aria-labelledby="dhuafa-tab">
                        <!-- Button Tambah -->
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalDhuafa" onclick="resetForm()">
                            <i class="fas fa-plus"></i> Tambah Dhuafa
                        </button>

                        <!-- Tabel Dhuafa -->
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped align-middle">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Umur</th>
                                        <th>Agama</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Kategori Dhuafa</th>
                                        <th>Alamat</th>
                                        <th>Kode Pos</th>
                                        <th>No HP/WhatsApp</th>
                                        <th>Foto Profil</th>
                                        <th>Foto Rumah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($dhuafa)) : ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($dhuafa as $d) : ?>
                                            <tr>
                                                <td data-label="No"><?= $no++; ?></td>
                                                <td data-label="NIK"><?= $d->nik; ?></td>
                                                <td data-label="Nama"><?= $d->nama; ?></td>
                                                <td data-label="Jenis Kelamin"><?= ucfirst($d->jenis_kelamin); ?></td>
                                                <td data-label="Umur"><?= $d->umur; ?></td>
                                                <td data-label="Agama"><?= $d->agama; ?></td>
                                                <td data-label="Tempat, Tanggal Lahir"><?= $d->ttl; ?></td>
                                                <td data-label="Kategori"><?= $d->sub_kategori; ?></td>
                                                <td data-label="Alamat"><?= $d->alamat_lengkap ?? '-'; ?></td>
                                                <td data-label="Kode pos"><?= $d->kode_pos ?? '-'; ?></td>
                                                <td data-label="No HP/ WhatsApp"><?= $d->no_hp ?? '-'; ?></td>
                                                <td data-label="Foto Profil">
                                                    <?php if ($d->profile_photo) : ?>
                                                        <img src="<?= base_url('uploads/profile_photos/' . $d->profile_photo); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Foto Rumah">
                                                    <?php if ($d->photo_rumah) : ?>
                                                        <img src="<?= base_url('uploads/photo_rumah/' . $d->photo_rumah); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Kategori"><?= $d->sub_kategori; ?></td>
                                                <td data-label="Foto Profil">
                                                    <?php if ($d->profile_photo) : ?>
                                                        <img src="<?= base_url('uploads/profile_photos/' . $d->profile_photo); ?>" class="img-thumbnail">
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">No Photo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td data-label="Aksi">
                                                    <div class="btn-group">
                                                        <a href="#" class="btn btn-sm btn-warning btn-edit"
                                                            data-toggle="modal" data-target="#modalDhuafa"
                                                            data-nik="<?= $d->nik ?>"
                                                            data-nama="<?= $d->nama ?>"
                                                            data-jk="<?= $d->jenis_kelamin ?>"
                                                            data-umur="<?= $d->umur ?>"
                                                            data-agama="<?= $d->agama ?>"
                                                            data-ttl="<?= $d->ttl ?>"
                                                            data-sub_kategori="<?= $d->sub_kategori ?>"
                                                            data-alamat="<?= $d->alamat_lengkap ?>"
                                                            data-kode_pos="<?= $d->kode_pos ?>"
                                                            data-no_hp="<?= $d->no_hp ?>"
                                                            data-profile_photo="<?= $d->profile_photo ?>"
                                                            data-photo_rumah="<?= $d->photo_rumah ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-danger deletePenerimaBtn"
                                                            data-id="<?= $d->nik ?>"
                                                            data-toggle="modal" data-target="#deletePenerimaModal">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="14" class="text-center">Tidak ada data Dhuafa</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <!-- Untuk Dhuafa -->
                            <div class="d-flex justify-content-center mt-3">
                                <?= $pagination_links ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Anak Yatim -->
        <div class="modal fade" id="modalAnakYatim" tabindex="-1" role="dialog" aria-labelledby="modalAnakYatimLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('admin/save_penerima'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAnakYatimLabel">Form Anak Yatim/Piatu</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <!-- ID untuk edit -->
                            <input type="hidden" name="id_penerima" id="id_penerima">
                            <input type="hidden" name="kategori" value="anak_yatim">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="umur">Umur</label>
                                        <input type="number" name="umur" id="umur" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <input type="text" name="agama" id="agama" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ttl">Tempat, Tanggal Lahir</label>
                                        <input type="text" name="ttl" id="ttl" class="form-control" placeholder="Contoh: Jakarta, 01 Januari 2000" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_kategori">Kategori Anak Yatim</label>
                                        <select name="sub_kategori" id="sub_kategori" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Yatim">Yatim</option>
                                            <option value="Piatu">Piatu</option>
                                            <option value="Yatim & Piatu">Yatim & Piatu</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="anak_ke">Anak Ke-</label>
                                        <input type="number" name="anak_ke" id="anak_ke" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="ibu_kandung">Nama Ibu Kandung</label>
                                        <input type="text" name="ibu_kandung" id="ibu_kandung" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">Nomor HP/WhatsApp</label>
                                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                                        pattern="^(\+62|62|0)[8][1-9][0-9]{6,9}$"
                                        title="Masukkan nomor Indonesia yang valid (contoh: 08123456789, +628123456789, atau 628123456789)"
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="profile_photo">Foto Profil</label>
                                <input type="file" name="profile_photo" id="profile_photo" class="form-control-file">
                                <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                            </div>

                            <div class="form-group">
                                <label for="photo_rumah">Foto Rumah/Tempat Tinggal</label>
                                <input type="file" name="photo_rumah" id="photo_rumah" class="form-control-file">
                                <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Janda Jompo -->
        <div class="modal fade" id="modalJandaJompo" tabindex="-1" role="dialog" aria-labelledby="modalJandaJompoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('admin/save_penerima'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalJandaJompoLabel">Form Janda/Jompo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_penerima" id="id_penerima">
                            <input type="hidden" name="kategori" value="janda_jompo">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="umur">Umur</label>
                                        <input type="number" name="umur" id="umur" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <input type="text" name="agama" id="agama" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ttl">Tempat, Tanggal Lahir</label>
                                        <input type="text" name="ttl" id="ttl" class="form-control" placeholder="Contoh: Jakarta, 01 Januari 1970" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_kategori">Kategori Janda Jompo</label>
                                        <select name="sub_kategori" id="sub_kategori" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Cerai">Cerai</option>
                                            <option value="Ditinggal Mati">Ditinggal Mati</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_photo">Foto Profil</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="form-control-file">
                                        <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">Nomor HP/WhatsApp</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control"
                                            pattern="^(\+62|62|0)[8][1-9][0-9]{6,9}$"
                                            title="Masukkan nomor Indonesia yang valid (contoh: 08123456789, +628123456789, atau 628123456789)"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo_rumah">Foto Rumah/Tempat Tinggal</label>
                                <input type="file" name="photo_rumah" id="photo_rumah" class="form-control-file">
                                <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Dhuafa -->
        <div class="modal fade" id="modalDhuafa" tabindex="-1" role="dialog" aria-labelledby="modalDhuafaLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form action="<?= base_url('admin/save_penerima'); ?>" method="POST" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDhuafaLabel">Form Dhuafa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_penerima" id="id_penerima">
                            <input type="hidden" name="kategori" value="dhuafa">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK</label>
                                        <input type="text" name="nik" id="nik" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" name="nama" id="nama" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="umur">Umur</label>
                                        <input type="number" name="umur" id="umur" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="agama">Agama</label>
                                        <input type="text" name="agama" id="agama" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ttl">Tempat, Tanggal Lahir</label>
                                        <input type="text" name="ttl" id="ttl" class="form-control" placeholder="Contoh: Jakarta, 01 Januari 1980" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="sub_kategori">Kategori Janda Jompo</label>
                                        <select name="sub_kategori" id="sub_kategori" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Pengangguran">Pengangguran</option>
                                            <option value="Tua Renta">Tua Renta</option>
                                            <option value="Fakir">Fakir</option>
                                            <option value="Miskin">Miskin</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="profile_photo">Foto Profil</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="form-control-file">
                                        <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="alamat_lengkap">Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" id="alamat_lengkap" class="form-control" rows="3" required></textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kode_pos">Kode Pos</label>
                                        <input type="text" name="kode_pos" id="kode_pos" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_hp">Nomor HP/WhatsApp</label>
                                        <input type="text" name="no_hp" id="no_hp" class="form-control"
                                            pattern="^(\+62|62|0)[8][1-9][0-9]{6,9}$"
                                            title="Masukkan nomor Indonesia yang valid (contoh: 08123456789, +628123456789, atau 628123456789)"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="photo_rumah">Foto Rumah/Tempat Tinggal</label>
                                <input type="file" name="photo_rumah" id="photo_rumah" class="form-control-file">
                                <small class="text-muted">Maksimal 2MB (JPG/PNG)</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="deletePenerimaModal" tabindex="-1" role="dialog" aria-labelledby="deletePenerimaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus</a>
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
        // Reset form untuk Tambah Data
        function resetForm() {
            document.getElementById('id_penerima').value = '';
            document.getElementById('nik').value = '';
            document.getElementById('nama').value = '';
            document.getElementById('jenis_kelamin').value = '';
            document.getElementById('umur').value = '';
            document.getElementById('agama').value = '';
            document.getElementById('ttl').value = '';
            document.getElementById('sub_kategori').value = '';
            document.getElementById('anak_ke').value = '';
            document.getElementById('ibu_kandung').value = '';
            document.getElementById('alamat_lengkap').value = '';
            document.getElementById('kode_pos').value = '';
            document.getElementById('no_hp').value = '';
            document.getElementById('profile_photo').value = '';
            document.getElementById('photo_rumah').value = '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Validasi nomor HP Indonesia
            const noHpInputs = document.querySelectorAll('input[name="no_hp"]');

            noHpInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const phoneNumber = this.value;
                    const indonesianPhoneRegex = /^(\+62|62|0)[8][1-9][0-9]{6,9}$/;

                    if (!indonesianPhoneRegex.test(phoneNumber)) {
                        alert('Masukkan nomor Indonesia yang valid (contoh: 08123456789, +628123456789, atau 628123456789)');
                        this.focus();
                        this.value = '';
                    }
                });
            });

            $(document).ready(function() {
                // Handle delete button click
                $(document).on('click', '.deletePenerimaBtn', function() {
                    const nik = $(this).data('id');
                    $('#confirmDeleteBtn').attr('href', '<?= base_url("admin/delete_penerima/") ?>' + nik);
                });

                // Ambil semua tombol edit
                const editButtons = document.querySelectorAll('.btn-edit');

                editButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        // Ambil target modal dari atribut data-target
                        const targetModal = this.getAttribute('data-target');

                        // Isi data berdasarkan modal yang dituju
                        if (targetModal === '#modalAnakYatim') {
                            // Untuk form Anak Yatim
                            document.querySelector('#modalAnakYatim #id_penerima').value = this.getAttribute('data-nik');
                            document.querySelector('#modalAnakYatim #nik').value = this.getAttribute('data-nik');
                            document.querySelector('#modalAnakYatim #nama').value = this.getAttribute('data-nama');
                            document.querySelector('#modalAnakYatim #jenis_kelamin').value = this.getAttribute('data-jk');
                            document.querySelector('#modalAnakYatim #umur').value = this.getAttribute('data-umur');
                            document.querySelector('#modalAnakYatim #agama').value = this.getAttribute('data-agama');
                            document.querySelector('#modalAnakYatim #ttl').value = this.getAttribute('data-ttl');
                            document.querySelector('#modalAnakYatim #sub_kategori').value = this.getAttribute('data-sub_kategori');
                            document.querySelector('#modalAnakYatim #anak_ke').value = this.getAttribute('data-anak_ke');
                            document.querySelector('#modalAnakYatim #ibu_kandung').value = this.getAttribute('data-ibu_kandung');
                            document.querySelector('#modalAnakYatim #alamat_lengkap').value = this.getAttribute('data-alamat');
                            document.querySelector('#modalAnakYatim #kode_pos').value = this.getAttribute('data-kode_pos');
                            document.querySelector('#modalAnakYatim #no_hp').value = this.getAttribute('data-no_hp');
                        } else if (targetModal === '#modalJandaJompo') {
                            // Untuk form Janda Jompo
                            document.querySelector('#modalJandaJompo #id_penerima').value = this.getAttribute('data-nik');
                            document.querySelector('#modalJandaJompo #nik').value = this.getAttribute('data-nik');
                            document.querySelector('#modalJandaJompo #nama').value = this.getAttribute('data-nama');
                            document.querySelector('#modalJandaJompo #jenis_kelamin').value = this.getAttribute('data-jk');
                            document.querySelector('#modalJandaJompo #umur').value = this.getAttribute('data-umur');
                            document.querySelector('#modalJandaJompo #agama').value = this.getAttribute('data-agama');
                            document.querySelector('#modalJandaJompo #ttl').value = this.getAttribute('data-ttl');
                            document.querySelector('#modalJandaJompo #sub_kategori').value = this.getAttribute('data-sub_kategori');
                            document.querySelector('#modalJandaJompo #alamat_lengkap').value = this.getAttribute('data-alamat');
                            document.querySelector('#modalJandaJompo #kode_pos').value = this.getAttribute('data-kode_pos');
                            document.querySelector('#modalJandaJompo #no_hp').value = this.getAttribute('data-no_hp');
                        } else if (targetModal === '#modalDhuafa') {
                            // Untuk form Dhuafa
                            document.querySelector('#modalDhuafa #id_penerima').value = this.getAttribute('data-nik');
                            document.querySelector('#modalDhuafa #nik').value = this.getAttribute('data-nik');
                            document.querySelector('#modalDhuafa #nama').value = this.getAttribute('data-nama');
                            document.querySelector('#modalDhuafa #jenis_kelamin').value = this.getAttribute('data-jk');
                            document.querySelector('#modalDhuafa #umur').value = this.getAttribute('data-umur');
                            document.querySelector('#modalDhuafa #agama').value = this.getAttribute('data-agama');
                            document.querySelector('#modalDhuafa #ttl').value = this.getAttribute('data-ttl');
                            document.querySelector('#modalDhuafa #sub_kategori').value = this.getAttribute('data-sub_kategori');
                            document.querySelector('#modalDhuafa #alamat_lengkap').value = this.getAttribute('data-alamat');
                            document.querySelector('#modalDhuafa #kode_pos').value = this.getAttribute('data-kode_pos');
                            document.querySelector('#modalDhuafa #no_hp').value = this.getAttribute('data-no_hp');
                        }

                        // Reset file inputs di semua modal
                        if (document.querySelector(targetModal + ' #profile_photo')) {
                            document.querySelector(targetModal + ' #profile_photo').value = '';
                        }
                        if (document.querySelector(targetModal + ' #photo_rumah')) {
                            document.querySelector(targetModal + ' #photo_rumah').value = '';
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>