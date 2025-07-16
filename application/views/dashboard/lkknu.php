<!-- Begin Page Content -->
<style>
    body {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        font-family: 'Poppins', sans-serif;
        color: #fff;
        min-height: 100vh;
    }

    .page-tittle {
        font-weight: 400;
        font-size: 2.8rem;
        color: #ffffff;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        margin-bottom: 40px;
        position: relative;
        display: inline-block;
    }

    .page-tittle::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 80px;
        height: 4px;
        background: #0c8b00;
        border-radius: 2px;
    }

    .section-title {
        font-weight: 600;
        font-size: 1.5rem;
        color: #fff;
        margin-bottom: 25px;
        position: relative;
        padding-left: 15px;
    }

    .section-title::before {
        content: '';
        position: absolute;
        left: 0;
        top: 5px;
        height: 70%;
        width: 4px;
        background: #0c8b00;
        border-radius: 2px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 30px;
        height: 100%;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
        border-color: rgba(255, 255, 255, 0.2);
    }

    .stat-card .stat-icon {
        font-size: 2.5rem;
        color: #0c8b00;
        margin-bottom: 15px;
    }

    .stat-card h3 {
        font-weight: 700;
        font-size: 2.5rem;
        color: #0c8b00;
        margin-bottom: 5px;
    }

    .stat-card h5 {
        font-weight: 600;
        font-size: 1.1rem;
        color: #fff;
        margin-bottom: 10px;
    }

    .stat-card p {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 0;
    }

    /* Glow Effect */
    .glow-effect {
        position: relative;
    }

    .glow-effect::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 12px;
        background: radial-gradient(circle at center, rgba(255, 193, 7, 0.2) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .stat-card:hover .glow-effect::before {
        opacity: 1;
    }

    /* Custom Carousel */
    .stats-carousel {
        position: relative;
        padding: 0 40px;
    }

    .stats-carousel .carousel-inner {
        padding: 20px 0;
    }

    .stats-carousel .carousel-control-prev,
    .stats-carousel .carousel-control-next {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 1;
        transition: all 0.3s ease;
    }

    .stats-carousel .carousel-control-prev:hover,
    .stats-carousel .carousel-control-next:hover {
        background: rgba(255, 193, 7, 0.3);
    }

    .stats-carousel .carousel-control-prev {
        left: -20px;
    }

    .stats-carousel .carousel-control-next {
        right: -20px;
    }

    /* Style untuk pesan data kosong */
    .empty-data-message {
        text-align: center;
        padding: 30px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        border: 1px dashed rgba(255, 255, 255, 0.2);
    }

    .empty-data-message i {
        font-size: 3rem;
        color: rgba(255, 255, 255, 0.3);
        margin-bottom: 15px;
    }

    .empty-data-message h4 {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 10px;
    }

    .empty-data-message p {
        color: rgba(255, 255, 255, 0.5);
        margin-bottom: 0;
    }

    /* Responsive Adjustments */
    @media (max-width: 992px) {
        .page-tittle {
            font-size: 2.2rem;
        }
        
        .stat-card {
            padding: 20px;
        }
        
        .stat-card h3 {
            font-size: 2rem;
        }
    }

    @media (max-width: 768px) {
        .page-tittle {
            font-size: 1.8rem;
        }
        
        .section-title {
            font-size: 1.3rem;
        }
        
        .stats-carousel {
            padding: 0;
        }
        
        .stats-carousel .carousel-control-prev,
        .stats-carousel .carousel-control-next {
            display: none;
        }
    }

    @media (max-width: 576px) {
        .page-tittle {
            font-size: 1.5rem;
        }
        
        .stat-card {
            padding: 15px;
        }
        
        .stat-card h3 {
            font-size: 1.8rem;
        }
        
        .stat-card h5 {
            font-size: 1rem;
        }
    }
</style>

<div class="container-fluid py-5">
    <h1 class="page-tittle"><?= $title; ?></h1>

    <!-- Yatim Section -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="section-title">Kategori Anak Yatim</h3>
            <div class="stats-carousel">
                <div id="yatimCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $kategori_yatim = [
                            ['label' => 'Yatim', 'value' => $yatim, 'icon' => 'child'],
                            ['label' => 'Piatu', 'value' => $piatu, 'icon' => 'female'],
                            ['label' => 'Yatim & Piatu', 'value' => $yatim_dan_piatu, 'icon' => 'users'],
                        ];
                        foreach ($kategori_yatim as $index => $item): ?>
                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                <div class="row">
                                    <div class="col-12 col-md-4 mx-auto">
                                        <div class="stat-card glow-effect text-center">
                                            <div class="stat-icon">
                                                <i class="fas fa-<?= $item['icon'] ?>"></i>
                                            </div>
                                            <h3><?= $item['value'] ?></h3>
                                            <h5><?= $item['label'] ?></h5>
                                            <p>Jumlah anak <?= strtolower($item['label']) ?> yang terdaftar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#yatimCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#yatimCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Janda Section -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="section-title">Kategori Janda</h3>
            <div class="row">
                <?php
                $kategori_janda = [
                    ['label' => 'Cerai', 'value' => $cerai, 'icon' => 'heart-broken'],
                    ['label' => 'Ditinggal Mati', 'value' => $ditinggal_mati, 'icon' => 'heart'],
                ];
                foreach ($kategori_janda as $item): ?>
                    <div class="col-12 col-md-6">
                        <div class="stat-card glow-effect text-center">
                            <div class="stat-icon">
                                <i class="fas fa-<?= $item['icon'] ?>"></i>
                            </div>
                            <h3><?= $item['value'] ?></h3>
                            <h5><?= $item['label'] ?></h5>
                            <p>Jumlah janda karena <?= strtolower($item['label']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Dhuafa Section -->
    <div class="row mb-5">
        <div class="col-12">
            <h3 class="section-title">Kategori Dhuafa</h3>
            <div class="stats-carousel">
                <div id="dhuafaCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        $kategori_dhuafa = [
                            ['label' => 'Pengangguran', 'value' => $pengangguran, 'icon' => 'briefcase'],
                            ['label' => 'Tua Renta', 'value' => $tua_renta, 'icon' => 'walking'],
                            ['label' => 'Fakir', 'value' => $fakir, 'icon' => 'hands-helping'],
                            ['label' => 'Miskin', 'value' => $miskin, 'icon' => 'money-bill-wave'],
                        ];
                        foreach (array_chunk($kategori_dhuafa, 4) as $chunkIndex => $chunk): ?>
                            <div class="carousel-item <?= $chunkIndex === 0 ? 'active' : '' ?>">
                                <div class="row">
                                    <?php foreach ($chunk as $item): ?>
                                        <div class="col-6 col-md-3">
                                            <div class="stat-card glow-effect text-center">
                                                <div class="stat-icon">
                                                    <i class="fas fa-<?= $item['icon'] ?>"></i>
                                                </div>
                                                <h3><?= $item['value'] ?></h3>
                                                <h5><?= $item['label'] ?></h5>
                                                <p>Kategori <?= strtolower($item['label']) ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#dhuafaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#dhuafaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Donatur Section -->
    <div class="row mb-5">
        <div class="col-12 col-md-8 mx-auto">
            <div class="stat-card glow-effect text-center">
                <div class="stat-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3><?= $donatur_count ?></h3>
                <h5>Total Donatur</h5>
                <p>Yang telah berkontribusi dalam program ini</p>
            </div>
        </div>
    </div>

    <!-- Barang Masuk Section (Perbaikan) -->
    <div class="row">
        <div class="col-12">
            <h3 class="section-title">Barang Masuk</h3>
            <div class="stats-carousel">
                <div id="barangCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if(empty($barang_masuk)): ?>
                            <!-- Tampilan jika data kosong -->
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="stat-card glow-effect text-center">
                                            <div class="stat-icon">
                                                <i class="fas fa-box-open"></i>
                                            </div>
                                            <h3>0</h3>
                                            <h5>Belum Ada Data</h5>
                                            <p>Data barang masuk akan ditampilkan di sini</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Tampilan jika ada data -->
                            <?php foreach (array_chunk($barang_masuk, 3) as $chunkIndex => $chunk): ?>
                                <div class="carousel-item <?= $chunkIndex === 0 ? 'active' : '' ?>">
                                    <div class="row">
                                        <?php foreach ($chunk as $barang): ?>
                                            <div class="col-12 col-md-4">
                                                <div class="stat-card glow-effect text-center">
                                                    <div class="stat-icon">
                                                        <i class="fas fa-box-open"></i>
                                                    </div>
                                                    <h3><?= $barang['total'] ?></h3>
                                                    <h5><?= $barang['nama_barang'] ?></h5>
                                                    <p>Barang berupa <?= strtolower($barang['nama_barang']) ?></p>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <?php if(!empty($barang_masuk) && count($barang_masuk) > 3): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#barangCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#barangCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    // Initialize carousels with custom settings
    document.addEventListener('DOMContentLoaded', function() {
        const carousels = [
            { id: 'yatimCarousel', interval: 3000 },
            { id: 'dhuafaCarousel', interval: 4000 },
            { id: 'barangCarousel', interval: 3500 }
        ];
        
        carousels.forEach(config => {
            const carousel = document.getElementById(config.id);
            if (carousel) {
                new bootstrap.Carousel(carousel, {
                    interval: config.interval,
                    pause: 'hover',
                    wrap: true,
                    touch: true
                });
            }
        });
        
        // Add animation class on scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, { threshold: 0.1 });
        
        document.querySelectorAll('.stat-card').forEach(card => {
            observer.observe(card);
        });
    });
</script>