<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intellify</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="{{ asset('images/logobiofarmakecil.png') }}" />
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lugrasimo&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            color: #4b49ac;
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
            color: #4B49AC;
            border: 2px solid #4B49AC;
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

    <div class="hero-section">
        <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="" style="width: 250px; height: 250px;">
        <p style="font-size: 4rem;"><span>Welcome to</span> <span style="font-family: 'Ubuntu'; font-size: 5rem; color: #fff; text-shadow: 0 0 8px #ffffff;">Intellify</span></p>
        <div style="margin-top: -2rem; font-family: 'Lugrasimo'; margin-bottom: 25px;">by Biofarma</div>
        <p style="font-size: 1.4rem;">Intellify adalah platform yang dirancang untuk memfasilitasi pembelian mencit dengan kualitas terbaik.
        Melalui platform ini, anda dapat dengan mudah menemukan dan membeli mencit yang telah melalui proses klasifikasi ketat
        berdasarkan berbagai kriteria penting, seperti status kesehatan, jenis kelamin, dan kategori berat badan.
        Silahkan login atau register untuk melakukan pemesanan.</p>
        <div class="d-flex justify-content-center flex-wrap">
            <a href="{{ route('login') }}" class="btn btn-light me-3" style="font-size: 1.2rem; padding: 10px 25px; margin: 5px;">Login</a>
            <a href="{{ route('register') }}" class="btn btn-secondary" style="font-size: 1.2rem; padding: 10px 25px; margin: 5px;">Register</a>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center">Detail Produk Kami</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card product-card mb-4" style="border: 1px solid #4B49AC;  border-radius: 4px; overflow: hidden;">
                    <img src="images/mencit.jpg" class="card-img-top" alt="Tikus Mencit 2" style="max-width: 100%; height: auto; object-fit: cover; border-radius: 4px 4px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title">Jenis Kelamin sudah terklasifikasi</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <a href="#" class="btn btn-secondary">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card mb-4" style="border: 1px solid #4B49AC;  border-radius: 4px; overflow: hidden;">
                    <img src="images/mencit.jpg" class="card-img-top" alt="Tikus Mencit 2" style="max-width: 100%; height: auto; object-fit: cover; border-radius: 4px 4px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title">Mencit dipastikan sehat</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <a href="#" class="btn btn-secondary">Lihat Detail</a>
                    </div>
                </div>
            </div>            
            <div class="col-md-4">
                <div class="card product-card mb-4" style="border: 1px solid #4B49AC;  border-radius: 4px; overflow: hidden;">
                    <img src="images/mencit.jpg" class="card-img-top" alt="Tikus Mencit 2" style="max-width: 100%; height: auto; object-fit: cover; border-radius: 4px 4px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title">Berat bervariasi</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <a href="#" class="btn btn-secondary">Lihat Detail</a>
                    </div>
                </div>
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
</body>
</html>
