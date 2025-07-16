<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
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

        /* Button icon style */
        .btn.btn-primary i.fas.fa-plus {
            color: #666262 !important;
            transition: all 0.3s ease !important;
        }

        /* Button hover effect */
        .btn.btn-primary:hover {
            background-color: #0c8b00 !important;
            border-color: #0c8b00 !important;
            color: white !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .btn.btn-primary:hover i.fas.fa-plus {
            color: white !important;
        }

        /* Button active/focus state */
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

        /* Tab styles */
        .nav-tabs .nav-link {
            color: #666262 !important;
            font-weight: bold !important;
            border: none !important;
            padding: 10px 20px;
        }

        .nav-tabs .nav-link.active {
            color: #0c8b00 !important;
            font-weight: bold !important;
            border-bottom: 2px solid #0c8b00 !important;
            background-color: transparent !important;
        }

        .nav-tabs .nav-link:hover {
            color: #0c8b00 !important;
            opacity: 0.8;
        }

        /* Page specific styles */
        .page-tittle {
            color: #333;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: center;
        }

        .form-white-text .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-white-text .form-control:focus {
            border-color: #0c8b00;
            box-shadow: 0 0 0 0.25rem rgba(12, 139, 0, 0.25);
        }

        .form-white-text label {
            font-weight: 500;
            margin-bottom: 8px;
            color: #555;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .page-tittle {
                font-size: 1.5rem;
            }
            
            .form-white-text .form-control {
                padding: 10px 12px;
            }
            
            .btn.btn-primary {
                width: 100%;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Begin Page Content -->
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12">
                <!-- Page Heading -->
                <h1 class="page-tittle mb-4">Change Password</h1>
                
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6">
                        <!-- Flash message -->
                        <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                            Password changed successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                        <form action="<?= base_url('user/changepassword') ?>" method="post">
                            <div class="form-group form-white-text mb-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                <small class="text-danger d-none">Please enter your current password</small>
                            </div>
                            
                            <div class="form-group form-white-text mb-3">
                                <label for="new_password1">New Password</label>
                                <input type="password" class="form-control" id="new_password1" name="new_password1" required>
                                <small class="text-danger d-none">Password must be at least 6 characters</small>
                            </div>
                            
                            <div class="form-group form-white-text mb-4">
                                <label for="new_password2">Repeat Password</label>
                                <input type="password" class="form-control" id="new_password2" name="new_password2" required>
                                <small class="text-danger d-none">Passwords don't match</small>
                            </div>
                            
                            <div class="form-group form-white-text d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-lock me-2"></i>Change Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS for form validation -->
    <script>
        $(document).ready(function() {
            // Example form validation
            $('form').on('submit', function(e) {
                let valid = true;
                
                // Validate current password
                if ($('#current_password').val().length < 1) {
                    $('#current_password').next('.text-danger').removeClass('d-none').text('Please enter your current password');
                    valid = false;
                } else {
                    $('#current_password').next('.text-danger').addClass('d-none');
                }
                
                // Validate new password
                if ($('#new_password1').val().length < 6) {
                    $('#new_password1').next('.text-danger').removeClass('d-none').text('Password must be at least 6 characters');
                    valid = false;
                } else {
                    $('#new_password1').next('.text-danger').addClass('d-none');
                }
                
                // Validate password match
                if ($('#new_password1').val() !== $('#new_password2').val()) {
                    $('#new_password2').next('.text-danger').removeClass('d-none').text("Passwords don't match");
                    valid = false;
                } else {
                    $('#new_password2').next('.text-danger').addClass('d-none');
                }
                
                if (!valid) {
                    e.preventDefault();
                } else {
                    // Simulate successful password change
                    $('.alert-success').fadeIn();
                    setTimeout(() => {
                        $('.alert-success').fadeOut();
                    }, 3000);
                }
            });
        });
    </script>
</body>
</html>