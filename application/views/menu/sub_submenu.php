<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="page-tittle"><?= $title; ?></h1>

    <?= $this->session->flashdata('message'); ?>

    <style>
        .table thead th {
            background-color:  #0c8b00 !important;
            color: #fff !important;
            text-align: center !important;
            border-color:  #0c8b00 !important;
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
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newSubSubmenuModal">
                <i class="fas fa-plus"></i> Tambah Sub-Submenu
            </button>

            <div class="table-responsive">
                <table class="table table-hover table-bordered table-striped align-middle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>URL</th>
                            <th>Icon</th>
                            <th>Menu</th>
                            <th>Submenu</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($sub_submenu as $ssm) : ?>
                            <tr>
                                <th scope="row" data-label="#"><?= $no++; ?></th>
                                <td data-label="Title"><?= $ssm['title']; ?></td>
                                <td data-label="URL"><?= $ssm['url']; ?></td>
                                <td data-label="Icon"><?= $ssm['icon']; ?></td>
                                <td data-label="Menu"><?= $ssm['menu_title']; ?></td>
                                <td data-label="Submenu"><?= $ssm['sub_menu_title']; ?></td>
                                <td data-label="Active"><?= $ssm['is_active'] ? 'Yes' : 'No'; ?></td>
                                <td data-label="Action">
                                    <div class="btn-group">
                                        <a href="#" class="btn btn-sm btn-warning editSubSubmenuBtn"
                                            data-id="<?= $ssm['id']; ?>"
                                            data-title="<?= htmlspecialchars($ssm['title'], ENT_QUOTES); ?>"
                                            data-url="<?= htmlspecialchars($ssm['url'], ENT_QUOTES); ?>"
                                            data-icon="<?= htmlspecialchars($ssm['icon'], ENT_QUOTES); ?>"
                                            data-submenu_id="<?= $ssm['submenu_id']; ?>"
                                            data-is_active="<?= $ssm['is_active']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#editSubSubmenuModal">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger deleteSubSubmenuBtn"
                                            data-id="<?= $ssm['id']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#deleteSubSubmenuModal">
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

<!-- Modal Tambah Sub-Submenu -->
<div class="modal fade" id="newSubSubmenuModal" tabindex="-1" aria-labelledby="newSubSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('menu/sub_submenu'); ?>" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSubSubmenuModalLabel">Tambah Sub-Submenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label>Submenu</label>
                        <select name="parent_id" class="form-control" required>
                            <option value="">-- Pilih Submenu --</option>
                            <?php foreach ($submenu as $sm) : ?>
                                <option value="<?= $sm['id']; ?>"><?= $sm['title']; ?> (<?= $sm['menu']; ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>URL</label>
                        <input type="text" class="form-control" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" class="form-control" name="icon">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="is_active" value="1" checked>
                        <label class="form-check-label">Active</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Sub-Submenu -->
<div class="modal fade" id="editSubSubmenuModal" tabindex="-1" aria-labelledby="editSubSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= base_url('menu/save_sub_submenu'); ?>" method="post">
            <input type="hidden" name="id" id="edit_ssm_id">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Sub-Submenu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" id="edit_ssm_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>URL</label>
                        <input type="text" name="url" id="edit_ssm_url" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" name="icon" id="edit_ssm_icon" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Submenu</label>
                        <select name="submenu_id" id="edit_ssm_submenu_id" class="form-control" required>
                            <option value="">Select Submenu</option>
                            <?php foreach ($submenu as $sm): ?>
                                <option value="<?= $sm['id']; ?>"><?= $sm['title']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" id="edit_ssm_is_active" value="1">
                        <label class="form-check-label">Active?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Hapus Sub-Submenu -->
<div class="modal fade" id="deleteSubSubmenuModal" tabindex="-1" aria-labelledby="deleteSubSubmenuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Apakah kamu yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="#" id="confirmDeleteSubSubmenuBtn" class="btn btn-danger">Hapus</a>
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
        const editBtns = document.querySelectorAll('.editSubSubmenuBtn');
        editBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('edit_ssm_id').value = this.dataset.id;
                document.getElementById('edit_ssm_title').value = this.dataset.title;
                document.getElementById('edit_ssm_url').value = this.dataset.url;
                document.getElementById('edit_ssm_icon').value = this.dataset.icon;
                document.getElementById('edit_ssm_submenu_id').value = this.dataset.submenu_id;
                document.getElementById('edit_ssm_is_active').checked = this.dataset.is_active === "1";
            });
        });

        const deleteBtns = document.querySelectorAll('.deleteSubSubmenuBtn');
        deleteBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                const deleteLink = "<?= base_url('menu/delete_sub_submenu/'); ?>" + id;
                document.getElementById('confirmDeleteSubSubmenuBtn').setAttribute('href', deleteLink);
            });
        });
    });
</script>