<!doctype html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
    <title>@yield('title', 'La murga')</title>
</head>

<body>
    <!-- header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('user.home.index') }}">
                <div class="logo-image">
                    <img class="img-fluid" src="{{ asset('/img/la_murga_logo.png') }}">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="dropdown">
                <button class="dropbtn">{{ __('messages.languages') }}</button>
                <div class="dropdown-content">
                    @foreach (config('app.available_locales') as $locale_name => $available_locale)
                        <a
                            href="{{ route('language.switch', ['locale' => $available_locale]) }}">{{ $locale_name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active" href="{{ route('user.liquor.index') }}">
                        {{ __('messages.home.store') }}
                    </a>
                    <a class="nav-link active" href="{{ route('user.wishlist.index') }}">
                        {{ __('messages.home.wishlist') }} </a>
                    <a class="nav-link active" href="{{ route('user.shoppingCart.index') }}">
                        {{ __('messages.home.shoppingCart') }} </a>
                    <a class="nav-link active" href="{{ route('user.teamApi.index') }}">
                        {{ __('messages.home.teamApi') }} </a>
                    <div class="vr bg-white mx-2 d-none d-lg-block"></div>
                    @if (Auth::user() and Auth::user()->getAdmin() === 1)
                        <a class="nav-link active" href="{{ route('admin.home.index') }}">
                            {{ __('messages.home.admin') }} </a>
                    @endif
                    @guest
                        <a class="nav-link active" href="{{ route('login') }}">{{ __('messages.auth.login') }}</a>
                        <a class="nav-link active"
                            href="{{ route('register') }}">{{ __('messages.auth.register') }}</a>
                    @else
                        <form id="logout" action="{{ route('logout') }}" method="POST">
                            <a role="button" class="nav-link active"
                                onclick="document.getElementById('logout').submit();">{{ __('messages.auth.logout') }}</a>
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>
    <!-- header -->
    <div class="container my-4">
        @yield('content')
    </div>
    <!-- footer -->
    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>
                {{ __('messages.home.copyright') }} <a class="text-reset fw-bold text-decoration-none"
                    target="_blank" href="https://twitter.com/danielgarax">
                    {{ __('messages.home.author') }}
                </a>
            </small>
        </div>
    </div>
    <!-- footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
</body>

</html>
