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

        .action-buttons .btn {
            margin-right: 0.3em;
            margin-bottom: 0.3em;
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
        <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <?= $this->session->flashdata('message'); ?>

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Role Management</h6>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRoleModal">
                    <i class="fas fa-plus"></i> Add New Role
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="role-table" width="100%" cellspacing="0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Role</th>
                                <th width="25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($role as $r) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $r['role']; ?></td>
                                    <td class="action-buttons">
                                        <a href="<?= base_url('admin/roleaccess/') . $r['id']; ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-key"></i> Access
                                        </a>
                                        <button class="btn btn-sm btn-success editRoleBtn"
                                            data-id="<?= $r['id']; ?>"
                                            data-role="<?= $r['role']; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#newRoleModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm btn-danger deleteRoleBtn"
                                            data-id="<?= $r['id']; ?>"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deleteRoleModal">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add/Edit Role Modal -->
    <div class="modal fade" id="newRoleModal" tabindex="-1" aria-labelledby="newRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('admin/saveRole'); ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="role" name="role" placeholder="Enter role name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Role Modal -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this role? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="#" id="confirmDeleteRoleBtn" class="btn btn-danger">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Edit Role Button Handler
            $(document).on('click', '.editRoleBtn', function() {
                const id = $(this).data('id');
                const role = $(this).data('role');
                $('#id').val(id);
                $('#role').val(role);
                $('#newRoleModalLabel').text('Edit Role');
            });

            // Reset modal when closed
            $('#newRoleModal').on('hidden.bs.modal', function() {
                $('#id').val('');
                $('#role').val('');
                $('#newRoleModalLabel').text('Add New Role');
            });

            // Delete Role Button Handler
            $('.deleteRoleBtn').click(function() {
                const id = $(this).data('id');
                const deleteUrl = "<?= base_url('admin/deleteRole/'); ?>" + id;
                $('#confirmDeleteRoleBtn').attr('href', deleteUrl);
            });
        });
    </script>

</body>

</html>