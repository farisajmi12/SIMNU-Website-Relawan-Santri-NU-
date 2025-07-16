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

        .badge {
            padding: 0.5em 0.75em;
            font-size: 0.85em;
            font-weight: 500;
        }

        .action-buttons .btn {
            margin-right: 0.3em;
            margin-bottom: 0.3em;
        }

        .badge.bg-success {
            background-color: #0c8b00 !important;
            color: white !important;
        }

        .badge.bg-secondary {
            background-color: #6c757d !important;
            color: white !important;
        }

        .badge {
            color: white !important;
            /* Memastikan semua teks badge putih */
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

        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .action-buttons {
                display: flex;
                flex-wrap: wrap;
            }

            .action-buttons .btn {
                margin-right: 0.3em;
                margin-bottom: 0.3em;
                font-size: 0.8rem;
                padding: 0.25rem 0.5rem;
            }

            .table td,
            .table th {
                white-space: nowrap;
            }
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <h1 class="page-tittle"><?= $title; ?></h1>

        <!-- Notifications -->
        <?= $this->session->flashdata('success'); ?>
        <?= $this->session->flashdata('error'); ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">User Management</h6>
                <button class="btn btn-primary" onclick="openForm()">
                    <i class="fas fa-plus"></i> Tambah User
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td data-label="Nama"><?= $user->name ?></td>
                                    <td data-label="Username"><?= $user->username ?></td>
                                    <td data-label="Email"><?= $user->email ?></td>
                                    <td data-label="No Telepon"><?= $user->no_telepon ?></td>
                                    <td data-label="Role">
                                        <?php
                                        if ($user->role_id == 1) echo 'Admin';
                                        elseif ($user->role_id == 2) echo 'User';
                                        elseif ($user->role_id == 3) echo 'Operator';
                                        ?>
                                    </td>
                                    <td data-label="Status">
                                        <span class="badge bg-<?= $user->is_active ? 'success' : 'secondary' ?>">
                                            <?= $user->is_active ? 'Aktif' : 'Nonaktif' ?>
                                        </span>
                                    </td>
                                    <td data-label="Tindakan" class="action-buttons">
                                        <button class="btn btn-sm btn-warning" onclick="editUser(<?= $user->id ?>)">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger deleteUserBtn"
                                            data-id="<?= $user->id; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteUserModal">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        <a href="<?= base_url('admin/toggle_user/' . $user->id) ?>"
                                            class="btn btn-sm btn-<?= $user->is_active ? 'secondary' : 'info' ?>">
                                            <i class="fas fa-power-off"></i> <?= $user->is_active ? 'Nonaktifkan' : 'Aktifkan' ?>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Form Tambah/Edit User -->
    <div class="modal fade" id="userForm" tabindex="-1" aria-labelledby="userFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/save_user') ?>" method="post">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="formTitle">Tambah User</h5>
                        <button type="button" class="btn-close btn-close-white" onclick="closeForm()"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="user_id">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="name" id="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">No Telepon</label>
                                    <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Role</label>
                                    <select name="role" id="role" class="form-select" required>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>
                                        <option value="3">Operator</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password <small class="text-muted">(biarkan kosong jika tidak diubah)</small></label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeForm()">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah kamu yakin ingin menghapus user ini? Data yang dihapus tidak dapat dikembalikan.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <a href="#" id="confirmDeleteUserBtn" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize modal
        const userFormModal = new bootstrap.Modal(document.getElementById('userForm'));

        function openForm() {
            document.getElementById('formTitle').innerText = 'Tambah User';
            document.getElementById('user_id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('username').value = '';
            document.getElementById('email').value = '';
            document.getElementById('no_telepon').value = '';
            document.getElementById('role').value = '1';
            document.getElementById('password').value = '';
            userFormModal.show();
        }

        function closeForm() {
            userFormModal.hide();
        }

        function editUser(id) {
            fetch("<?= base_url('admin/get_user_by_id') ?>", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: "id=" + id
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('formTitle').innerText = 'Edit User';
                    document.getElementById('user_id').value = data.id;
                    document.getElementById('name').value = data.name;
                    document.getElementById('username').value = data.username;
                    document.getElementById('email').value = data.email;
                    document.getElementById('no_telepon').value = data.no_telepon;
                    document.getElementById('role').value = data.role_id;
                    document.getElementById('password').value = '';
                    userFormModal.show();
                });
        }

        // Delete User Button Handler
        document.addEventListener('DOMContentLoaded', function() {
            const deleteBtns = document.querySelectorAll('.deleteUserBtn');
            deleteBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const deleteLink = "<?= base_url('admin/delete_user/'); ?>" + id;
                    document.getElementById('confirmDeleteUserBtn').setAttribute('href', deleteLink);
                });
            });
        });
    </script>

</body>

</html>