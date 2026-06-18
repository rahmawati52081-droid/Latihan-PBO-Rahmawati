<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Bioskop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            background-color: #f4f6f9;
            height: 100vh;
            overflow: hidden;
        }

        /* Gaya Sidebar / Menu Samping */
        .sidebar {
            width: 260px;
            background-color: #1f2937;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar-brand {
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            background-color: #111827;
            letter-spacing: 1px;
        }

        .sidebar-brand i {
            color: #e50914; /* Warna merah khas bioskop/cinema */
            margin-right: 8px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
            flex-grow: 1;
        }

        .sidebar-menu li {
            padding: 2px 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .sidebar-menu a i {
            margin-right: 15px;
            width: 20px;
            font-size: 18px;
        }

        /* Efek hover dan menu aktif */
        .sidebar-menu a:hover, .sidebar-menu li.active a {
            color: #fff;
            background-color: #374151;
            border-left: 4px solid #e50914;
        }

        .sidebar-footer {
            padding: 15px;
            text-align: center;
            background-color: #111827;
            font-size: 12px;
            color: #6b7280;
        }

        /* Gaya Konten Utama */
        .main-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        header {
            background-color: #fff;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #374151;
        }

        .user-profile i {
            font-size: 20px;
            color: #4b5563;
        }

        .content-body {
            padding: 30px;
        }

        .welcome-box {
            background-color: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            margin-bottom: 30px;
        }

        .welcome-box h1 {
            color: #1f2937;
            margin-bottom: 10px;
        }

        /* Kartu Statistik / Ringkasan */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-details h3 {
            font-size: 14px;
            color: #7c8ba1;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .card-details p {
            font-size: 28px;
            font-weight: bold;
            color: #1f2937;
        }

        .card-icon {
            font-size: 36px;
            padding: 15px;
            border-radius: 50%;
        }

        /* Variasi warna ikon kartu */
        .icon-film { color: #3b82f6; background-color: #eff6ff; }
        .icon-jadwal { color: #10b981; background-color: #ecfdf5; }
        .icon-booking { color: #f59e0b; background-color: #fffbeb; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div>
            <div class="sidebar-brand">
                <i class="fa-solid fa-film"></i> TIX BIOSKOP
            </div>
            <ul class="sidebar-menu">
                <li class="active">
                    <a href="index.php"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
                </li>
                <li>
                    <a href="film.php"><i class="fa-solid fa-clapperboard"></i> Film</a>
                </li>
                <li>
                    <a href="#jadwal"><i class="fa-solid fa-calendar-days"></i> Jadwal</a>
                </li>
                <li>
                    <a href="#booking"><i class="fa-solid fa-ticket"></i> Booking</a>
                </li>
            </ul>
        </div>
        <div class="sidebar-footer">
            &copy; 2026 Tix Bioskop System
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="page-title">
                <h3 style="color: #4b5563;">Halaman Utama</h3>
            </div>
            <div class="user-profile">
                <i class="fa-solid fa-circle-user"></i>
                <span>Admin Bioskop</span>
            </div>
        </header>

        <div class="content-body">
            <div class="welcome-box">
                <h1>Selamat Datang Kembali!</h1>
                <p style="color: #6b7280;">Melalui panel kontrol ini, Anda dapat mengelola data film, mengatur jadwal tayang, serta memantau pesanan tiket bioskop secara berkala.</p>
            </div>

            <div class="stats-container">
                <div class="card">
                    <div class="card-details">
                        <h3>Total Film</h3>
                        <p>15</p>
                    </div>
                    <div class="card-icon icon-film">
                        <i class="fa-solid fa-clapperboard"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="card-details">
                        <h3>Jadwal Aktif</h3>
                        <p>8</p>
                    </div>
                    <div class="card-icon icon-jadwal">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>

                <div class="card">
                    <div class="card-details">
                        <h3>Booking Hari Ini</h3>
                        <p>42</p>
                    </div>
                    <div class="card-icon icon-booking">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>