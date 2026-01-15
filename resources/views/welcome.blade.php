<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diskominfo Kota Binjai - Dashboard Sosial Media</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.bunny.net/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #004B9D 0%, #0066CC 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        /* Animated Background Shapes */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 20s infinite ease-in-out;
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            background: white;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            background: #FF6B1A;
            bottom: -50px;
            right: -50px;
            animation-delay: 2s;
        }

        .shape-3 {
            width: 150px;
            height: 150px;
            background: white;
            top: 50%;
            right: 10%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            25% { transform: translateY(-20px) rotate(90deg); }
            50% { transform: translateY(-40px) rotate(180deg); }
            75% { transform: translateY(-20px) rotate(270deg); }
        }

        /* Main Container */
        .main-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 1100px;
            padding: 20px;
        }

        .welcome-wrapper {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            display: flex;
            min-height: 550px;
            animation: slideUp 0.8s ease-out;
        }

        @keyframes slideUp {
            from { 
                opacity: 0; 
                transform: translateY(50px); 
            }
            to { 
                opacity: 1; 
                transform: translateY(0); 
            }
        }

        /* Left Side - Illustration */
        .welcome-left {
            flex: 1;
            background: linear-gradient(135deg, #004B9D 0%, #0066CC 100%);
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .welcome-left::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -200px;
            left: -200px;
        }

        .welcome-left::after {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255, 107, 26, 0.1);
            border-radius: 50%;
            bottom: -150px;
            right: -150px;
        }

        .logo-section {
            position: relative;
            z-index: 2;
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-circle {
            width: 150px;
            height: 150px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: pulse 3s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo-circle img {
            max-width: 120px;
            height: auto;
        }

        .logo-circle i {
            font-size: 4rem;
            color: #004B9D;
        }

        .welcome-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }

        .welcome-subtitle {
            font-size: 1rem;
            opacity: 0.95;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .welcome-description {
            font-size: 0.95rem;
            opacity: 0.9;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        .features-list {
            margin-top: 30px;
            text-align: left;
            position: relative;
            z-index: 2;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
            animation: fadeInLeft 0.8s ease-out;
        }

        .feature-item:nth-child(2) { animation-delay: 0.2s; }
        .feature-item:nth-child(3) { animation-delay: 0.4s; }

        @keyframes fadeInLeft {
            from { 
                opacity: 0; 
                transform: translateX(-20px); 
            }
            to { 
                opacity: 1; 
                transform: translateX(0); 
            }
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        /* Right Side - Form */
        .welcome-right {
            flex: 1;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #004B9D;
            margin-bottom: 10px;
        }

        .form-subtitle {
            color: #6c757d;
            margin-bottom: 40px;
            font-size: 0.95rem;
        }

        .btn-custom {
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 15px;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .btn-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-custom:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-primary-custom {
            background: linear-gradient(135deg, #004B9D 0%, #0066CC 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(0, 75, 157, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 75, 157, 0.4);
            color: white;
        }

        .btn-outline-custom {
            border: 2px solid #004B9D;
            color: #004B9D;
            background: transparent;
        }

        .btn-outline-custom:hover {
            background: #004B9D;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 75, 157, 0.3);
        }

        .btn-custom i {
            margin-right: 8px;
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #dee2e6;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            position: relative;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .footer-text {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #004B9D;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-icon:hover {
            background: #004B9D;
            color: white;
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .welcome-wrapper {
                flex-direction: column;
                min-height: auto;
            }

            .welcome-left {
                padding: 40px 30px;
            }

            .welcome-right {
                padding: 40px 30px;
            }

            .welcome-title {
                font-size: 1.8rem;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .features-list {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Background Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

    <div class="main-container">
        <div class="welcome-wrapper">
            <!-- Left Side -->
            <div class="welcome-left">
                <div class="logo-section">
                    <div class="logo-circle">
                        <!-- Jika logo ada, gunakan img tag -->
                        <!-- {{-- <img src="{{ asset('images/logo-diskominfo.png') }}" alt="Diskominfo Logo"> --}} -->
                        <img src="{{ asset('images/logo-diskominfo.png') }}" alt="" width="190">
                        <!-- Jika logo tidak ada, gunakan icon -->
                        <!-- <i class="fas fa-chart-lie"></i> -->
                    </div>
                    <h1 class="welcome-title">DISKOMINFO</h1>
                    <p class="welcome-subtitle">KOTA BINJAI</p>
                    <p class="welcome-description">
                        Sistem Informasi Manajemen & Monitoring Statistik Media Sosial
                    </p>
                </div>

                <div class="features-list">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div>
                            <strong>Real-time Analytics</strong><br>
                            <small>Monitor statistik secara langsung</small>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-share-alt"></i>
                        </div>
                        <div>
                            <strong>Multi Platform</strong><br>
                            <small>Facebook, Instagram, Twitter & lainnya</small>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-file-export"></i>
                        </div>
                        <div>
                            <strong>Export Report</strong><br>
                            <small>Export data ke Excel & PDF</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side -->
            <div class="welcome-right">
                <div>
                    <h2 class="form-title">Selamat Datang!</h2>
                    <p class="form-subtitle">Silakan masuk untuk mengakses dashboard</p>

                    @if (Route::has('login'))
                        <div class="d-grid">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-custom btn-primary-custom">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Buka Dashboard</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-custom btn-primary-custom">
                                    <i class="fas fa-sign-in-alt"></i>
                                    <span>Login Masuk</span>
                                </a>

                                @if (Route::has('register'))
                                    <div class="divider">
                                        <span>atau</span>
                                    </div>
                                    
                                    <a href="{{ route('register') }}" class="btn btn-custom btn-outline-custom">
                                        <i class="fas fa-user-plus"></i>
                                        <span>Daftar Akun Baru</span>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif

                    <div class="footer-text">
                        <p class="mb-2"><i class="fas fa-shield-alt"></i> Sistem Terlindungi & Terenkripsi</p>
                        <div class="social-icons">
                            <a href="https://www.facebook.com/share/1C5x3CocVS/?mibextid=wwXIfr" class="social-icon" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/diskominfo_binjai?igsh=MWFoYXY4dm5wbDV6aQ==" class="social-icon" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://x.com/diskominfobinje?s=20" class="social-icon" title="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.youtube.com/@diskominfokotabinjai6252" class="social-icon" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                        <p class="mt-3">&copy; {{ date('Y') }} Dinas Kominfo Kota Binjai. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>