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
    <div class="breadcrumbs">
        <p class="breadcrumbs__text"><a href="./" class="breadcrumbs__link">Home</a> <span class="breadcrumbs__arrow">»</span> Contato</p>
    </div>
    <main class="main">
        <section class="section contact">
           <h1 class="section__title">#CONTATO</h1>
           <div class="contact-box">
                <form action="./contact" class="contact-box__form">
                    <div class="form-control">
                        <label for="name" class="form-control__label">Nome:</label>
                        <input type="text" class="form-control__input">
                    </div>
                    <div class="form-control">
                        <label for="email" class="form-control__label">E-mail:</label>
                        <input type="text" class="form-control__input">
                    </div>
                    <div class="form-control">
                        <label for="email" class="form-control__label">Assunto:</label>
                        <input type="text" class="form-control__input">
                    </div>
                    <div class="form-control">
                        <label for="email" class="form-control__label">Mensagem:</label>
                        <textarea class="form-control__textarea"></textarea>
                    </div>
                    <button type="button" class="button">Enviar mensagem</button>
                    <div class="alert-message --danger">
                        <p>Mensagem de erro!</p>
                    </div>
                    <div class="alert-message --success">
                        <p>Mensagem de sucesso!</p>
                    </div>
                </form>
           </div>
        </section>
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