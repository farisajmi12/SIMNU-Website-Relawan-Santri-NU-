     <!-- Content Wrapper -->
     <div id="content-wrapper" class="d-flex flex-column">

         <!-- Main Content -->
         <div id="content">

             <!-- Topbar -->
             <nav class="navbar navbar-expand navbar-dark custom-topbar topbar mb-4 static-top shadow">

                 <!-- Sidebar Toggle (Topbar) -->
                <button id="mobileSidebarToggle" class="btn btn-primary d-md-none position-fixed" style="z-index: 9999; left: 10px; top: 10px;">
                     <i class="fa fa-bars"></i>
                 </button>

                 <!-- Topbar Navbar -->
                 <ul class="navbar-nav ml-auto">

                     <div class="topbar-divider d-none d-sm-block"></div>

                     <!-- Nav Item - User Information -->
                     <li class="nav-item dropdown no-arrow">
                         <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                             <span class="mr-2 d-none d-lg-inline text-white-600 username-text"><?= $user['username']; ?></span>
                             <img class="img-profile rounded-circle"
                                 src="<?= base_url('uploads/profile/') . (!empty($user['image']) ? $user['image'] : 'default.png'); ?>">
                         </a>
                         <!-- Dropdown - User Information -->
                         <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                             <a class="dropdown-item" href="<?= base_url('user/index'); ?>">
                                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                 My Profile
                             </a>
                             <div class="dropdown-divider"></div>
                             <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                                 <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                 Logout
                             </a>
                         </div>
                     </li>
                     <script>
                         // Wait for DOM to be fully loaded
                         document.addEventListener('DOMContentLoaded', function() {
                             // Mobile sidebar toggle functionality
                             const mobileToggle = document.getElementById('sidebarToggleTop');
                             const sidebar = document.getElementById('accordionSidebar');

                             // Create overlay element
                             const overlay = document.createElement('div');
                             overlay.className = 'sidebar-overlay';
                             document.body.appendChild(overlay);

                             // Mobile toggle click handler
                             if (mobileToggle) {
                                 mobileToggle.addEventListener('click', function() {
                                     sidebar.classList.toggle('mobile-show');
                                     overlay.classList.toggle('show');

                                     const icon = mobileToggle.querySelector('i');
                                     if (sidebar.classList.contains('mobile-show')) {
                                         icon.classList.remove('fa-bars');
                                         icon.classList.add('fa-times');
                                     } else {
                                         icon.classList.remove('fa-times');
                                         icon.classList.add('fa-bars');
                                     }
                                 });
                             }

                             // Close sidebar when clicking on overlay
                             overlay.addEventListener('click', function() {
                                 sidebar.classList.remove('mobile-show');
                                 overlay.classList.remove('show');
                                 const icon = mobileToggle.querySelector('i');
                                 icon.classList.remove('fa-times');
                                 icon.classList.add('fa-bars');
                             });

                             // Desktop sidebar toggle functionality
                             const sidebarToggle = document.getElementById('sidebarToggle');
                             if (sidebarToggle) {
                                 sidebarToggle.addEventListener('click', function() {
                                     document.body.classList.toggle('sidebar-toggled');
                                     sidebar.classList.toggle('toggled');

                                     // Save state to localStorage
                                     if (sidebar.classList.contains('toggled')) {
                                         localStorage.setItem('sidebarToggled', 'true');
                                     } else {
                                         localStorage.removeItem('sidebarToggled');
                                     }
                                 });
                             }

                             // Initialize sidebar state from localStorage
                             if (localStorage.getItem('sidebarToggled') === 'true') {
                                 document.body.classList.add('sidebar-toggled');
                                 sidebar.classList.add('toggled');
                             }

                             // Close sidebar when clicking on a menu item (for mobile)
                             const navLinks = document.querySelectorAll('.nav-link, .collapse-item');
                             navLinks.forEach(link => {
                                 link.addEventListener('click', function() {
                                     if (window.innerWidth < 768) {
                                         sidebar.classList.remove('mobile-show');
                                         overlay.classList.remove('show');
                                         const icon = mobileToggle.querySelector('i');
                                         icon.classList.remove('fa-times');
                                         icon.classList.add('fa-bars');
                                     }
                                 });
                             });
                         });
                     </script>
                 </ul>

                 <!-- Custom CSS -->
                 <link href="<?= base_url('assets/'); ?>css/custom.css" rel="stylesheet">
             </nav>
             <!-- End of Topbar -->