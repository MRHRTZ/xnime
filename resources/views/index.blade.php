<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>animesXP - Assistir animes online PT-BR!</title>
    <link rel="icon" href="./assets/img/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="window-overlay">
        <div class="sidenav">
            <div class="sidenav__top">
                <span class="sidenav__logo">animesXP</span>
                <div class="sidenav__close-button">
                    <div class="close-button__line">
                        <div class="close-button__line"></div>
                    </div>
                </div>
            </div>
            <nav class="sidenav__nav">
                <div class="sidenav__menu">
                    <ul class="sidenav-menu__list">
                        <li class="sidenav-menu__item">
                            <a href="./" class="sidenav-menu__link">Home</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="./anime-list" class="sidenav-menu__link">Animes</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="./anime-list" class="sidenav-menu__link">Cartoons</a>
                        </li>
                        <li class="sidenav-menu__item">
                            <a href="./contact" class="sidenav-menu__link">Contato</a>
                        </li>
                    </ul>
                </div>
                <form action="./search-result" class="sidenav__search">
                    <input type="text" class="sidenav-search__input" placeholder="Pesquisar...">
                    <button class="sidenav-search__button">
                        <ion-icon name="search" class="sidenav-search__icon"></ion-icon>
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
            <a href="./" class="header__logo">animesXP</a>
            <nav class="header__nav">
                <div class="header__menu">
                    <ul class="header-menu__list">
                        <li class="header-menu__item">
                            <a href="./" class="header-menu__link">Home</a>
                        </li>
                        <li class="header-menu__item">
                            <a href="./anime-list" class="header-menu__link">Animes</a>
                        </li>
                        <li class="header-menu__item">
                            <a href="./anime-list" class="header-menu__link">Cartoons</a>
                        </li>
                        <li class="header-menu__item">
                            <a href="./contact" class="header-menu__link">Contato</a>
                        </li>
                    </ul>
                </div>
                <form action="./search-result" class="header__search">
                    <input type="text" class="header-search__input" placeholder="Pesquisar...">
                    <button type="submit" class="header-search__button">
                        <ion-icon name="search" class="header-search__icon"></ion-icon>
                    </button>
                </form>
            </nav>
        </div>
    </header>
    <main class="main">
        <section class="section featured">
            <h1 class="section__title">#DESTAQUES</h1>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/overlord.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Overlord</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/kingdom.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Kingdom</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/hyperdimension-neptunia.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Hyperdimension Neptunia</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/naruto-shippuden.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Naruto Shippuden</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/black-clover.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Black Clover</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/boku-no-hero-academia.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Boku No Hero Academia</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/kimetsu-no-yaiba.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Kimetsu No Yaiba</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/bleach.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Bleach</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/one-piece.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">One Piece</a>
                    </div>
                    <div class="swiper-slide">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/tower-of-god.jpg" class="swiper-slide__cover">
                        </a>
                        <a href="./single-anime" class="swiper-slide__title">Tower Of God</a>
                    </div>
                </div>
            </div>
        </section>
        <div class="wrapper">
            <section class="section cards">
                <h1 class="section__title">#NOVOS EPISÓDIOS</h1>
                <div class="cards__container">
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/boku-no-hero.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Boku No Hero</a>
                            <p class="episode-card__description">Episódio 02 - há 5 minutos</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/tower-of-god.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Tower Of God</a>
                            <p class="episode-card__description">Episódio 08 - há 15 minutos</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/nanatsu-no-taizai.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">LEG</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Nanatsu No Taizai</a>
                            <p class="episode-card__description">Episódio 19 - ontem</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/overlord.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Overlord</a>
                            <p class="episode-card__description">Episódio 27 - ontem</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/boku-no-hero.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Boku No Hero</a>
                            <p class="episode-card__description">Episódio 02 - há 5 minutos</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/tower-of-god.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Tower Of God</a>
                            <p class="episode-card__description">Episódio 08 - há 15 minutos</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/nanatsu-no-taizai.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">LEG</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Nanatsu No Taizai</a>
                            <p class="episode-card__description">Episódio 19 - ontem</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/overlord.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Overlord</a>
                            <p class="episode-card__description">Episódio 27 - ontem</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/boku-no-hero.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Boku No Hero</a>
                            <p class="episode-card__description">Episódio 02 - há 5 minutos</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/tower-of-god.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Tower Of God</a>
                            <p class="episode-card__description">Episódio 08 - há 15 minutos</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/nanatsu-no-taizai.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">LEG</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Nanatsu No Taizai</a>
                            <p class="episode-card__description">Episódio 19 - ontem</p>
                        </div>
                    </div>
                    <div class="episode-card">
                        <div class="episode-card__thumbnail-box">
                            <a href="./episode"><img src="./assets/img/thumbnails/overlord.jpg" class="episode-card__thumbnail-img"></a>
                            <a href="./episode" class="play__circle"><ion-icon name="play-circle" class="play__icon"></ion-icon></a>
                            <span class="episode-card__language-box">DUB</span>
                        </div>
                        <div class="episode-card__info">
                            <a href="./episode" class="episode-card__title">Overlord</a>
                            <p class="episode-card__description">Episódio 27 - ontem</p>
                        </div>
                    </div>
                </div>
            </section>
            <aside class="aside">
                <h1 class="aside__title">#GÊNEROS</h1>
                <div class="aside__box">
                    <ul class="genres-box__list">
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Ação</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Artes Marciais</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Aventura</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Comédia</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Demônios</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Drama</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Ecchi</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Espaço</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Esporte</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Fantasia</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Harém</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Horror</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Jogos</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Josei</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Magia</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Mecha</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Mistério</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Militar</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Musical</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Paródia</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Psicológico</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Romance</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Sci-Fi</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Seinen</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Shoujo</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Shoujo-Ai</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Shounen</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Shounen-Ai</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Slice Of Life</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Sobrenatural</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Suspense</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Superpoder</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Vampiros</a>
                        </li>
                        <li class="genres-box__item">
                            <a href="./anime-list" class="genres-box__link">Vida Escolar</a>
                        </li>
                    </ul>
                    <button type="button" class="button load-more">Mostrar mais</button>
                </div>
            </aside>
        </div>
    </main>
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__top">
                <a href="./" class="footer__logo">animesXP</a>
                <span class="footer__division"></span>
                <div class="footer__socials">
                    <ul class="socials__list">
                        <li class="socials__item">
                            <a href="#" class="socials__link background--discord"><i class="fa-brands fa-discord"></i></a>
                        </li>
                        <li class="socials__item">
                            <a href="#" class="socials__link background--facebook"><i class="fa-brands fa-facebook-f"></i></a>
                        </li>
                        <li class="socials__item">
                            <a href="#" class="socials__link background--twitter"><i class="fa-brands fa-twitter"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer__copy">
                <p class="copy__text"><a href="./" class="copy__link">AnimesXP</a> © 2022 - Made by: <a href="https://linktr.ee/eubrunocoelho" class="copy__link" target="_blank">Bruno Coelho</a></p>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="./assets/javascript/swiper.js"></script>
    <script src="./assets/javascript/scripts.js"></script>
</body>
</html>