<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <!-- Bootstrap & Font Awesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --sidebar-color: rgb(247, 252, 246);
      --sidebar-hover: #0c8b00;
      --sidebar-text: white;
      --icon-hover: white !important;
      --desc-color: #555;
      /* Warna deskripsi */

    }

    body {
      background-color: #0c8b00;
    }

    .menu-box {
      width: 185px;
      height: 80vh;
      background-color: var(--sidebar-color);
      border: none;
      border-radius: 20px;
      padding: 30px 20px;
      box-shadow: 8px 8px 20px rgba(0, 0, 0, 0.1);
      transition: 0.3s ease;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
      gap: 20px;
    }

    a:hover {
            color:rgb(255, 254, 254) !important;
        }

    .menu-box a {
      text-decoration: none;
      color: var(--sidebar-text);
      font-weight: bold;
      font-size: 24px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }

    .menu-box a i {
      font-size: 40px;
      margin-bottom: 10px;
      color: inherit;
      /* Mengikuti warna parent */
      transition: 0.3s ease;
      /* Tambahkan transisi untuk efek halus */
    }

    .menu-box:hover {
     background-color: var(--sidebar-hover);
      transform: translateY(-5px);
    }

    .menu-box:hover a {
      color: var(--sidebar-text); /* Teks TETAP warna aslinya */
    }

    .menu-box:hover a i {
      color: var(--icon-hover);
      /* Warna ikon saat hover */
    }

    .desc {
      font-size: 14px;
      font-weight: normal;
      color: #666262;
    }

    .menu-box:hover .desc {
      color: rgb(255, 255, 255);
      /* Tetap warna asli */
    }

    @media (max-width: 768px) {
      .menu-box {
        width: 100%;
        height: auto;
      }
    }
  </style>
</head>

<body>
  <div class="container-fluid">
    <h1 class="page-tittle"><?= $title; ?></h1>
  </div>

  <div class="container-fluid px-5 py-4">
    <div class="d-flex justify-content-center flex-wrap gap-4">
      <!-- LDNU -->
      <div class="menu-box text-start">
        <a href="<?= base_url('dashboard/ldnu'); ?>">
          <i class="fas fa-mosque"></i>
          <div>LDNU</div>
          <div class="desc">Lembaga Dakwah Nahdlatul Ulama: Menyebarkan ajaran Islam yang rahmatan lil alamin.</div>
        </a>
      </div>

      <!-- LTMNU -->
      <div class="menu-box text-start">
        <a href="<?= base_url('dashboard/ltmnu'); ?>">
          <i class="fas fa-building"></i>
          <div>LTMNU</div>
          <div class="desc">Lembaga Takmir Masjid: Mengelola masjid sebagai pusat ibadah dan sosial.</div>
        </a>
      </div>

      <!-- LBM -->
      <div class="menu-box text-start">
        <a href="<?= base_url('dashboard/lbm'); ?>">
          <i class="fas fa-book"></i>
          <div>LBM</div>
          <div class="desc">Lembaga Bahtsul Masail: Membahas persoalan keagamaan secara kolektif.</div>
        </a>
      </div>

      <!-- LKNU -->
      <div class="menu-box text-start">
        <a href="<?= base_url('dashboard/lknu'); ?>">
          <i class="fas fa-clinic-medical"></i>
          <div>LKNU</div>
          <div class="desc">Lembaga Kesehatan: Memberikan layanan kesehatan bagi masyarakat NU.</div>
        </a>
      </div>

      <!-- LKKNU -->
      <div class="menu-box text-start">
        <a href="<?= base_url('dashboard/lkknu'); ?>">
          <i class="fas fa-users"></i>
          <div>LKKNU</div>
          <div class="desc">Lembaga Kemaslahatan Keluarga: Meningkatkan kesejahteraan keluarga dan umat.</div>
        </a>
      </div>
    </div>
  </div>

  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
</body>

</html>