<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <title>Document</title>
</head>
<body>

<div class="preload">
    <div class="loader">
        <div class="inner"></div>
        <div class="outer"></div>
    </div>
</div>
@include('partials.ajax.error')
<header class="header">
    <div class="container">
        <div class="header-wrap">
            <a href="{{ route('main') }}" class="logo">
                <img src="{{ asset('/images/autokit.png') }}" alt="logo">
            </a>
            <div>
                <div class="form-group form-group-sm">
                    <select name="currency" id="selectCurrency" class="form-control">
                        @foreach($currencies as $currency => $currencyData)
                            <option value="{{ route('currency.change', ['currency' => strtolower($currency)]) }}"
                            @if(request()->cookie('currency') === $currency) selected @endif
                            >
                                {{ $currency }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <a href="{{ route('cart') }}" class="nav-cart">
                    <i class="fa fa-shopping-cart"></i>
                    @lang('page.my_cart')
                    <span class="cart-count" id="cartCount">{{ $cart->totalQuantity() }}</span>
                </a>
            </div>
        </div>
    </div>
</header>

@include('partials.nav')

<div class="main-content">
    @yield('content')
</div>

<footer>
    <a href="{{ route('main') }}" class="logo">
        <img src="{{ asset('/images/autokit.png') }}" alt="logo">
    </a>
    <h3 class="copyright color-black">
        @lang('page.copyright') {{ date('Y') }}
    </h3>
</footer>
<div class="go-top" title="@lang('page.go_top')"><i class="fa fa-arrow-up"></i></div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>