<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xnime ID - Anime streaming online</title>
    <meta name="description"
        content="Xnime, platform streaming anime gratis terbaru! Nikmati ribuan judul anime favoritmu tanpa iklan yang mengganggu. Dapatkan pengalaman menonton anime terbaik dengan kualitas video yang prima langsung melalui browser web. Jelajahi dunia anime yang seru dan menghibur dengan Xnime sekarang!">
    <meta name="content"
        content="streaming anime, anime gratis, anime terbaru, nonton anime, web anime, platform anime, tanpa iklan, cepat, kualitas video tinggi, film anime, film jepang, live action">
    <link rel="icon" href="{{ url('assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="{{ url('assets/css/reset.css') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link href="https://vjs.zencdn.net/8.6.1/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
    @yield('link')
</head>

<body>
    <div class="window-overlay">
        <div class="sidenav">
            <div class="sidenav__top">
                <span class="sidenav__logo">Xnime</span>
                <div class="sidenav__close-button">
                    <div class="close-button__line">
                        <div class="close-button__line"></div>
                    </div>
                </div>
            </div>
            <nav class="sidenav__nav">

                @guest
                <a href="{{ route('login') }}" class="nav-profile-mobile">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                        src="{{ url('assets/img/icons/profile.jpg') }}" class="profile-pic" />
                    <span>Tamu</span>
                </a>
                @endguest
                @auth
                <a href="{{ route('profile') }}" class="nav-profile-mobile">
                    <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                        src="{{ Auth::user()->picture ? url('profiles/'.Auth::user()->picture) : url('assets/img/icons/profile.jpg') }}"
                        class="profile-pic" />
                    <span>{{ Auth::user()->name }}</span>
                </a>
                @endauth
                <div class="sidenav__menu">
                    <ul class="sidenav-menu__list">
                        @guest
                        <li class="sidenav-menu__item">
                            <a href="{{ route('login') }}" class="sidenav-menu__link">Login</a>
                        </li>
                        @endguest
                        <li class="sidenav-menu__item">
                            <a href="{{ route('beranda') }}"
                                class="sidenav-menu__link {{ (request()->is('/')) ? 'text--active' : ''}}">Beranda</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="{{ route('anime') }}"
                                class="sidenav-menu__link {{( (request()->is('anime')) || (request()->is('anime-detail')) || (request()->is('episode/*'))) ? 'text--active' : ''}}">Anime</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="{{ route('schedule') }}"
                                class="sidenav-menu__link {{ (request()->is('schedule')) ? 'text--active' : ''}}">Jadwal
                                Rilis</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="{{ Auth::user() ? route('bookmark') : '#' }}"
                                onclick="{{ Auth::user() ? '' : 'need_login("'.route('login').'")' }}"
                                class="sidenav-menu__link {{ (request()->is('bookmark')) ? 'text--active' : ''}}">Bookmark</a>
                        </li>
                        @auth
                        <form id="logout-form" action="{{ route('logout_process') }}" method="post">@csrf</form>
                        <li class="sidenav-menu__item">
                            <a href="{{ route('profile') }}" class="sidenav-menu__link">Edit Profil</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="#logout" onclick="confirm_logout();" class="sidenav-menu__link">Logout</a>
                        </li>
                        @endauth
                    </ul>
                </div>
                <form action="{{ route('search') }}" class="sidenav__search">
                    <input type="text" name="q" class="sidenav-search__input" placeholder="Cari anime...">
                    <button class="sidenav-search__button">
                        <i class="fa-solid fa-magnifying-glass sidenav-search__icon"></i>
                    </button>
                </form>
            </nav>
        </div>
    </div>
    <header class="header">
        <div class="header__container">
            <div class="header__mobile-button">
                <span class="mobile-button__line"></span>
                <span class="mobile-button__line"></span>
                <span class="mobile-button__line"></span>
            </div>
            <a href="{{ route('beranda') }}" class="header__logo">Xnime</a>
            <nav class="header__nav">
                <div class="header__menu">
                    <ul class="header-menu__list">
                        <li class="header-menu__item">
                            <a href="{{ route('beranda') }}"
                                class="header-menu__link {{ (request()->is('/')) ? 'text--active' : ''}}">Beranda</a>
                        </li>
                        <li class="header-menu__item">
                            <a href="{{ route('anime') }}"
                                class="header-menu__link {{ ((request()->is('anime')) || (request()->is('anime-detail')) || (request()->is('episode/*'))) ? 'text--active' : ''}}">Anime</a>
                        </li>
                        <li class="header-menu__item">
                            <a href="{{ route('schedule') }}"
                                class="header-menu__link {{ (request()->is('schedule')) ? 'text--active' : ''}}">Jadwal
                                Rilis</a>
                        </li>
                        <li class="header-menu__item">
                            <a href="{{ Auth::user() ? route('bookmark') : '#' }}"
                                onclick="{{ Auth::user() ? '' : 'need_login("'.route('login').'")' }}"
                                class="header-menu__link {{ (request()->is('bookmark')) ? 'text--active' : ''}}">Bookmark</a>
                        </li>
                    </ul>
                </div>
                <form action="{{ route('search') }}" class="header__search">
                    <input type="text" name="q" class="header-search__input" placeholder="Cari anime...">
                    <button type="submit" class="header-search__button">
                        <i class="fa-solid fa-magnifying-glass sidenav-search__icon"></i>
                    </button>
                </form>
            </nav>
            <div class="nav-profile">
                @guest
                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                    src="{{ url('assets/img/icons/profile.jpg') }}" class="profile-pic" />
                <ul>
                    <li class="sub-item" onclick="window.location.href='{{ route('login') }}'">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <p>Login</p>
                    </li>
                </ul>
                @endguest
                @auth
                <img onerror="this.src = '{{ url('assets/img/logo/2.png') }}'"
                    src="{{ Auth::user()->picture ? url('profiles/'.Auth::user()->picture) : url('assets/img/icons/profile.jpg') }}"
                    class="profile-pic" />
                <ul>
                    <li class="sub-item" onclick="window.location.href='{{ route('profile') }}'">
                        <i class="fa-solid fa-gears"></i>
                        <p>Edit Profil</p>
                    </li>
                    <li class="sub-item" onclick="confirm_logout();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <p>Logout</p>
                    </li>
                </ul>
                @endauth
            </div>
        </div>
    </header>
    {{-- <div class="sticky-gap"></div> --}}
    <main class="main">
        @yield('breadcrumbs')
        @yield('content')
        <footer class="footer mt--20">
            <div class="footer__container">
                <div class="footer__top" style="display: none;">
                    <a href="./" class="footer__logo">Xnime</a>
                    <span class="footer__division"></span>
                    <div class="footer__socials">
                        <ul class="socials__list">
                            <li class="socials__item">
                                <a href="#" class="socials__link background--discord"><i
                                        class="fa-brands fa-discord"></i></a>
                            </li>
                            <li class="socials__item">
                                <a href="#" class="socials__link background--facebook"><i
                                        class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li class="socials__item">
                                <a href="#" class="socials__link background--twitter"><i
                                        class="fa-brands fa-twitter"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="footer__copy">
                    <p class="copy__text"><a href="./" class="copy__link">Xnime</a> © 2023 - Made by: <a
                            href="https://linktr.ee/MRHRTZ" class="copy__link" target="_blank">Hanif A S</a></p>
                </div>
            </div>
        </footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ url('assets/javascript/scripts.js') }}"></script>
    @yield('script')
</body>

</html>