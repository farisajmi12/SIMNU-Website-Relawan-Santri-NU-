<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* Custom Button Styles */
        .btn.btn-primary {
            background-color: #f9fcfa !important;
            border-color: #f9fcfa !important;
            color: #666262 !important;
            font-weight: bold !important;
            transition: all 0.3s ease !important;
            padding: 8px 20px;
        }

        /* Button hover effect */
        .btn.btn-primary:hover {
            background-color: #0c8b00 !important;
            border-color: #0c8b00 !important;
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Button active/focus state */
        .btn.btn-primary:active,
        .btn.btn-primary:focus,
        .btn.btn-primary.active {
            background-color: #0c8b00 !important;
            border-color: #0c8b00 !important;
            color: white !important;
        }

        /* Form styling */
        .white-text .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .white-text .form-control:focus {
            border-color: #0c8b00;
            box-shadow: 0 0 0 0.25rem rgba(12, 139, 0, 0.25);
        }

        .white-text label.col-form-label {
            font-weight: 500;
            color: #555;
            padding-top: 12px;
        }

        .page-tittle {
            color: #333;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }

        .img-thumbnail {
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #dee2e6;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .white-text label.col-form-label {
                padding-bottom: 5px;
            }
            
            .mb-3.row {
                margin-bottom: 1rem !important;
            }
            
            .img-thumbnail {
                margin-bottom: 15px;
            }
            
            .offset-sm-3, .offset-md-2 {
                margin-left: 0;
            }
            
            .col-sm-9, .col-md-10 {
                padding-left: 15px;
            }
        }
        
    </style>
</head>
<body>
    <!-- Begin Page Content -->
    <div class="container-fluid py-4">
        <!-- Page Heading -->
        <h1 class="page-tittle"><?= $title; ?></h1>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <?= form_open_multipart('user/edit'); ?>
                <div class="white-text">
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-3 col-md-2 col-form-label">Email</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="name" class="col-sm-3 col-md-2 col-form-label">Full name</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="username" class="col-sm-3 col-md-2 col-form-label">Username</label>
                        <div class="col-sm-9 col-md-10">
                            <input type="text" class="form-control" id="username" name="username" value="<?= $user['username']; ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-3 col-md-2 col-form-label">Picture</label>
                        <div class="col-sm-9 col-md-10 d-flex flex-column flex-md-row align-items-md-center">
                            <img src="<?= base_url('uploads/profile/' . $user['image']); ?>" class="img-thumbnail me-md-3 mb-3 mb-md-0" width="100" height="100">
                            <div class="w-100">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="image" name="image">
                                    <label class="input-group-text" for="image">Browse</label>
                                </div>
                                <small class="text-muted">Max size 2MB (JPG/PNG)</small>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-sm-9 col-md-10 offset-sm-3 offset-md-2">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS for file input -->
    <script>
        $(document).ready(function() {
            // File input display
            $('#image').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.input-group-text').text(fileName || "Browse");
            });
            
            // Form validation example
            $('form').on('submit', function(e) {
                let valid = true;
                
                // Validate name
                if ($('#name').val().trim() === '') {
                    $('#name').next('.text-danger').removeClass('d-none').text('Please enter your full name');
                    valid = false;
                }
                
                // Add more validations as needed
                
                if (!valid) {
                    e.preventDefault();
                }
            });
        });
    </script>
</body>
</html>