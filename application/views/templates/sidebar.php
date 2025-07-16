<ul id="accordionSidebar" class="navbar-nav sidebar sidebar-dark accordion" style="background: #f8f9fa;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard'); ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('assets/img/logo/nahdlatul_ulama_logo.svg'); ?>" alt="Logo NU">
        </div>
        <div class="sidebar-brand-text mx-3">RelawanSantriNU</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php
    $role_id = $this->session->userdata('role_id');
    $queryMenu = "SELECT `user_menu`.`id`, `menu`
                FROM `user_menu`
                JOIN `user_access_menu` ON `user_menu`.`id` = `user_access_menu`.`menu_id`
                WHERE `user_access_menu`.`role_id` = $role_id
                ORDER BY `user_menu`.`urutan` ASC";
    $menu = $this->db->query($queryMenu)->result_array();
    ?>

    <?php foreach ($menu as $m) : ?>
        <div class="sidebar-heading text-white">
            <?= $m['menu']; ?>
        </div>

        <?php
        $menuId = $m['id'];
        $querySubMenu = "SELECT * FROM `user_sub_menu`
                     WHERE `menu_id` = $menuId AND `is_active` = 1
                     ORDER BY `id` ASC";
        $subMenu = $this->db->query($querySubMenu)->result_array();
        ?>

        <?php foreach ($subMenu as $sm) : ?>
            <?php
            $submenuId = $sm['id'];
            $querySubSubMenu = "SELECT * FROM `user_sub_submenu`
                          WHERE `submenu_id` = $submenuId AND `is_active` = 1
                          ORDER BY `id` ASC";
            $subSubMenu = $this->db->query($querySubSubMenu)->result_array();
            ?>

            <?php if (!empty($subSubMenu)) : ?>
                <li class="nav-item">
                    <div class="nav-link d-flex justify-content-between align-items-center text-white">
                        <a href="<?= base_url($sm['url']); ?>" class="d-inline-flex align-items-center text-white text-decoration-none">
                            <i class="<?= $sm['icon']; ?>"></i>
                            <span class="ml-2"><?= $sm['title']; ?></span>
                        </a>
                        <a href="#" data-toggle="collapse" data-target="#collapse<?= $sm['id']; ?>" aria-expanded="false" aria-controls="collapse<?= $sm['id']; ?>">
                            <i class="fas fa-chevron-down chevron-icon text-white"></i>
                        </a>
                    </div>

                    <div id="collapse<?= $sm['id']; ?>" class="collapse" aria-labelledby="heading<?= $sm['id']; ?>" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php foreach ($subSubMenu as $ssm) : ?>
                                <a class="collapse-item <?= ($title == $ssm['title']) ? 'active' : ''; ?>" href="<?= base_url($ssm['url']); ?>">
                                    <i class="<?= $ssm['icon']; ?>"></i> <?= $ssm['title']; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
            <?php else : ?>
                <li class="nav-item <?= ($title == $sm['title']) ? 'active' : ''; ?>">
                    <a class="nav-link text-white" href="<?= base_url($sm['url']); ?>">
                        <i class="<?= $sm['icon']; ?>"></i>
                        <span><?= $sm['title']; ?></span>
                    </a>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
        <hr class="sidebar-divider mt-3">
    <?php endforeach; ?>

    <!-- Logout -->
    <li class="nav-item">
        <a class="nav-link text-white" href="<?= base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"
            style="background-color: #e9ecef; width: 2.5rem; height: 2.5rem;
                   transition: all 0.3s ease; border: 1px solid transparent;">
            <i class="fas fa-angle-double-left toggle-icon"
                style="color: #6c757d; transition: color 0.3s ease, transform 0.3s ease;"></i>
        </button>
    </div>

    <style>
        /* Button hover effect */
        #sidebarToggle:hover {
            background-color: #28a745 !important;
            border-color: white !important;
        }

        /* Icon hover effect - turns white */
        #sidebarToggle:hover .toggle-icon {
            color: white !important;
            transform: scale(1.1);
        }

        /* When sidebar is collapsed */
        .sidebar-toggled .toggle-icon {
            transform: rotate(180deg);
            color: white !important;
            /* Tetap putih saat sidebar collapsed */
        }

        /* Click animation */
        #sidebarToggle:active .toggle-icon {
            transform: scale(0.9);
        }
    </style>


</ul>

<!-- Bootstrap JS Bundle via CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76A2z02tPqdj1WgCwZq5T9k8v2Ujwo3n+PKvF0Fi1yYJwGFA8RsIrT6E9I8j2Mf" crossorigin="anonymous"></script>

<!-- Font Awesome JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<!-- Your Custom JavaScript -->
<script>
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile sidebar toggle functionality
        const mobileToggle = document.getElementById('mobileSidebarToggle');
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