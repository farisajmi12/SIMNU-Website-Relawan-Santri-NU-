<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="page-tittle"><?= $title; ?></h1>

    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <?= $this->session->flashdata('message'); ?>

    <style>
        .table thead th {
            background-color: #0c8b00 !important;
            color: #fff !important;
            text-align: center !important;
            border-color: #0c8b00 !important;
        }

        .table td {
            vertical-align: middle !important;
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

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubMenuModal">
                <i class="fas fa-plus"></i> Add New SubMenu
            </a>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Menu</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($subMenu as $sm): ?>
                            <tr>
                                <th scope="row" data-label="#"><?= $i++; ?></th>
                                <td data-label="Title"><?= $sm['title']; ?></td>
                                <td data-label="Menu"><?= $sm['menu']; ?></td>
                                <td data-label="URL"><?= $sm['url']; ?></td>
                                <td data-label="Icon"><?= $sm['icon']; ?></td>
                                <td data-label="Active"><?= $sm['is_active'] ? 'Yes' : 'No'; ?></td>
                                <td data-label="Action">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-warning editSubmenuBtn"
                                            data-id="<?= $sm['id']; ?>"
                                            data-title="<?= $sm['title']; ?>"
                                            data-menu_id="<?= $sm['menu_id']; ?>"
                                            data-url="<?= $sm['url']; ?>"
                                            data-icon="<?= $sm['icon']; ?>"
                                            data-is_active="<?= $sm['is_active']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#editSubMenuModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger deleteSubmenuBtn"
                                            data-id="<?= $sm['id']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#deleteSubMenuModal">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
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
<!-- /.container-fluid -->

<!-- MODAL: Add -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Sub Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="mb-3">
                        <label>Menu</label>
                        <select name="menu_id" class="form-control" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m): ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>URL</label>
                        <input type="text" name="url" class="form-control" placeholder="URL" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control" placeholder="Icon">
                    </div>
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" checked>
                        <label class="form-check-label" for="is_active">Active?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: Edit -->
<div class="modal fade" id="editSubMenuModal" tabindex="-1" aria-labelledby="editSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('menu/save_submenu'); ?>" method="post">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit_title" class="form-control" placeholder="Title" required>
                    </div>
                    <div class="mb-3">
                        <label>Menu</label>
                        <select name="menu_id" id="edit_menu_id" class="form-control" required>
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m): ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>URL</label>
                        <input type="text" name="url" id="edit_url" class="form-control" placeholder="URL" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" name="icon" id="edit_icon" class="form-control" placeholder="Icon">
                    </div>
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active" value="1">
                        <label class="form-check-label" for="edit_is_active">Active?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL: Delete -->
<div class="modal fade" id="deleteSubMenuModal" tabindex="-1" aria-labelledby="deleteSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus submenu ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editBtns = document.querySelectorAll('.editSubmenuBtn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('edit_id').value = this.dataset.id;
                document.getElementById('edit_title').value = this.dataset.title;
                document.getElementById('edit_menu_id').value = this.dataset.menu_id;
                document.getElementById('edit_url').value = this.dataset.url;
                document.getElementById('edit_icon').value = this.dataset.icon;
                document.getElementById('edit_is_active').checked = this.dataset.is_active == "1";
            });
        });

        const deleteBtns = document.querySelectorAll('.deleteSubmenuBtn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const deleteLink = "<?= base_url('menu/delete_submenu/'); ?>" + id;
                document.getElementById('confirmDeleteBtn').setAttribute('href', deleteLink);
            });
        });
    });
</script>