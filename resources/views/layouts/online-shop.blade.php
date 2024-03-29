<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7"><![endif]-->
<!--[if IE 8]><html class="ie ie8"><![endif]-->
<!--[if IE 9]><html class="ie ie9"><![endif]-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <meta name="author" content="Nghia Minh Luong">
    <meta name="keywords" content="Default Description">
    <meta name="description" content="Default keyword">

    <title>Olfaire - Loja Online</title>

    <!-- Icons -->
    <link href="/storage/uploads/favicon.png" rel="icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="/assets/onlineshop/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/onlineshop/ps-icon/style.css">
    <!-- CSS Library -->
    <link rel="stylesheet" href="/assets/onlineshop/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/onlineshop/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="/assets/onlineshop/jquery-bar-rating/dist/themes/fontawesome-stars.css">
    <link rel="stylesheet" href="/assets/onlineshop/slick/slick/slick.css">
    <link rel="stylesheet" href="/assets/onlineshop/bootstrap-select/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="/assets/onlineshop/Magnific-Popup/dist/magnific-popup.css">
    <link rel="stylesheet" href="/assets/onlineshop/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="/assets/onlineshop/revolution/css/settings.css">
    <link rel="stylesheet" href="/assets/onlineshop/revolution/css/layers.css">
    <link rel="stylesheet" href="/assets/onlineshop/revolution/css/navigation.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/onlineshop/css/style.css">
    <!-- Order Confirmation CSS -->
    <link rel="stylesheet" href="/assets/css/orderconfirmation.css">
</head>

<body class="ps-loading">
    <div class="header--sidebar"></div>
    <header class="header">
        <div class="header__top">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-6 col-xs-12 ">
                        <p>Estrada Nacional 8, Tornada, 2500-315 - Telefone: +351 262 881 213</p>
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 ">
                        <div class="header__actions">
                            <!-- Authentication -->
                            @if (auth()->user())
                                <a href="{{ route('online-shop.profile-personal') }}">Perfil</a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">Terminar Sessão
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-flex">
                                    @csrf
                                </form>
                            @else
                                <a href="{{ route('login') }}">Iniciar Sessão</a>
                                <a href="{{ route('register') }}">Registar-me</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navigation">
            <div class="container-fluid">
                <div class="navigation__column left">
                    <div class="header__logo"><a class="ps-logo" href="{{ route('welcome') }}">
                        <img src="/storage/uploads/banner.png" alt=""></a>
                    </div>
                </div>
                <div class="navigation__column center">
                    <ul class="main-menu menu">
                        <li class="menu-item"><a href="{{ route('online-shop.index') }}">Ínicio</a></li>
                        <li class="menu-item"><a href="{{ route('online-shop.product-listing') }}">Produtos</a></li>
                    </ul>
                </div>
                <div class="navigation__column right">
                    <!-- Search product -->
                    <form class="ps-search--header" id="searchForm">
                        <input class="form-control" type="text" id="searchInput" placeholder="Pesquisar produto…">
                        <button type="button" id="searchProduct" onclick="productSearch()"><i class="fas fa-search btn btn-success" style="border-radius: 40px;"></i></button>
                    </form>
                    @if (auth()->user())
                        <div class="ps-cart"><a class="ps-cart__toggle" href="#">
                                @if ($cartItems->count() > 0) <span><i id="itemsCount">{{ $cartItems->sum('quantity') }}</i></span> @endif <i class="ps-icon-shopping-cart"></i>
                            </a>
                            <div class="ps-cart__listing">
                                <div class="ps-cart__content">
                                    <!-- Cart item -->
                                    @php
                                        $total = 0;
                                        $totalQuantity = 0;
                                        $i = 0;
                                    @endphp
                                    @if ($cartItems != '')
                                        @foreach ($cartItems as $item)
                                            @if ($i < 2)
                                                <div class="ps-cart-item" id="cartItem_{{ $item->product_id }}">
                                                    <div class="ps-cart-item__thumbnail"><a href="{{ route('online-shop.product-detail', $item->product_id) }}"></a><img src="/storage/thumbnail/{{ $item->product->thumbnail }}" alt=""></div>
                                                    <div class="ps-cart-item__content"><a class="ps-cart-item__title" href="{{ route('online-shop.product-detail', $item->product_id) }}">{{ $item->product->type->type }}</a>
                                                        <p class="pr-70"><span>Quantidade:<i id="cartItemQuantity_{{ $item->product_id }}">{{ $item->quantity }}</i></span>
                                                            <br><span style="display: flex; margin-left: 9px;">Subtotal:<i id="cartItemTotal_{{ $item->product_id }}">{{ round( (($item->iva / 100) * ($item->price)) + $item->price, 2) * $item->quantity }}€</i></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                    $total += round( (($item->iva / 100) * ($item->price)) + $item->price, 2) * $item->quantity;
                                                    $totalQuantity += $item->quantity;
                                                @endphp
                                            @else
                                                <p style="text-align: left; margin-left: 5%;"><b>Existem mais produtos no carrinho, para os poder ver, por favor, clique "Editar Carrinho"</b></p>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <!-- Cart total -->
                                <div class="ps-cart__total">
                                    <p>Quantidade total:<span id="cartQuantityTotal">{{ $totalQuantity }} produto(s)</span></p>
                                    <p>Preço total:<span id="cartPriceTotal">{{ $total }}€</span></p>
                                </div>
                                @if ($totalQuantity > 0)
                                    <div class="ps-cart__footer"><a class="ps-btn" href="{{ route('online-shop.cart', auth()->user()->id) }}">Editar Carrinho<i class="ps-icon-arrow-left"></i></a></div>
                                @endif
                            </div>
                        </div>
                    @endif
                    <div class="menu-toggle"><span></span></div>
                </div>
            </div>
        </nav>
    </header>
    <div class="header-services">
        <div class="ps-services owl-slider" data-owl-auto="true" data-owl-loop="true" data-owl-speed="7000"
            data-owl-gap="0" data-owl-nav="true" data-owl-dots="false" data-owl-item="1" data-owl-item-xs="1"
            data-owl-item-sm="1" data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000"
            data-owl-mousedrag="on">
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Produtos Tradicionais!</strong> A Olfaire
                dedica-se a 100% a criar produtos tradicionais.</p>
            <p class="ps-service"><i class="ps-icon-delivery"></i><strong>Envio Rápido</strong>: A Olfaire tenta o seu
                máximo para um processo de encomenda rápido!</p>
        </div>
    </div>
    <main class="ps-main">

        @yield('content')


        </div>
        <div class="ps-subscribe">
            <div class="ps-container">
                <div class="row">
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 ">
                        <p><strong>Olfaire Mendes&Nicolau</strong></p>
                    </div>
                    <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 ">
                    </div>
                    <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12 ">
                        <p>dedicados à faiança e cerâmica desde 1952...</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ps-footer bg--cover" data-background="">
            <div class="ps-footer__content">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--info">
                                <header><a class="ps-logo" href="{{ route('welcome') }}"><img src="/storage/uploads/banner.png" alt=""></a>
                                    <h3 class="ps-widget__title">Endereço da Empresa</h3>
                                </header>
                                <footer>
                                    <p><strong>Estrada Nacional 8,</strong> </p>
                                    <p><strong>Tornada, 2500-315</strong></p>
                                    <p><strong>Portugal</strong></p>
                                    <p>E-mail: olfaire@gmail.com</p>
                                    <p>Telefone: +351 262 881 213</p>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 ">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">Find Our store</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--link">
                                        <li><a href="#">Coupon Code</a></li>
                                        <li><a href="#">SignUp For Email</a></li>
                                        <li><a href="#">Site Feedback</a></li>
                                        <li><a href="#">Careers</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 ">
                            <aside class="ps-widget--footer ps-widget--link">
                                <header>
                                    <h3 class="ps-widget__title">Apoio ao Cliente</h3>
                                </header>
                                <footer>
                                    <ul class="ps-list--line">
                                        <li><a href="#">Encomendas e Envio</a></li>
                                        <li><a href="#">Opções de Pagamento</a></li>
                                    </ul>
                                </footer>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-footer__copyright">
                <div class="ps-container">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <p>&copy; <a href="#">Copyright</a> <strong><span>Olfaire Mendes&Nicolau</span></strong>. All Rights Reserved.</p>
                            <p>Design by <a href="#"> Alena Studio</a></p>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                            <ul class="ps-social">
                                <li><a target="_blank" href="https://www.facebook.com/Olfaire-522861334579028"><i class="fa fa-facebook"></i></a></li>
                                <li><a target="_blank" href="https://www.instagram.com/olfaire_oficial/"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Library-->
    <script type="text/javascript" src="/assets/onlineshop/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/owl-carousel/owl.carousel.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/gmap3.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/imagesloaded.pkgd.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/slick/slick/slick.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/elevatezoom/jquery.elevatezoom.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/Magnific-Popup/dist/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="/assets/onlineshop/revolution/js/extensions/revolution.extension.actions.min.js"></script>
    <!-- Custom JS scripts-->
    <script type="text/javascript" src="/assets/onlineshop/js/main.js"></script>
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Sweet Alerts JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Validation JS & CSS -->
    <script src="/assets/js/validate.js"></script>
    <link rel="stylesheet" href="/assets/css/validate.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/303362d7a7.js" crossorigin="anonymous"></script>
    <!-- Custom Script -->
    <script>
        // Outlet products
        let outlet = 0;

        function removeFilters() {
            $(".collection_filter").removeClass("current");
            $("#collection_none").addClass("current");

            $(".type_filter").removeClass("current");
            $("#type_none").addClass("current");

           $("#searchInput").html("");
        }

        $("#all_products").on('click', function() {
            $(".active").removeClass('active').removeClass('current');
            $(this).addClass('active').addClass('current');

            removeFilters();

            outlet = 0;

            getPriceRange();
        });

        $("#outlet_products").on('click', function() {
            $(".active").removeClass('active').removeClass('current');
            $(this).addClass('active').addClass('current');

            removeFilters();

            outlet = 1;

            getPriceRange();

        });

        // Limit collections and types
        let limiterCollections = 0; let limiterTypes = 0;
        let collectionsState = "more"; let typesState = "more";

        function limitCollections(numCollections) {
            $(`.collection_filter`).show();

            for (let i = 11 + limiterCollections; i < numCollections + 10 + limiterCollections; i++) {
                $(`.collectionH_${i}`).hide();
            }
        }

        function limitTypes(numTypes) {
            $(`.type_filter`).show();

            for (let i = 11 + limiterTypes; i < numTypes + 10 + limiterTypes; i++) {
                $(`.typeH_${i}`).hide();
            }
        }

        $(document).ready($(function() {
            let numCollections = ($(".collection_filter").length) - 1;
            let numTypes = ($(".type_filter").length) - 1;

            if(numCollections > 10) {
                limitCollections(numCollections);
            }

            if(numTypes > 10) {
                limitTypes(numTypes);
            }
        }));

        $(".showmoreCollections").on("click", function(event){
            event.preventDefault();

            let numCollections = ($(".collection_filter").length) - 1;

            if(collectionsState == "minus") {
                limiterCollections = limiterCollections - 10;
            }
            else if(collectionsState == "more") {
                limiterCollections = limiterCollections + 10;
            }

            if(numCollections <= limiterCollections + 10) {
                $(".showmoreCollections").text('Ver menos');
                collectionsState = "minus";
            }
            else if(limiterCollections == 0)  {
                $(".showmoreCollections").text('Ver mais');
                collectionsState = "more";
            }

            limitCollections(numCollections);
        });

        $(".showmoreTypes").on("click", function(event){
            event.preventDefault();

            let numTypes = ($(".collection_filter").length) - 1;

            if(typesState == "minus") {
                limiterTypes = limiterTypes - 10;
            }
            else if(typesState == "more") {
                limiterTypes = limiterTypes + 10;
            }

            if(numTypes <= limiterTypes + 10) {
                $(".showmoreTypes").text('Ver menos');
                typesState = "minus";
            }
            else if(limiterTypes == 0)  {
                $(".showmoreTypes").text('Ver mais');
                typesState = "more";
            }

            limitTypes(numTypes);
        });

        /* // Ajax Pagination
        $(".pagination a").on("click", function(event) {
            event.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetch_data(page);
        });

        function fetch_data(page) {
            $.ajax({
                url: "",
                success: function(data) {
                    $("#table_data").html(data);
                }
            })
        } */

        // On "Enter" key press, productSearch() is called and refresh page in stopped.
        $("#searchInput").keyup(function(event) {
            if (event.which == 13) {
                $(".type_filter").removeClass("current");
                $(".collection_filter").removeClass("current");
                $("#collection_none").addClass("current");
                $("#type_none").addClass("current");

                $("#searchForm").submit();
            }
        });

        $("#searchForm").on("submit", function(e) {
            e.preventDefault();

            let length = ($("#searchInput").val()).length
            if(length >= 2) {
                productSearch();
            }
        });

        // Show or not the inputs depending on the check
        $(document).ready($(function() {
            hideInputs();
        }));

        function hideInputs() {
            if($("#changepassword").length) {
                if($("#changepassword")[0].checked) {
                    $("div .info").removeClass("hidden");
                }
                else{
                    $("div .info").addClass("hidden");
                }
            }
        };

        // Delete item from cart
        function cartDelete(productId, productPrice) {
            Swal.fire({

                title: 'Tem a certeza que quer retirar este produto do carrinho?',
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Remover Produto',
                cancelButtonText: 'Voltar Atrás'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/online-shop/cart/${productId}`,
                        type: "DELETE",
                        data: {
                            '_token': '{{ csrf_token() }}'
                        },
                        datatype: "html",
                        success: function(response) {
                            // Variables
                            let total = $("#productsTotal").text();
                            total = total.replace("€", "");

                            let totalCartQuantity = $("#cartQuantityTotal").text();
                            totalCartQuantity = totalCartQuantity.replace(" produto(s)", "");

                            // Quantity
                            let cartQuantity = $(`#cartQuantity_${productId}`).val();
                            let quantity = parseInt(cartQuantity);

                            // Change front-end values
                            let totalPrice = total - (productPrice * cartQuantity);
                            totalPrice = totalPrice.toFixed(2);

                            $("#cartQuantityTotal").text(totalCartQuantity - quantity + " produto(s)");
                            $(`#productsTotal`).text(totalPrice + "€");
                            $(`#cartPriceTotal`).text(totalPrice + "€");

                            // Change icon number
                            let count = $("#itemsCount").text();
                            count = Number(count);
                            let countTotal = count - quantity

                            if (countTotal > 0) {
                                $("#itemsCount").text(countTotal);
                            } else {
                                $("#itemsCount").parent("span").remove();
                                $("#itemsCount").remove();
                            }

                            // Remove cart items front-end
                            $(`#cartItem_${productId}`).remove();
                            $(`#cart_${productId}`).remove();

                            // Send front-end notification
                            Swal.fire(
                                'Produto Retirado!',
                                'A ação ocorreu com sucesso e o produto foi retirado do carrinho!',
                                'success'
                            )

                            if (response <= 0) {
                                setTimeout(function() {
                                    // Reload page after 2 seconds
                                    location.reload();
                                }, 2000);
                            }

                        },
                        error: function() {
                            Swal.fire(
                                'Não foi possível retirar o produto!',
                                'Tente novamente mais tarde.',
                                'error'
                            )
                        }
                    });
                }
            })
        };

        //  -- Filters --
        function productsFilter(collectionId, typeId, priceRange, outlet) {
            $.ajax({
                type: "GET",
                data: { '_token': '{{ csrf_token() }}' },
                dataType: "json",
                url: `/online-shop/product-listing/${collectionId}/${typeId}/${priceRange}/${outlet}`,
                success: function(response) {
                    $('.ps-product__columns').empty();

                    let products = response.data ? response.data : response;
                    for (let i = 0; i < products.length; i++) {
                        let product = products[i];

                        let url = '{{ route('online-shop.product-detail', ':product') }}';
                        url = url.replace(':product', product.id);

                        let iva = (product.iva / 100) * (product.price);
                        let totalPrice = iva + product.price;
                        totalPrice = totalPrice.toFixed(2);

                        let colors = JSON.parse(product.color);
                        let colorsText = "Cores: ";

                        colors.forEach(color => {
                            colorsText = colorsText.concat(color + ", ");
                        });

                        // Slice two last characters
                        colorsText = colorsText.slice(0, -1)
                        colorsText = colorsText.slice(0, -1)

                        // Subtract created_at from now timestamp
                        let timePassedMs = Date.now() - Date.parse(product.created_at);

                        let badge = "";
                        if((timePassedMs / 1000) < 604800) {
                            badge = '<div class="ps-badge"><span>Novo</span></div>'
                        }

                        let outletBadge = "";
                        if(product.outlet == 1) {
                            outletBadge = '<div class="ps-badge ps-badge--sale ps-badge--2nd"><span>Outlet</span></div>'
                        }

                        let stock = "";
                        if(product.stock >= 100)
                            stock = `<p>Stock: <b class="text-success">${product.stock} unidades</b></p>`
                        else if(product.stock >= 30)
                            stock = `<p>Stock: <b style="color:#ffc107!important">${product.stock} unidades</b></p>`
                        else
                            stock = `<p>Stock: <b style="color:#dc3545!important">${product.stock} unidades</b></p>`

                        let productColumn = `
                                            <div class="ps-product__column" id="product_${product.id}">
                                                <div class="ps-shoe mb-30">
                                                    <div class="ps-shoe__thumbnail">
                                                        ${badge}
                                                        ${outletBadge}
                                                        <a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
                                                        <img src="/storage/thumbnail/${product.thumbnail}">
                                                        <a class="ps-shoe__overlay" href="${url}"></a>
                                                    </div>
                                                    <div class="ps-shoe__content">
                                                        <div class="ps-shoe__variants">
                                                            ${stock}
                                                        </div>
                                                        <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">${product.type.type}
                                                        <p class="ps-shoe__categories">
                                                            <a href="${url}">Coleção: ${product.collection.collection}</a>
                                                            <br>
                                                            <a href="${url}">${colorsText}</a>
                                                        </p>
                                                        <span class="ps-shoe__price">${totalPrice}€</span>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                            `;

                        $('.ps-product__columns').append(productColumn);
                    }
                },
            });
        };

        $(".collection_filter").on("click", function() {
            $(".collection_filter").removeClass("current");
            $(this).addClass("current");

            getPriceRange();
        });

        $(".type_filter").on("click", function() {
            $(".type_filter").removeClass("current");
            $(this).addClass("current");

            getPriceRange();
        });

        $(".ac-slider__filter").on("click", function() {
            $(this).css("color", "white");
            getPriceRange();
        });

        function getPriceRange() {
            $("#searchInput").val("");
            let min = $(".ac-slider__min")[0].innerHTML;
            min = min.replace("€", "");
            let max = $(".ac-slider__max")[0].innerHTML;
            max = max.replace("€", "");

            let priceRange = min + "-" + max;
            let typeId = $(".type_filter.current").attr("id");
            let collectionId = $(".collection_filter.current").attr("id");

            productsFilter(collectionId, typeId, priceRange, outlet);
        };
        // -- Filters --

        // When change cart quantity, change all it's prices
        function changeCartQuantity(e, productIds) {
            e.preventDefault();

            let totalPrice = 0;
            let totalQuantity = 0;

            $.each(productIds, function(key, value) {
                // Variables treatment
                let result = value.split(' => ');
                let productId = result[0];
                productId = Number(productId);
                let productPrice = result[1];
                productPrice = Number(productPrice);

                // Remove red border
                $("#cartQuantity_" + productId).removeClass('form-validate-invalid');

                // Get product cart quantity
                let cartQuantity = $("#cartQuantity_" + productId).val();
                cartQuantity = Number(cartQuantity)
                totalQuantity += cartQuantity;

                totalPrice += (productPrice * cartQuantity );

                if (cartQuantity >= 1) {
                    $.ajax({
                        url: `/online-shop/cart/${productId}/${cartQuantity}`,
                        type: "PATCH",
                        data: { '_token': '{{ csrf_token() }}' },
                        dataType: "json",
                        success: function(response) {
                            let total = 0;

                            total = parseFloat(productPrice * cartQuantity).toFixed(2);

                            $(`#cartItemQuantity_${productId}`).text(cartQuantity);
                            $(`#cartItemTotal_${productId}`).text(total + "€");
                            $(`#productPriceTotal_${productId}`).text(total + "€");

                            // Update total values
                            totalPrice = parseFloat(totalPrice).toFixed(2);
                            $(`#productsTotal`).text(totalPrice + "€");
                            $(`#cartPriceTotal`).text(totalPrice + "€");

                            $("#itemsCount").text(totalQuantity);
                            $("#cartQuantityTotal").text(totalQuantity + " produto(s)");
                        },
                        error: function() {
                            $("#cartQuantity_" + productId).addClass('form-validate-invalid');
                        },
                    });
                }
                else {
                    $("#cartQuantity_" + productId).addClass('form-validate-invalid');
                }
            });

            $("#cartQuantityButton").attr('style', 'color: white !important');

            return false
        };

        // Change addresses numbers
        $("#deliveryBilling").on("click", function() {
            let checked = $("input[id='deliveryBilling']:checked").length;

            // if user wants addresses to be different checked will be > 0
            if (checked > 0) {
                $("#deliveryPlusBilling").addClass("hidden");
                $("#delivery").removeClass("hidden");
                $("#billing").removeClass("hidden");
            } else {
                $("#delivery").addClass("hidden");
                $("#billing").addClass("hidden");
                $("#deliveryPlusBilling").removeClass("hidden");
            }

            // Remove classes
            $(".selected-address").addClass("unselected-address");
            $(".selected-address").removeClass("selected-address");
            // Set values to null
            $("#delivery_id").val("");
            $("#billing_id").val("");
            // Hide necessary
            $('footer').addClass("hidden");
            $("#errorMessage").addClass("hidden");
        });

        // Select addresses
        function selectAddress(addressId, type) {
            if (type == "Billing") {
                $(".billing").addClass("unselected-address");
                $(".billing").removeClass("selected-address");

                $(`#billing_${addressId}`).addClass("selected-address");
                $("#billing_id").val(addressId);
            } else if (type == "Delivery") {
                $(".delivery").addClass("unselected-address");
                $(".delivery").removeClass("selected-address");

                $(`#delivery_${addressId}`).addClass("selected-address");
                $("#delivery_id").val(addressId);
            } else if (type == "Both") {
                $(".selected-address").addClass("unselected-address");
                $(".selected-address").removeClass("selected-address");

                $("#delivery_id").val(addressId);
                $("#billing_id").val(addressId);
                $(`#address_${addressId}`).addClass("selected-address");
            }

            $('footer').removeClass("hidden");
        }

        // Checks if all fields required are filled
        $("#check_radio").on("click", function(e) {
            let getRadioChecked = $('input[name="payment"]:checked');
            let checkInputDelivery = $("#delivery_id").val();
            let checkInputBilling = $("#billing_id").val();
            if (getRadioChecked.length != 1 || checkInputDelivery == "" || checkInputBilling == "") {
                e.preventDefault(e);
                $("#errorMessage").text(
                    "Selecione todas as informações pertinentes: 'Moradas de Envio', 'Morada de Faturação', 'Método de Envio' e 'Tipo de Pagamento'."
                    ).removeClass("hidden");
            }
        });

        // Change payment method
        function paymentMethod(method) {
            $("#payment_method").val(method);
        }

        // Product Search
        function productSearch() {
            let string = $("#searchInput").val();

            if (string == "") {
                string = "null"
            }

            $.ajax({
                url: `/online-shop/product-listing/${string}/${outlet}`,
                type: "GET",
                data: { '_token': '{{ csrf_token() }}' },
                dataType: "json",
                success: function(response) {
                    $('.ps-product__columns').empty();
                    let products = "";

                    for (let j = 0; j < response.length; j++) {
                        products = response[j].data ? response[j].data : response[j];

                        for (let i = 0; i < products.length; i++) {
                            let product = products[i];

                            let url = '{{ route('online-shop.product-detail', ':product') }}';
                            url = url.replace(':product', product.id);

                            let iva = (product.iva / 100) * (product.price);
                            let totalPrice = iva + product.price;
                            totalPrice = totalPrice.toFixed(2);

                            let colors = JSON.parse(product.color);
                            let colorsText = "Cores: ";

                            colors.forEach(color => {
                                colorsText = colorsText.concat(color + ", ");
                            });

                            // Slice two last characters
                            colorsText = colorsText.slice(0, -1)
                            colorsText = colorsText.slice(0, -1)

                            // Subtract created_at from now timestamp
                            let timePassedMs = Date.now() - Date.parse(product.created_at);

                            let badge = "";
                            if((timePassedMs / 1000) < 604800) {
                                badge = '<div class="ps-badge"><span>Novo</span></div>'
                            }

                            let outletBadge = "";
                            if(product.outlet == 1) {
                                outletBadge = '<div class="ps-badge ps-badge--sale ps-badge--2nd"><span>Outlet</span></div>'
                            }

                            let stock = "";
                            if(product.stock >= 100)
                                stock = `<p>Stock: <b class="text-success">${product.stock} unidades</b></p>`
                            else if(product.stock >= 30)
                                stock = `<p>Stock: <b style="color:#ffc107!important">${product.stock} unidades</b></p>`
                            else
                                stock = `<p>Stock: <b style="color:#dc3545!important">${product.stock} unidades</b></p>`

                            let productColumn = `
                                <div class="ps-product__column" id="product_${product.id}">
                                    <div class="ps-shoe mb-30">
                                        <div class="ps-shoe__thumbnail">
                                            ${badge}
                                            ${outletBadge}
                                            <a class="ps-shoe__favorite" href="#"><i class="ps-icon-heart"></i></a>
                                            <img src="/storage/thumbnail/${product.thumbnail}">
                                            <a class="ps-shoe__overlay" href="${url}"></a>
                                        </div>
                                        <div class="ps-shoe__content">
                                            <div class="ps-shoe__variants">
                                                ${stock}
                                            </div>
                                            <div class="ps-shoe__detail"><a class="ps-shoe__name" href="#">${product.type.type}
                                            <p class="ps-shoe__categories">
                                                <a href="${url}">Coleção: ${product.collection.collection}</a>
                                                <br>
                                                <a href="${url}">${colorsText}</a>
                                            </p>
                                            <span class="ps-shoe__price">${totalPrice}€</span>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            `;

                            $('.ps-product__columns').append(productColumn);
                        }
                    }
                },
                error: function(response) {
                    $('.ps-product__columns').empty();

                    let errorTag = "<p class='text-dark'><b>Não existem produtos conforme a sua pesquisa.</b></p>";
                    $('.ps-product__columns').append(errorTag)
                },
            });
        }

    </script>
</body>

</html>
