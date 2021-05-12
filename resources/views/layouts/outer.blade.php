<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Olfaire Mendes&Nicolau</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/mainpage/img/favicon.png" rel="icon">
  <link href="/assets/mainpage/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="/assets/mainpage/vendor/aos/aos.css" rel="stylesheet">
  <link href="/assets/mainpage/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/mainpage/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="/assets/mainpage/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="/assets/mainpage/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="/assets/mainpage/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="/assets/mainpage/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/mainpage/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Bethany - v4.0.1
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
        <!-- ======= Header ======= -->
        <header id="header" class="fixed-top d-flex align-items-center">
            <div class="container">
                <div class="header-container d-flex align-items-center justify-content-between">
                    <div class="logo">
                        <h1 class="text-light"><a href="#home"><span>Olfaire</span></a></h1>
                        <!-- Uncomment below if you prefer to use an image logo -->
                        <!-- <a href="index.html"><img src="/assets/mainpage/img/logo.png" alt="" class="img-fluid"></a>-->
                    </div>
                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a href="#header">Início</a></li>
                            <li><a href="#about">Sobre Nós</a></li>
                            <li><a href="#portfolio">Produtos</a></li>
                            <li><a href="#team">Equipa</a></li>
                            <li><a href="#contact">Contacte-nos</a></li>
                            <li><a href="{{ route('online-shop.index') }}">Loja Online</a></li>
                            @if (auth()->user() && auth()->user()->role_id == 2)
                                <li><a href="{{ route('home') }}">Backoffice</a></li>
                            @endif
                            @if (auth()->user())
                                <a class="getstarted scrollto" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Terminar Sessão</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            @else
                                <li><a class="getstarted scrollto" href="{{ route('register') }}">Registe-se!</a></li>
                            @endif
                        </ul>
                        <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav><!-- .navbar -->
                </div><!-- End Header Container -->
            </div>
        </header>
        <!-- End Header -->

@yield('content')

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Olfaire</h3>
            <p>
              Estrada Nacional 8<br>
              Tornada, 2500-315<br>
              Portugal<br><br>
              <strong>Telefone:</strong> +351 262 881 213<br>
              <strong>Email:</strong> olfaire@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-4 col-md-6 footer-newsletter">
            
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Páginas Úteis</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('welcome') }}">Página Inicial</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('online-shop.index') }}">Loja Online</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="{{ route('terms') }}">Termos e Condições</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>Olfaire Mendes&Nicolau</span></strong>. All Rights Reserved.
        </div>
        <div class="credits">
          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a target="_blank" href="https://www.facebook.com/Olfaire-522861334579028" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a target="_blank" href="https://www.instagram.com/olfaire_oficial/" class="instagram"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/mainpage/vendor/aos/aos.js"></script>
  <script src="/assets/mainpage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/mainpage/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="/assets/mainpage/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="/assets/mainpage/vendor/php-email-form/validate.js"></script>
  <script src="/assets/mainpage/vendor/purecounter/purecounter.js"></script>
  <script src="/assets/mainpage/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/mainpage/js/main.js"></script>
  
  <!-- Font Awesome-->
  <script src="https://kit.fontawesome.com/303362d7a7.js" crossorigin="anonymous"></script>

</body>

</html>