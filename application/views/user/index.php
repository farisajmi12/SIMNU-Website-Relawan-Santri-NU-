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
        /* Page styling */
        .page-tittle {
            color: #333;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        /* Card styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }
        
        .card-text {
            color: #555;
            margin-bottom: 0.5rem;
        }
        
        .text-body-secondary {
            color: #6c757d !important;
        }
        
        /* Profile image */
        .rounded-start {
            border-radius: 10px 0 0 10px !important;
            height: 100%;
            object-fit: cover;
        }
        
        .card-body {
            padding: 2rem;
        }
        
        /* Flash message */
        .alert {
            border-radius: 8px;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .rounded-start {
                border-radius: 10px 10px 0 0 !important;
                height: auto;
                max-height: 300px;
            }
            
            .card-body {
                padding: 1.5rem;
            }
            
            .card-title {
                font-size: 1.3rem;
            }
        }
        
        @media (max-width: 576px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Begin Page Content -->
    <div class="container-fluid py-4">
        <!-- Page Heading -->
        <h1 class="page-tittle"><?= $title; ?></h1>

        <!-- Flash message -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <?= $this->session->flashdata('message'); ?>
            </div>
        </div>

        <!-- Profile Card -->
        <div class="row justify-content-center">
            <div class="card mb-3 col-12 col-lg-8">
                <div class="row g-0">
                    <!-- Profile Image -->
                    <div class="col-12 col-md-4">
                        <img src="<?= base_url('uploads/profile/' . $user['image']); ?>" class="img-fluid rounded-start w-100" alt="Profile Image">
                    </div>
                    
                    <!-- Profile Details -->
                    <div class="col-12 col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $user['name']; ?></h5>
                            
                            <div class="card-text mb-2">
                                <i class="fas fa-user me-2 text-primary"></i>
                                <?= $user['username']; ?>
                            </div>
                            
                            <div class="card-text mb-2">
                                <i class="fas fa-envelope me-2 text-primary"></i>
                                <?= $user['email']; ?>
                            </div>
                            
                            <div class="card-text mt-4">
                                <i class="fas fa-calendar-alt me-2 text-primary"></i>
                                <small class="text-body-secondary">Member since <?= date('d F Y', $user['date_created']); ?></small>
                            </div>
                            
                            <!-- Edit Profile Button -->
                            <div class="mt-4 pt-2">
                                <a href="<?= base_url('user/edit'); ?>" class="btn btn-primary px-4">
                                    <i class="fas fa-user-edit me-2"></i>Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        $(document).ready(function() {
            // Fade out flash message after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
            
            // Add hover effect to card
            $('.card').hover(
                function() {
                    $(this).css('box-shadow', '0 8px 16px rgba(0,0,0,0.15)');
                },
                function() {
                    $(this).css('box-shadow', '0 4px 12px rgba(0,0,0,0.1)');
                }
            );
        });
    </script>
</body>
</html>