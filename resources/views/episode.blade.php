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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.7.8/plyr.css" />
    <link rel="stylesheet" href="./assets/css/styles.css">
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
    <div class="breadcrumbs">
        <p class="breadcrumbs__text"><a href="./" class="breadcrumbs__link">Home</a> <span
                class="breadcrumbs__arrow">»</span> <a href="./" class="breadcrumbs__link">Animes</a> <span
                class="breadcrumbs__arrow">»</span> <a href="./" class="breadcrumbs__link">Tower Of God</a> <span
                class="breadcrumbs__arrow">»</span> Episódio 2</p>
    </div>
    <main class="main">
        <div class="wrapper mt--none">
            <section class="section episode">
                {{-- <div class="episode-box">
                    <div class="episode-box__heading">
                        <h1 class="episode-box__title">Tower Of God - Episódio 2</h1>
                    </div>
                    <div class="episode-box__player">
                        <span class="episode-box__player-button">
                            <ion-icon name="arrow-dropright-circle" class="episode-box__player-button"></ion-icon>
                        </span>
                    </div>
                    <div class="episode-box__guide">
                        <a href="#" class="episode-box__button">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        <a href="#" class="episode-box__button">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div> --}}
                <video id="player" autoplay="true" playsinline controls></video>
                <div class="anime-info">
                    <div class="anime-info__cover">
                        <a href="./single-anime">
                            <img src="./assets/img/covers/tower-of-god.jpg" class="anime-info__img">
                        </a>
                    </div>
                    <div class="anime-info__summary">
                        <a href="./single-anime" class="anime-info__title">Tower Of God</a>
                        <p class="anime-info__synopsis">Há uma torre que convoca pessoas escolhidas chamadas "Regulares"
                            com a promessa de realizar seus desejos mais profundos. Seja riqueza, fama, autoridade ou
                            algo que os supere - tudo aguarda aqueles que chegam ao topo. Vigésimo Quinto Bam é um
                            menino que conheceu apenas uma caverna escura, um pano sujo e uma luz inalcançável durante
                            toda a sua vida. Então, quando uma garota chamada Rachel veio até ele através da luz, seu
                            mundo inteiro mudou. Tornando-se amigo íntimo de Rachel, ele aprendeu várias coisas sobre o
                            mundo exterior com ela. Mas quando Rachel diz que deve deixá-lo para escalar a Torre, seu
                            mundo se estilhaça ao seu redor. Prometendo segui-la não importa o que aconteça, ele fixa
                            sua visão na torre, e um milagre ocorre. Assim começa a jornada de Bam, um jovem que não foi
                            escolhido pela Torre, mas abriu seus portões sozinho. Eles chamam sua espécie de
                            "Irregulares" - seres que abalaram a própria fundação da Torre cada vez que colocam os pés
                            dentro dela.</p>
                    </div>
                </div>
                <h1 class="section__title mt--40">#COMENTÁRIOS</h1>
                <div class="comments-box">
                    <div class="comments-box__content">
                        <p class="comments-box__p">#pluginComments</p>
                    </div>
                </div>
            </section>
            <aside class="aside popular">
                <h1 class="aside__title">#POPULARES</h1>
                <div class="aside__box">
                    <div class="popular-item">
                        <span class="popular-item__rank">#01</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/tower-of-god.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">Tower Of God</a>
                            <span class="popular-item__description">12 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#02</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/bleach.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">Bleach</a>
                            <span class="popular-item__description">366 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#03</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/one-piece.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">One Piece</a>
                            <span class="popular-item__description">1050 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#04</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/naruto-shippuden.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">Naruto Shippuden</a>
                            <span class="popular-item__description">700 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#05</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/tower-of-god.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">Tower Of God</a>
                            <span class="popular-item__description">12 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#06</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/bleach.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">Bleach</a>
                            <span class="popular-item__description">366 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#07</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/one-piece.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">One Piece</a>
                            <span class="popular-item__description">1050 eps.</span>
                        </div>
                    </div>
                    <div class="popular-item">
                        <span class="popular-item__rank">#08</span>
                        <div class="popular-item__cover">
                            <a href="./single-anime">
                                <img src="./assets/img/covers/naruto-shippuden.jpg" class="popular-item__img">
                            </a>
                        </div>
                        <div class="popular-item__info">
                            <a href="./single-anime" class="popular-item__title">Naruto Shippuden</a>
                            <span class="popular-item__description">700 eps.</span>
                        </div>
                    </div>
                </div>
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
                <p class="copy__text"><a href="./" class="copy__link">AnimesXP</a> © 2022 - Made by: <a
                        href="https://linktr.ee/eubrunocoelho" class="copy__link" target="_blank">Bruno Coelho</a></p>
            </div>
        </div>
    </footer>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="./assets/javascript/swiper.js"></script>
    <script src="./assets/javascript/scripts.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.plyr.io/3.7.8/plyr.js"></script>
    <script>
        let sources = {
        type: 'video',
        title: 'Example title',
        sources: [
            {
                src: 'https://blogdata.vuplayer.my.id/dl.php?data=K051U1VLdWFvMEJ1U1JYK1dQZ0kvZGNCR1VmY3Q4UE10SWpqZmNWdGlUL2RCbStsN3pmNW8zdkczZVRqeXV1NVZacUo0ZHZDRXhjazFMNDNTczFmWXg1bHZZMzlmSVk5STVTVTBtOVlrT2RnRkJSSEgxQ0tyMUdINjJxcENTeWlySndIdVFMYUgxVi9OS3poQlZqTmU2bHFVaTg3bFFreGlUYkR0Q1Vtc2Q2L1NldzgyZkFhOFd5dEdra3BaOEZ0',
                type: 'video/mp4',
                size: 480,
            },
            {
                src: 'https://blogdata.vuplayer.my.id/dl.php?data=K051U1VLdWFvMEJ1U1JYK1dQZ0kvZGNCR1VmY3Q4UE10SWpqZmNWdGlUL2RCbStsN3pmNW8zdkczZVRqeXV1NVZacUo0ZHZDRXhjazFMNDNTczFmWXg1bHZZMzlmSVk5STVTVTBtOVlrT2RnRkJSSEgxQ0tyMUdINjJxcENTeWlhUThmZGp1VXRFWnJMU1dsSk9CdUpRd0tWTlRWcTQ0Y3loZngzV3FFN1E0YXdpYUg5d0M2TVlQUlFYamlXYWhE',
                type: 'video/mp4',
                size: 720,
            },
        ],
        poster: 'https://api.vunime.my.id/assets/images/posts/videos/4066_video_kage-no-jitsuryokusha-ni-naritakute-s2.jpg',
    }
    </script>
    <script>
        var isStarted = false;

    const player = new Plyr('#player');
    window.player = player;
    player.source = sources

    player.on('timeupdate', (event) => {
    // const instance = event.detail.plyr;
        // console.log(event)
    });
    player.on('timeupdate', (event) => {
        // console.log(event);
        // const instance = event.detail.plyr;
        // setTimeout(() => {
            let currTime = event.timeStamp
            if (currTime > 1000) {
                if (!isStarted) {
                    isStarted = true;
                    player.currentTime = 120
                }
            } 
        // }, 1000);
    // const instance = event.detail.plyr;
        // console.log(event)
    });
    
    </script>
</body>

</html>