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
    <style>
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
        {{-- <nav class="navbar navbar-expand-lg navbar-dark w-100">
            <div class="container-fluid d-flex justify-content-end">
                <a class="btn btn-outline-light me-2" href="{{ route('login') }}">Sign in</a>
                <a class="btn btn-primary" href="{{ route('register') }}" style="background-color: #FF6B6B; border: none; border-radius: 20px;">Sign up</a>
            </div>
        </nav> --}}

        <img src="{{ asset('images/logobiofarmakecil.png') }}" alt="" style="width: 250px; height: 250px;">
        <p style="font-size: 4rem;"><span></span> <span style="font-family: 'Ubuntu'; font-size: 5rem; color: #fff; text-shadow: 0 0 8px #ffffff;">Intellimice Classifier</span></p>
        <div style="margin-top: -2.5rem; font-family: 'Lugrasimo'; margin-bottom: 15px;">by Biofarma</div>
        <p style="font-size: 1.4rem;">Intellimice Classifier adalah platform yang dirancang untuk memfasilitasi pembelian mencit dengan kualitas terbaik.
        Melalui platform ini, anda dapat dengan mudah menemukan dan membeli mencit yang telah melalui proses klasifikasi ketat
        berdasarkan berbagai kriteria penting, seperti status kesehatan, jenis kelamin, dan kategori berat badan.
        Silahkan klik tombol berikut untuk melakukan pemesanan.</p>
        <div class="d-flex justify-content-center flex-wrap">
            <a href="{{ route('register') }}" class="btn btn-light me-3" style="font-family: 'ubuntu'; font-size: 1.2rem; padding: 8px 40px; margin: 5px; border-radius: 20px; font-weight: bold;">Get Started</a>
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
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#detailModal" onclick="loadDetail('Jenis Kelamin sudah terklasifikasi')">Lihat Detail</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card product-card mb-4" style="border: 1px solid #4B49AC;  border-radius: 4px; overflow: hidden;">
                    <img src="images/mencit.jpg" class="card-img-top" alt="Tikus Mencit 2" style="max-width: 100%; height: auto; object-fit: cover; border-radius: 4px 4px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title">Mencit dipastikan sehat</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#detailModal" onclick="loadDetail('Mencit dipastikan sehat')">Lihat Detail</button>
                    </div>
                </div>
            </div>            
            <div class="col-md-4">
                <div class="card product-card mb-4" style="border: 1px solid #4B49AC;  border-radius: 4px; overflow: hidden;">
                    <img src="images/mencit.jpg" class="card-img-top" alt="Tikus Mencit 2" style="max-width: 100%; height: auto; object-fit: cover; border-radius: 4px 4px 0 0;">
                    <div class="card-body">
                        <h5 class="card-title">Berat bervariasi</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        <button class="btn btn-secondary" data-toggle="modal" data-target="#detailModal" onclick="loadDetail('Berat bervariasi')">Lihat Detail</button>
                    </div>
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
        // Function to load detail content into the modal
        function loadDetail(title) {
            const details = {
            "Jenis Kelamin sudah terklasifikasi": "<p>Jenis kelamin dari mencit yang dijual di platform ini telah diklasifikasikan secara teliti melalui proses yang akurat dan terpercaya. Setiap mencit telah melalui pemeriksaan khusus untuk memastikan jenis kelaminnya sesuai, baik jantan maupun betina, sehingga Anda dapat memilih sesuai kebutuhan penelitian atau keperluan khusus lainnya. Proses klasifikasi ini dilakukan oleh tenaga ahli yang sudah berpengalaman di bidangnya, sehingga dapat mengurangi kemungkinan kesalahan dalam identifikasi.</p><p>Selain itu, klasifikasi jenis kelamin ini sangat membantu bagi Anda yang memiliki kebutuhan spesifik, misalnya dalam penelitian medis atau pengembangan produk farmasi yang mungkin membutuhkan jenis kelamin tertentu. Dengan mengetahui jenis kelamin, Anda bisa lebih mudah merencanakan penelitian atau eksperimen yang membutuhkan kesesuaian gender pada mencit. Layanan ini adalah bagian dari komitmen kami untuk memastikan kualitas mencit sesuai dengan standar yang diinginkan.</p><p>Kami menjamin keakuratan informasi jenis kelamin mencit yang Anda beli, yang sangat penting dalam menjaga konsistensi dan hasil dari percobaan Anda. Setiap mencit dilabeli dengan informasi jenis kelamin secara akurat sebelum didistribusikan, sehingga Anda dapat membeli dengan percaya diri dan mengurangi risiko kesalahan pada hasil penelitian Anda.</p>",

            "Mencit dipastikan sehat": "<p>Kesehatan setiap mencit yang tersedia di platform kami sudah melalui serangkaian pemeriksaan ketat dan berstandar tinggi. Mencit yang dipasarkan dipastikan dalam kondisi sehat, tanpa adanya penyakit atau masalah kesehatan yang dapat mempengaruhi kualitas atau hasil penelitian Anda. Pemeriksaan kesehatan ini dilakukan oleh tenaga ahli menggunakan alat yang dirancang khusus untuk memastikan bahwa mencit bebas dari penyakit menular atau genetik yang dapat membahayakan percobaan atau studi yang Anda lakukan.</p><p>Mencit sehat adalah kunci utama dalam berbagai penelitian medis dan bioteknologi karena kondisi kesehatan mencit yang optimal dapat menghasilkan data yang lebih konsisten dan valid. Prosedur kesehatan yang diterapkan di sini adalah sesuai standar biofarmasi, mulai dari observasi rutin hingga pengecekan kebersihan dan sanitasi untuk memastikan kondisi yang prima.</p><p>Dengan demikian, Anda dapat memiliki keyakinan bahwa mencit yang Anda beli tidak hanya memiliki kondisi kesehatan terbaik tetapi juga telah diperiksa secara menyeluruh untuk mendukung penelitian dan eksperimen dengan hasil yang lebih andal.</p>",

            "Berat bervariasi": "<p>Berat mencit di platform kami disediakan dalam berbagai kategori, memungkinkan Anda memilih sesuai dengan kebutuhan penelitian atau pengembangan produk yang spesifik. Kami menyadari bahwa berat badan mencit memainkan peran penting dalam berbagai eksperimen, misalnya dalam pengujian obat, eksperimen nutrisi, atau percobaan lainnya yang membutuhkan variasi dalam berat untuk hasil yang lebih akurat. Rentang berat yang tersedia mencakup mencit ringan hingga berat, yang dikelompokkan secara sistematis berdasarkan standar biofarmasi.</p><p>Kategori berat bervariasi ini memungkinkan Anda mendapatkan mencit dalam kondisi yang optimal untuk jenis penelitian tertentu, misalnya mencit dengan berat lebih rendah mungkin lebih sesuai untuk percobaan tertentu yang membutuhkan hewan uji lebih muda atau lebih ringan. Setiap mencit ditimbang dengan alat presisi tinggi sebelum diklasifikasikan dan dipasarkan, memastikan Anda mendapatkan informasi berat yang akurat.</p><p>Dengan menawarkan mencit dalam berbagai kategori berat, kami memberikan kemudahan bagi Anda untuk menyesuaikan kebutuhan penelitian secara lebih fleksibel. Hal ini juga meminimalkan risiko ketidakcocokan dalam eksperimen, karena Anda dapat memilih mencit dengan spesifikasi berat yang diinginkan.</p>"
        };
            document.getElementById('detailModalLabel').textContent = title;
            document.getElementById('modalBodyContent').innerHTML = details[title] || "Detail tidak tersedia.";
        }
    </script>
</body>
</html>
