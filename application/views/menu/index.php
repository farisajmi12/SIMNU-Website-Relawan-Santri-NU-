<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="page-tittle"><?= $title; ?></h1>

  <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
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
    <div class="col-lg-8">
      <a href="#" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#newMenuModal" id="addMenuBtn">Add New Menu</a>

      <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped align-middle">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Menu</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            <?php foreach ($menu as $m) : ?>
              <tr>
                <th scope="row" data-label="#"><?= $m['urutan']; ?></th>
                <td data-label="Menu"><?= $m['menu']; ?></td>
                <td data-label="Action">
                  <div class="btn-group">
                    <a href="#" class="btn btn-sm btn-warning editMenuBtn"
                      data-id="<?= $m['id']; ?>"
                      data-menu="<?= $m['menu']; ?>"
                      data-urutan="<?= $m['urutan']; ?>"
                      data-bs-toggle="modal"
                      data-bs-target="#newMenuModal">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="#" class="btn btn-sm btn-danger deleteMenuBtn"
                      data-id="<?= $m['id']; ?>"
                      data-bs-toggle="modal"
                      data-bs-target="#deleteMenuModal">
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

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" aria-labelledby="newMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= base_url('menu/save'); ?>" method="post">
        <div class="modal-body">
          <input type="hidden" name="id" id="id">
          <div class="mb-3">
            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" required>
          </div>
          <div class="mb-3">
            <input type="number" class="form-control" id="urutan" name="urutan" placeholder="Urutan Menu">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- MODAL: Delete -->
<div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Apakah kamu yakin ingin menghapus menu ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="confirmDeleteMenuBtn" class="btn btn-danger">Hapus</a>
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
  // Tombol edit
  $(document).on('click', '.editMenuBtn', function() {
    const id = $(this).data('id');
    const menu = $(this).data('menu');
    const urutan = $(this).data('urutan');
    $('#newMenuModalLabel').text('Edit Menu');
    $('#id').val(id);
    $('#menu').val(menu);
    $('#urutan').val(urutan);
  });

  // Tombol tambah menu
  $(document).on('click', '#addMenuBtn', function() {
    $('#newMenuModalLabel').text('Add New Menu');
    $('#id').val('');
    $('#menu').val('');
  });

  document.addEventListener('DOMContentLoaded', function() {
    const deleteBtns = document.querySelectorAll('.deleteMenuBtn');
    deleteBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const id = this.dataset.id;
        const deleteLink = "<?= base_url('menu/delete/'); ?>" + id;
        document.getElementById('confirmDeleteMenuBtn').setAttribute('href', deleteLink);
      });
    });
  });
</script>