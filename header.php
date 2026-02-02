<?php
// Mulai session hanya jika belum aktif.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mengambil nama file PHP yang sedang diakses.
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>RSU BRIMEDIKA MALANG</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Sembunyikan link admin/dashboard jika tidak login */
        <?php if (!isset($_SESSION['is_admin'])): ?>
        .admin-link, .admin-dashboard-link {
            display: none !important;
        }
        <?php endif; ?>

        /* --- Style Desktop (Diperbarui) --- */
        .hotline {
            display: flex;
            align-items: center;
            gap: 15px;
            background-color: #ffffff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 14px;
            flex-grow: 0;
            width: auto;
        }
        .hotline-icon {
            width: 40px;
            height: 40px;
            background-color: #005b8f;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .hotline-icon i {
            font-size: 20px;
            color: #ffffff;
        }
        .hotline-text {
            white-space: nowrap;
            color: #005b8f;
            font-weight: bold;
        }
        .hotline-text span {
            font-weight: bold;
            color: #f75c03;
            font-size: 16px;
        }
        #menu-toggle { display: none; }

        /* Perbaikan CSS untuk Desktop */
        @media (min-width: 992px) {
            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 5%;
            }
            .logo { flex-grow: 0; }
            .header-left {
                display: flex;
                align-items: center;
                gap: 20px; /* Jarak antara logo dan menu */
            }
            .navbar {
                display: flex;
                flex-grow: 0;
            }
            .nav-links-wrapper {
                display: flex;
                gap: 15px; /* Jarak antar item menu */
            }
            .hotline { justify-content: flex-end; margin-left: auto; }
            #menu-toggle { display: none; }
            .mobile-hotline { display: none; }

            .top-bar .left-info {
                display: flex;
                flex-direction: row;
                align-items: center;
                gap: 20px;
                flex-wrap: wrap;
                white-space: normal;
                overflow: visible;
            }
            .top-bar .left-info > div {
                margin-bottom: 0;
            }
        }

        /* --- Mobile Style (Max-width: 991px) --- */
        @media (max-width: 991px) {
            header {
                position: relative;
                justify-content: space-between;
                align-items: center;
            }
            #menu-toggle { display: block; cursor: pointer; z-index: 1001; }
            #menu-toggle .x-icon { display: none; }
            header.nav-active #menu-toggle .menu-icon { display: none; }
            header.nav-active #menu-toggle .x-icon { display: block; }
            header .hotline { display: none; }

            .navbar {
                position: absolute;
                top: 100%;
                right: 0;
                margin-top: 10px;
                width: 280px;
                background-color: #ffffff;
                box-shadow: 0 8px 24px rgba(0,0,0,0.15);
                border-radius: 8px;
                display: flex; flex-direction: column;
                padding: 0.5rem;
                z-index: 1000;
                opacity: 0;
                transform: translateY(-10px);
                visibility: hidden;
                transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s ease;
            }
            .navbar.active {
                opacity: 1;
                transform: translateY(0);
                visibility: visible;
            }
            .nav-links-wrapper { padding: 0.5rem; }
            .navbar a {
                margin: 0.2rem 0;
                padding: 12px 16px;
                font-size: 1rem;
                display: block;
                width: 100%;
                border-radius: 6px;
            }
            .navbar a.active {
                background-color: #eaf6ff;
                color: #007bff;
                font-weight: bold;
            }

            .mobile-hotline {
                display: flex; align-items: center; gap: 10px;
                margin: 0.5rem;
                padding: 10px;
                background-color: #ffffff;
                border-radius: 8px;
            }
            .mobile-hotline i { font-size: 18px; color: #007BFF; }
            .mobile-hotline .text {
                font-size: 14px;
                line-height: 1.4;
                color: #007BFF;
            }
            .mobile-hotline .text span {
                font-weight: bold;
                color: #FF8C00;
                font-size: 15px;
            }

            .top-bar .left-info {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
            }
            .top-bar .left-info > div {
                display: flex;
                align-items: flex-start;
                gap: 5px;
                margin-bottom: 5px;
                white-space: normal;
                overflow: visible;
                text-overflow: unset;
                max-width: 100%;
                word-break: break-word;
            }
        }
    </style>

    <script>
        function confirmLogout() {
            return confirm("Apakah Anda yakin ingin logout?");
        }
    </script>
</head>
<body>

    <div class="top-bar">
        <div class="left-info">
            <div><i class="fas fa-map-marker-alt"></i> Jl. Mayjend Panjaitan No.176, Penanggungan, Kec. Klojen, Kota Malang, Jawa Timur 65113</div>
            <div><i class="fas fa-envelope"></i> brimedikamalang@gmail.com</div>
            <?php if (!isset($_SESSION['is_admin'])): ?>
                <a href="admin/login.php" class="admin-link"><i class="fas fa-lock"></i> Admin</a>
            <?php else: ?>
                <a href="admin/dashboard.php" class="admin-dashboard-link"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="admin/logout.php" class="admin-link" onclick="return confirmLogout()"><i class="fas fa-unlock"></i> Logout</a>
            <?php endif; ?>
        </div>
    </div>

    <header>
        <div class="header-left">
            <div class="logo">
                <a href="index.php"><img src="/assets/logo.png" alt="Logo BRIMEDIKA"></a>
            </div>

            <nav class="navbar">
                <div class="nav-links-wrapper">
                    <a href="/index.php" class="<?= $currentPage == 'index.php' ? 'active' : '' ?>">Beranda</a>
                    <a href="/about.php" class="<?= $currentPage == 'about.php' ? 'active' : '' ?>">Tentang Kami</a>
                    <a href="/doctors.php" class="<?= $currentPage == 'doctors.php' ? 'active' : '' ?>">Dokter</a>
                    <a href="/poli.php" class="<?= $currentPage == 'poli.php' ? 'active' : '' ?>">Layanan</a>
                    <a href="/jadwal.php" class="<?= $currentPage == 'jadwal.php' ? 'active' : '' ?>">Jadwal Dokter</a>
                    <a href="/kegiatan.php" class="<?= $currentPage == 'kegiatan.php' ? 'active' : '' ?>">Kegiatan</a>
                    <a href="/kontak.php" class="<?= $currentPage == 'kontak.php' ? 'active' : '' ?>">Kontak</a>
                </div>
            </nav>
        </div>

        <div class="hotline">
            <div class="hotline-icon"><i class="fas fa-phone-alt"></i></div>
            <div class="hotline-text">
                Hot Line Number<br><span>(0341) 580099</span>
            </div>
        </div>

        <div id="menu-toggle">
            <i data-feather="menu" class="menu-icon"></i>
            <i data-feather="x" class="x-icon"></i>
        </div>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script>
        feather.replace();
        const menuToggle = document.getElementById('menu-toggle');
        const navbar = document.querySelector('.navbar');
        const header = document.querySelector('header');

        if (menuToggle) {
            menuToggle.addEventListener('click', () => {
                navbar.classList.toggle('active');
                header.classList.toggle('nav-active');
            });
        }
    </script>
</body>
</html>