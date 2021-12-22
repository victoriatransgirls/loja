<!DOCTYPE html>
<html lang="{{ config('app.lang') }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={{ config('app.charset') }}" />
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta property="og:url" content="@yield('url')" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ config('app.name') }} | @yield('title')" />
    <meta property="og:description" content="@yield('description')" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:alt" content="{{ config('app.name') }} | @yield('title')" />
    <meta property="og:image:width" content="@yield('image_width')" /> 
    <meta property="og:image:height" content="@yield('image_height')" /> 
    <meta property="og:site_name" content="{{ config('app.name') }}" /> 
    <meta property="og:locale" content="{{ config('app.lang') }}" />
    {{-- <meta property="og:app_id" content="" /> --}}
    {{-- <meta property="fb:pages" content="" /> --}}
    
    <meta property="article:author" content="{{ config('app.social.facebook') }}" /> 
    <meta property="article:publisher" content="{{ config('app.social.facebook') }}" /> 
    <meta property="twitter:card" content="summary_large_image" /> 
    <meta property="twitter:domain" content="{{ config('app.domain') }}" /> 
    <meta property="twitter:title" content="{{ config('app.name') }} | @yield('title')" /> 
    <meta property="twitter:description" content="@yield('description')" /> 
    <meta property="twitter:image" content="@yield('image')" /> 
    <meta property="twitter:url" content="@yield('url')" />
    <meta name="twitter:card" content="summary" />
    {{-- <meta name="twitter:site" content="@news" /> --}}
    {{-- <meta name="twitter:creator" content="@news" /> --}}

    <!-- Title -->
    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ public_path('assets/img/logo.png') }}">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('assets/css/libs/bootstrap.min.css') }}"/>

    <!-- Slick -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('assets/css/libs/slick.css') }}"/>
    <link type="text/css" rel="stylesheet" href="{{ public_path('assets/css/libs/slick-theme.css') }}"/>

    <!-- nouislider -->
    <link type="text/css" rel="stylesheet" href="{{ public_path('assets/css/libs/nouislider.min.css') }}"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="{{ public_path('assets/css/libs/font-awesome.min.css') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ public_path('assets/css/site/style.css') }}">
    @yield('styles')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- TOP HEADER -->
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="callto:{{ config('app.contact.phone') }}" title="Entrar em Contato por Telefone"><i class="fa fa-phone"></i> {{ mask(config('app.contact.phone'), '(##)####-####') }}</a></li>
                    <li><a href="mailto:{{ config('app.contact.email') }}" title="Entrar em Contato por E-Mail"><i class="fa fa-envelope-o"></i> {{ config('app.contact.email') }}</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
                    <li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
                </ul>
            </div>
        </div>
        <!-- /TOP HEADER -->

        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="{{ url() }}" class="logo" title="{{ config('app.name') }}">
                                <img src="{{ public_path('assets/img/logo.png') }}" alt="{{ config('app.name') }}" title="{{ config('app.name') }}">
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-6">
                        <div class="header-search">
                            <form action="" method="POST">
                                <select class="input-select">
                                    <option value="0">Todos</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="input" placeholder="Buscar" name="search">
                                <button class="search-btn">Buscar</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-3 clearfix">
                        <div class="header-ctn">
                            <!-- Wishlist -->
                            <div>
                                <a href="#">
                                    <i class="fa fa-heart-o"></i>
                                    <span>Your Wishlist</span>
                                    <div class="qty">2</div>
                                </a>
                            </div>
                            <!-- /Wishlist -->

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <div class="qty">3</div>
                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ public_path('assets/img/site/product01.png') }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>

                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="{{ public_path('assets/img/site/product02.png') }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name"><a href="#">product name goes here</a></h3>
                                                <h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
                                            </div>
                                            <button class="delete"><i class="fa fa-close"></i></button>
                                        </div>
                                    </div>
                                    <div class="cart-summary">
                                        <small>3 Item(s) selected</small>
                                        <h5>SUBTOTAL: $2940.00</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">View Cart</a>
                                        <a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <!-- Menu Toogle -->
                            <div class="menu-toggle">
                                <a href="#">
                                    <i class="fa fa-bars"></i>
                                    <span>Menu</span>
                                </a>
                            </div>
                            <!-- /Menu Toogle -->
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->

    <!-- NAVIGATION -->
    <nav id="navigation">
        <!-- container -->
        <div class="container">
            <!-- responsive-nav -->
            <div id="responsive-nav">
                <!-- NAV -->
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="{{ route('site') }}" title="Página Inicial">Início</a></li>
                    <li><a href="{{ route('site.products') }}" title="Página de Produtos">Produtos</a></li>
                    <li><a href="{{ route('site.notices') }}" title="Página do Blog">Blog</a></li>
                    <li><a href="{{ route('site.create') }}" title="Página de Login">Login</a></li>
                    <li><a href="{{ route('site.create') }}" title="Página paraCriar sua Conta">Criar Conta</a></li>
                    <li><a href="{{ route('site') }}" title="Página da Sua Conta">Minha Conta</a></li>
                </ul>
                <!-- /NAV -->
            </div>
            <!-- /responsive-nav -->
        </div>
        <!-- /container -->
    </nav>
    <!-- /NAVIGATION -->

    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        @empty(route())
                        <li class="active">inicio</li>
                        @else
                        <li><a href="{{ url() }}">inicio</a></li>
                        @php $routeComplete = '' @endphp
                        @foreach(explode('/', route()) as $route)
                            @php $routeComplete .= $route . '/' @endphp

                            @if(!$loop->last)
                            <li><a href="{{ url($routeComplete) }}">{{ $route }}</a></li>
                            @else
                            @php $routeComplete = $route @endphp
                            @endif
                        @endforeach
                        <li class="active">{{ trim($routeComplete, '/') }}</li>
                        @endempty
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- row -->
        <div class="row">
            @yield('container')
        </div>
        <!-- /row -->
    </div>
    <!-- /SECTION -->

    <!-- FOOTER -->
    <footer id="footer">
        <!-- top footer -->
        <div class="section">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">About Us</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
                            <ul class="footer-links">
                                <li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
                                <li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
                                <li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Categories</h3>
                            <ul class="footer-links">
                                <li><a href="#">Hot deals</a></li>
                                <li><a href="#">Laptops</a></li>
                                <li><a href="#">Smartphones</a></li>
                                <li><a href="#">Cameras</a></li>
                                <li><a href="#">Accessories</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="clearfix visible-xs"></div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Information</h3>
                            <ul class="footer-links">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Orders and Returns</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-3 col-xs-6">
                        <div class="footer">
                            <h3 class="footer-title">Service</h3>
                            <ul class="footer-links">
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">View Cart</a></li>
                                <li><a href="#">Wishlist</a></li>
                                <li><a href="#">Track My Order</a></li>
                                <li><a href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /top footer -->

        <!-- bottom footer -->
        <div id="bottom-footer" class="section">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <ul class="footer-payments">
                            <li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
                            <li><a href="#"><i class="fa fa-credit-card"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
                            <li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
                        </ul>
                        <span class="copyright">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>
                    <!-- /row -->
            </div>
            <!-- /container -->
        </div>
        <!-- /bottom footer -->
    </footer>
    <!-- /FOOTER -->

    <!-- ##### All Javascript Script ##### -->
    <script type="text/javascript" src="{{ public_path('assets/js/libs/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_path('assets/js/libs/jquery/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_path('assets/js/libs/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_path('assets/js/libs/plugins/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_path('assets/js/libs/plugins/nouislider.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_path('assets/js/libs/plugins/jquery.zoom.min.js') }}"></script>
    <script type="text/javascript" src="{{ public_path('assets/js/site/main.js') }}"></script>
    @yield('scripts')
</body>
</html>