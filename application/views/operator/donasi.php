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
    
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">

    <style>
        /* Custom styles for responsive design */
        @media (max-width: 768px) {
            .page-title {
                font-size: 1.5rem; /* Adjust font size for page title */
            }

            .btn {
                width: 100%; /* Make buttons full width on small screens */
            }

            .card-header {
                text-align: center; /* Center text in card header */
            }

            .list-group-item {
                font-size: 1rem; /* Adjust font size for list items */
            }
        }
    </style>
</head>

<body>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="page-tittle"><?= $title; ?></h1>

        <button type="button" class="btn btn-secondary mb-3" onclick="window.location.href='<?= base_url('operator/lkknu'); ?>'">
            Kembali
        </button>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-white">LKKNU - Menu Donasi</h6>
            </div>
            <div class="card-body">
                <div class="list-group">
                    <a href="<?= base_url('operator/donatur'); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-fw fa-users"></i> Donatur
                    </a>
                    <a href="<?= base_url('operator/jenis_donasi'); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-fw fa-hand-holding-usd"></i> Jenis Donasi
                    </a>
                    <a href="<?= base_url('operator/penerimaan'); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-fw fa-download"></i> Penerimaan
                    </a>
                    <a href="<?= base_url('operator/pengeluaran'); ?>" class="list-group-item list-group-item-action">
                        <i class="fas fa-fw fa-upload"></i> Pengeluaran
                    </a>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    <!-- Optional JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
