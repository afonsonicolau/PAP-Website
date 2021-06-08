<!DOCTYPE html>
<html lang="pt">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Olfaire - Autenticação</title>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="/assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="/assets/css/shared/style.css">
    <!-- Favicon -->
    <link href="/storage/uploads/favicon.png" rel="icon">
  </head>
  <body>

    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">

            @yield('content')

                    <ul class="auth-footer">
                        <!-- Terms and Conditions -->
                        <li>
                            <a href="{{ route('terms') }}">Termos e Condições</a>
                        </li>
                        <!-- Client Support -->
                        <li>
                            <a href="{{ route('welcome') }}">Página Inicial</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- JS -->
    <script src="/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="/assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="/assets/js/shared/off-canvas.js"></script>
    <script src="/assets/js/shared/misc.js"></script>
    <script src="/assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <!-- Validation JS & CSS -->
    <script src="assets/js/validate.js"></script>
    <link rel="stylesheet" href="assets/css/validate.css">
</body>
</html>