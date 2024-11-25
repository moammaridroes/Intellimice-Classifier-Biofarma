<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intellimice Classifier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        <style>  
            
        body {
            margin: 0%;
            padding: 0%;
            background-color: #f8f9fa;
            color: #4b49ac;
        }

        .header {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 1200px;
            background: #f6f6fb; /* Warna utama sesuai */
            box-shadow: 0 4px 6px rgba(28, 27, 99, 0.3); /* Warna shadow sedikit sesuai dengan tema */
            border-radius: 12px;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 1000;
            color: #ffffff; /* Teks putih agar kontras dengan warna latar */
        }

        .header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1c1b63;
            text-decoration: none;
        }

        .header .nav {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header .nav a {
            text-decoration: none;
            color: #000000;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }

        .header .nav a:hover {
            color: #1c1b63;
        }

        .header .actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header .actions a {
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .header .login {
            color: #000000;
            transition: color 0.3s ease-in-out;
        }

        .header .login:hover {
            color: #3230b1;
        }

        .header .join-now {
            background: #1c1b63;
            color: #ffffff;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease-in-out;
        }

        .header .join-now:hover {
            background: #3230b1;
        }

        .content {
            margin-top: 100px;
            padding: 20px;
        }

        .hero-section {
            background-color: #1c1b63;
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 0 15px;
            position: relative; /* Untuk garis latar belakang */
            overflow: hidden;
            background-image: url('{{ asset("images/garis.png") }}');
            background-size: cover; /* Menutupi seluruh area */
            background-repeat: no-repeat; /* Tidak mengulang gambar */
            background-position: center; /* Pusatkan gambar */
        }
        .hero-section .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 1rem 2rem;
            z-index: 10; /* Supaya berada di atas konten hero */
        }

        .hero-section .btn-outline-light {
            color: #ffffff;
            border-color: #ffffff;
            border-radius: 20px;
        }

        .hero-section .btn-outline-light:hover {
            background-color: #ffffff;
            color: #1c1b63;
        }

        .hero-section .btn-primary {
            background-color: #FF6B6B;
            border-radius: 20px;
        }

        .hero-section .btn-primary:hover {
            background-color: #E55D5D;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }
        .hero-section p {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        .hero-section .biofarma {
            font-size: 1.2rem;
            margin-top: 0px;
            color: #ffffff;
            margin-bottom: 20px;
        }
        .btn-light {
            background-color: white;
            color: #1c1b63;
            border: 2px solid #1c1b63;
        }
        .btn-light:hover {
            background-color: #4B49AC;
            color: white;
        }
        .btn-secondary {
            background-color: #4B49AC;
            border: none;
        }
        .btn-secondary:hover {
            background-color: #3e3b8a;
        }
        #details {
            background-color: #f8f9fa; /* Background warna sesuai tema */
            padding: 30px; /* Jarak antara konten dan tepi */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Pusatkan konten secara vertikal */
            align-items: center; /* Pusatkan konten secara horizontal */
        }

        #lokasi {
            background-color: #f8f9fa; /* Warna latar belakang untuk kontras */
            padding: 60px 15px;
        }

        #lokasi h5 {
            color: #9333EA;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        #lokasi h2 {
            color: #1c1b63;
            font-size: 2.5rem;
        }

        #lokasi p {
            font-size: 1rem;
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        #lokasi .btn-primary {
            background-color: #1c1b63;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            transition: background-color 0.3s ease-in-out;
        }

        #lokasi .btn-primary:hover {
            background-color: #9333EA;
        }

        #lokasi .img-fluid {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        #lokasi .row .col-md-3 img {
            margin-bottom: 20px;
            border-radius: 8px;
        }


        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            color: #4B49AC;
        }
        .product-card {
            border: 1px solid #4B49AC;
            border-radius: 10px;
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .footer-logo {
            font-size: 1.5rem;
            color: #4B49AC;
        }

        /* Responsif untuk tampilan mobile */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            .hero-section p {
                font-size: 1.2rem;
            }
            .btn-light, .btn-secondary {
                font-size: 1rem;
                padding: 8px 20px;
                margin: 5px;
            }
        }
    </style>

</head>
<body>
     <!-- Header -->
     <header class="header">
        <a href="#" class="logo">Intellimice</a>
        <nav class="nav">
            <a href="#about">Tentang kami</a>
            <a href="#details">Details</a>
            <a href="#lokasi">Lokasi</a>
            <a href="#resources">ap ya</a>
            <!-- Dropdown untuk bahasa -->
            {{-- <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Bahasa
                </a>
                <div class="dropdown-menu" aria-labelledby="languageDropdown">
                    <a class="dropdown-item" href="{{ url('locale/en') }}">English</a>
                    <a class="dropdown-item" href="{{ url('locale/id') }}">Bahasa Indonesia</a>
                </div>
            </div> --}}
        </nav>
        <div class="actions">
            <a href="{{ route('login') }}" class="login">Log In</a>
            <a href="{{ route('register') }}" class="join-now">Register</a>
        </div>
    </header>

    {{-- About Us --}}
    <div class="hero-section" id="about">
        <div style="margin-top: 50px; text-align: center;">
            <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="" style="width: 250px; height: 250px; margin-bottom: 10px;">
            <p style="font-size: 4rem; margin-top: 20px;">
                <span style="font-family: 'Ubuntu'; font-size: 5rem; color: #fff; text-shadow: 0 0 8px #ffffff;">Intellimice Classifier</span>
            </p>
            <div style="margin-top: -1.8rem; font-family: 'Lugrasimo'; margin-bottom: 35px;">by Biofarma</div>
            <p style="font-size: 1.4rem; margin-top: 20px;">
                Intellimice Classifier adalah platform yang dirancang untuk memfasilitasi pembelian mencit dengan kualitas terbaik.
                Melalui platform ini, anda dapat dengan mudah menemukan dan membeli mencit yang telah melalui proses klasifikasi ketat
                berdasarkan berbagai kriteria penting, seperti status kesehatan, jenis kelamin, dan kategori berat badan.
                Silahkan klik tombol berikut untuk melakukan pemesanan.
            </p>
            <div class="d-flex justify-content-center flex-wrap" style="margin-top: 20px;">
                <a href="{{ route('register') }}" class="btn btn-light me-3" style="font-family: 'ubuntu'; font-size: 1.2rem; padding: 8px 40px; margin: 5px; border-radius: 20px; font-weight: bold;">Get Started</a>
            </div>
        </div>
    </div>

    <!-- Detail Section -->
    <div class="container-fluid py-5" id="details" style="background-color: #f8f9fa;">
        <div class="row align-items-center justify-content-center" style="margin-left: 5%; margin-right: 2%;">
            <div class="row align-items-center">

                <!-- Carousel Section -->
                <div class="col-md-6">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="images/mencit.jpg" class="d-block w-100 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block" style="color: black;">
                                    <p>Jenis Kelamin sudah terklasifikasi</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/mencit.jpg" class="d-block w-100 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block" style="color: #000000">
                                    <p>Mencit dipastikan sehat</p>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="images/mencit.jpg" class="d-block w-100 rounded" alt="...">
                                <div class="carousel-caption d-none d-md-block" style="color: #000000">
                                    <p>Berat bervariasi</p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- Text Content -->
                <div class="col-md-6 text-white">
                    <h2 class="mb-4 font-weight-bold" style="color: #1c1b63;">Detail mencit kami</h2>
                    <p class="text-muted">
                        Laboratorium kami menyediakan lingkungan yang mendukung untuk penelitian mencit dengan standar tinggi.
                        Kami memprioritaskan keakuratan klasifikasi dan kesehatan mencit untuk mendukung penelitian ilmiah dan eksperimen farmasi.
                    </p>
                    <a onclick="loadDetail('Details')" class="btn btn-primary" style="background-color: #1c1b63; border-radius: 8px;" data-toggle="modal" data-target="#detailModal">
                        Lihat Detail
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Popup -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBodyContent">
                    <!-- Konten detail akan dimuat di sini -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- lokasi --}}
    <div class="container-fluid py-5" id="lokasi" style="background-color: #f8f9fa;">
        <div class="row align-items-center justify-content-center" style="margin-left: 5%; margin-right: 2%;">
            <div class="col-md-6" style="margin-top: -5rem;">
                <h5 class="text-uppercase font-weight-bold text-primary">Lokasi</h5>
                <h2 class="mb-4 font-weight-bold">Laboratorium mencit</h2>
                <p class="text-muted">
                    Laboratorium ini dirancang khusus untuk pengelolaan dan pemeliharaan mencit dengan standar internasional. Fasilitas kami memastikan lingkungan yang steril dan aman, serta memberikan perhatian khusus terhadap kebutuhan biologis mencit. Dengan perlengkapan modern dan pengawasan ketat, laboratorium ini memungkinkan penelitian yang akurat dan mendukung inovasi di berbagai bidang seperti bioteknologi, farmasi, dan medis.
                </p>       
                <a href="https://www.google.com/maps/search/?api=1&query=-6.230173,106.845101" class="btn btn-primary" style="background-color: #1c1b63; border-radius: 8px;" target="_blank">Lihat Lokasi</a>
            </div>
            <!-- Kolom Gambar -->
            <div class="col-md-6">
                <img src="images/tikus1.jpg" alt="Team Work" class="img-fluid rounded shadow">
            </div>
        </div>
    
        <!-- Subsection Gambar -->
        <div class="row mt-5 d-flex justify-content-center align-items-center" style="background-color: #1c1b63; height: 320px;">
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="images/tikus4.jpg" alt="lab1" class="img-fluid rounded">
            </div>
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="images/tikus3.jpg" alt="lab2" class="img-fluid rounded">
            </div>
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="images/tikus4.jpg" alt="lab3" class="img-fluid rounded">
            </div>
            <div class="col-md-3 d-flex justify-content-center align-items-center">
                <img src="images/tikus3.jpg" alt="lab4" class="img-fluid rounded">
            </div>
        </div>
    </div>

    <hr class="my-1">
    <footer class="text-center mt-5">
        <p>Copyright &copy; 2024, Biofarma. STAS-RG. All rights reserved.</p>
        {{-- <div class="footer-logo"> --}}
            {{-- <i class="fas fa-mouse"></i>
            <span>by Biofarma</span> --}}
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        function loadDetail(title) {
            const details = {
                "Details": "<p>Platform kami menyediakan mencit berkualitas tinggi yang telah melalui serangkaian proses klasifikasi ketat untuk memastikan jenis kelamin, kesehatan, dan berat yang sesuai kebutuhan Anda. Setiap mencit diperiksa oleh tenaga ahli untuk menjamin akurasi dan bebas dari penyakit yang dapat memengaruhi hasil penelitian atau eksperimen.</p><p>Klasifikasi jenis kelamin membantu Anda memenuhi kebutuhan spesifik seperti penelitian medis atau pengembangan produk farmasi. Selain itu, kesehatan mencit dipastikan optimal melalui pemeriksaan rutin sesuai standar biofarmasi, memberikan hasil penelitian yang konsisten dan valid.</p><p>Berat mencit tersedia dalam berbagai kategori, memungkinkan Anda memilih sesuai kebutuhan eksperimen, mulai dari mencit ringan hingga berat. Proses ini mendukung fleksibilitas penelitian dan memastikan hasil yang lebih akurat serta sesuai standar ilmiah. Dengan platform ini, Anda dapat melakukan pembelian mencit secara efisien dan terpercaya.</p>"              
            };

            if (details[title]) {
                document.getElementById('detailModalLabel').textContent = title;
                document.getElementById('modalBodyContent').innerHTML = details[title];
            } else {
                document.getElementById('detailModalLabel').textContent = "Detail Tidak Tersedia";
                document.getElementById('modalBodyContent').innerHTML = "<p>Detail tidak tersedia.</p>";
            }
        }
            document.querySelectorAll('.nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 50,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
