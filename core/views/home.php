<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main">
    <nav class="navbar navbar-standard navbar-expand-lg fixed-top navbar-dark"
         data-navbar-darken-on-scroll="data-navbar-darken-on-scroll">
        <div class="container">
            <a class="navbar-brand" href=""><span class="text-white dark__text-white">OPG</span></a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarStandard" aria-controls="navbarStandard" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item d-flex align-items-center me-2">
                        <div class="nav-link theme-switch-toggle fa-icon-wait p-0">
                            <input class="form-check-input ms-0 theme-switch-toggle-input" id="themeControlToggle"
                                   type="checkbox" data-theme-control="theme" value="dark">
                            <label class="mb-0 theme-switch-toggle-label theme-switch-toggle-light"
                                   for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                   title="Alternar para o tema claro">
                                <span class="fas fa-sun"></span>
                            </label>
                            <label class="mb-0 py-2 theme-switch-toggle-light d-lg-none" for="themeControlToggle">
                                <span>Alternar para o tema claro</span>
                            </label>
                            <label class="mb-0 theme-switch-toggle-label theme-switch-toggle-dark"
                                   for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                   title="Alternar para o tema escuro">
                                <span class="fas fa-moon"></span>
                            </label>
                            <label class="mb-0 py-2 theme-switch-toggle-dark d-lg-none" for="themeControlToggle">
                                <span>Alternar para o tema escuro</span>
                            </label>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Cadastro</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="row text-start justify-content-between align-items-center mb-2">
                        <div class="col-auto">
                            <h5 id="modalLabel">Efetuar o login</h5>
                        </div>
                    </div>
                    <form id="loginForm">
                        <div class="mb-3">
                            <input class="form-control" type="email" name="email-login" id="email-login"
                                   placeholder="Digite o e-mail" required/>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="password" name="password-login" id="password-login"
                                   placeholder="Digite a senha" required/>
                        </div>
                        <div class="row flex-between-center">
                            <div class="col-auto">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" id="modal-checkbox"/>
                                    <label class="form-check-label mb-0" for="modal-checkbox">Salvar dados</label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <a class="fs--1" href="#">Recuperar senha?</a>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit" id="login-button">Conectar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="row text-start justify-content-between align-items-center mb-2">
                        <div class="col-auto">
                            <h5 id="modalLabel">Efetue o cadastro</h5>
                        </div>
                    </div>
                    <form id="registerForm">
                        <div class="mb-3">
                            <input class="form-control" type="text" autocomplete="on" name="name-register"
                                   id="name-register" placeholder="Nome" required/>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" type="email" autocomplete="on" name="email-register"
                                   id="email-register" placeholder="E-mail" required/>
                        </div>
                        <div class="row gx-2">
                            <div class="mb-3 col-sm-6">
                                <label>
                                    <input class="form-control" type="password" autocomplete="on"
                                           name="password-register" id="password-register" placeholder="Senha"
                                           required/>
                                </label>
                            </div>
                            <div class="mb-3 col-sm-6">
                                <label>
                                    <input class="form-control" type="password" autocomplete="on"
                                           name="confirm-password-register" id="confirm-password-register"
                                           placeholder="Confirme a senha" required/>
                                </label>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="modal-register-checkbox" required/>
                            <label class="form-label" for="modal-register-checkbox">
                                Eu aceito os <a href="#">termos de serviço </a>e <a href="#">política de privacidade</a>
                            </label>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit"
                                    id="register-button">
                                Registrar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================-->
    <!-- <section> banner ===========================-->
    <section class="py-0 overflow-hidden light" id="banner">
        <div class="bg-holder overlay home-bg">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row flex-center pt-8 pt-md-10 pb-md-9 pb-xl-0">
                <div class="col-md-11 col-lg-8 col-xl-4 pb-7 pb-xl-9 text-center text-xl-start">
                    <a class="btn btn-outline-danger mb-4 fs--1 border-2 rounded-pill" href="#" data-bs-toggle="modal"
                       data-bs-target="#registerModal">
                        <span class="me-2 fas fa-user-plus"></span>Cadastre-se
                    </a>
                    <h1 class="text-white fw-light">Cadastre-se e<br/>
                        <span class="typed-text fw-bold"
                              data-typed-text='["aventure-se","relembre-se","ganhe itens","torne o melhor"]'></span>
                    </h1>
                    <p class="lead text-white opacity-75"><?= APP_NAME ?> é um dos mais populares "browser games" de One
                        Piece. Crie personagens, faça missões, dispute o ranking e muito outros.</p>
                    <a class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2" href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#registerModal">
                        Cadastre-se para o Beta
                        <span class="fas fa-play ms-2" data-fa-transform="shrink-6 down-1"></span></a>
                </div>
                <div class="col-xl-7 offset-xl-1 align-self-end mt-4 mt-xl-0">
                    <div class="img-landing-banner rounded">
                        <img class="img-fluid" src="../../public/assets/img/layout/register_bg.png" alt=""/>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> img slider =======================-->
    <section class="py-3 bg-light shadow-sm">
        <div class="container">
            <div class="row flex-center">
                <?php for ($i = 1; $i <= 7; $i++) : ?>
                    <div class="col-3 col-sm-auto my-1 my-sm-3 px-card">
                        <img class="landing-cta-img" height="40"
                             src="../../public/assets/img/layout/slide_bg_<?= $i ?>.png"
                             alt=""/>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> remember =========================-->
    <section>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <h1 class="fs-2 fs-sm-4 fs-md-5">Relembre-se dos antigos RPG em browser</h1>
                    <p class="lead">Com a volta de <?= APP_NAME ?> você poderá ter uma nostalgia dos antigos RPG de
                        navegadores, além disso contará com novidades e atualizações dedicadas!</p>
                </div>
            </div>
            <div class="row flex-center mt-8">
                <div class="col-md col-lg-5 col-xl-4 ps-lg-6">
                    <img class="img-fluid px-6 px-md-0" src="../../public/assets/img/layout/section_bg_1.png" alt=""/>
                </div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-danger"><span class="ra ra-muscle-up me-2"></span>Personagens legais</h5>
                    <h3>Personagens do anime One Piece</h3>
                    <p>Já pensou em ter sua tripulação como deseja? Essa é a hora de você conhecer o Luffy.</p>
                </div>
            </div>
            <div class="row flex-center mt-7">
                <div class="col-md col-lg-5 col-xl-4 pe-lg-6 order-md-2">
                    <img class="img-fluid px-6 px-md-0" src="../../public/assets/img/layout/section_bg_2.png" alt=""/>
                </div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-info"><span class="ra ra-sword me-2"></span>Batalhas épicas</h5>
                    <h3>Zoro e seus amigos o espera!</h3>
                    <p>Recrute personagens a sua tripulação e batalhe no modo história ou contra outros jogadores!</p>
                </div>
            </div>
            <div class="row flex-center mt-7">
                <div class="col-md col-lg-5 col-xl-4 ps-lg-6">
                    <img class="img-fluid px-6 px-md-0" src="../../public/assets/img/layout/section_bg_3.png" alt=""/>
                </div>
                <div class="col-md col-lg-5 col-xl-4 mt-4 mt-md-0">
                    <h5 class="text-warning"><span class="ra ra-gold-bar me-2"></span>Ganhe Berry</h5>
                    <h3>Dinheiro e muito mais!</h3>
                    <p>Não se preocupe que a Nami vai lhe ajudar com sua expertise e garantir seu bolso cheio!</p>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> random players ===================-->
    <section class="bg-200 text-center random-players-bg">
        <div class="container random-players">
            <div class="row">
                <div class="col">
                    <h1 class="fs-2 fs-sm-4 fs-md-5">Jogadores que estão se aventurando agora!</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9 col-xl-8">
                    <div class="swiper-container theme-slider"
                         data-swiper='{"autoplay":true,"spaceBetween":5,"loop":true,"loopedSlides":5,"slideToClickedSlide":true}'>
                        <div class="swiper-wrapper">
                            <?php for ($i = 1; $i <= 3; $i++) : ?>
                                <div class="swiper-slide">
                                    <div class="px-5 px-sm-6">
                                        <p class="fs-sm-1 fs-md-2 fst-italic text-dark">Charles<?= $i ?></p>
                                        <p class="fs-0 text-600">Luffy - Nível 1</p>
                                        <img class="w-auto mx-auto"
                                             src="../../public/assets/img/characters/landscape/<?= $i ?>.png" alt=""
                                             height="250"/>
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        <div class="swiper-nav">
                            <div class="swiper-button-next swiper-button-white"></div>
                            <div class="swiper-button-prev swiper-button-white"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> news =============================-->
    <section class="bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1 class="fs-2 fs-sm-4 fs-md-5">Últimas Notícias</h1>
                    <p class="lead">Para ver detalhadamente as notícias, faça login na plataforma.</p>
                </div>
            </div>
            <div class="row mt-6">
                <?php for ($i = 1; $i <= 3; $i++) : ?>
                    <div class="col-lg-4 mt-6 mt-lg-0">
                        <div class="card card-span h-100">
                            <div class="card-span-img"><span class="fas fa-newspaper fs-5 text-success"></span></div>
                            <div class="card-body pt-6 pb-4">
                                <h5 class="mb-2">Título da notícia</h5>
                                <p>Diminuir o detalhe da notícia em 200 caracteres e colocar 3 pontinhos...</p>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> registered users =================-->
    <section class="light">
        <div class="bg-holder overlay home-bg-2">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <p class="fs-3 fs-sm-4 text-white">Neste momento temos <strong>155</strong> usuários registrado na
                        plataforma!</p>
                    <button class="btn btn-outline-light border-2 rounded-pill btn-lg mt-4 fs-0 py-2" type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#registerModal">
                        Cadastre-se agora!
                    </button>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> footer one =======================-->
    <section class="bg-dark pt-8 pb-4 light">
        <div class="container">
            <div class="position-absolute btn-back-to-top bg-dark">
                <a class="text-600" href="#banner" data-bs-offset-top="0" data-scroll-to="#banner">
                    <span class="fas fa-chevron-up" data-fa-transform="rotate-45"></span>
                </a>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <h5 class="text-uppercase text-white opacity-85 mb-3"><?= APP_NAME . '(' . APP_VERSION . ') &copy; ' . date('Y') ?></h5>
                    <p class="text-600">Todos os direitos de imagens e nome do Anime One Piece reservado para Eiichiro
                        Oda, Bandai &copy; 1999 - <?= date('Y') ?></p>
                    <div class="icon-group mt-4">
                        <a class="icon-item bg-white text-github" href="#">
                            <span class="fab fa-github"></span>
                        </a>
                        <a class="icon-item bg-white" href="#">
                            <span class="fab fa-medium-m"></span>
                        </a>
                    </div>
                </div>
                <div class="col ps-lg-6 ps-xl-8">
                    <div class="row mt-5 mt-lg-0">
                        <div class="col-6 col-md-3">
                            <h5 class="text-uppercase text-white opacity-85 mb-3">Geral</h5>
                            <ul class="list-unstyled">
                                <li class="mb-1"><a class="link-600" href="#">Termos de Uso</a></li>
                                <li class="mb-1"><a class="link-600" href="#">Regras</a></li>
                                <li class="mb-1"><a class="link-600" href="#">Política de Privacidade</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-3">
                            <h5 class="text-uppercase text-white opacity-85 mb-3">Contato</h5>
                            <ul class="list-unstyled">
                                <li class="mb-1"><a class="link-600" href="#">Suporte</a></li>
                            </ul>
                        </div>
                        <div class="col mt-5 mt-md-0">
                            <h5 class="text-uppercase text-white opacity-85 mb-3">Home</h5>
                            <ul class="list-unstyled">
                                <li class="mb-1">
                                    <a class="link-600" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                                </li>
                                <li class="mb-1">
                                    <a class="link-600" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Cadastro</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
    <!-- ============================================-->
    <!-- <section> footer two =======================-->
    <section class="py-0 bg-dark light">
        <div>
            <hr class="my-0 text-600 opacity-25"/>
            <div class="container py-3">
                <div class="row justify-content-between fs--1">
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600 opacity-85">Obrigado por jogar <?= APP_NAME ?>
                            <span class="d-none d-sm-inline-block">| </span>
                            <br class="d-sm-none"/> <?= date('Y') ?>&copy;
                            <a class="text-white opacity-85" href="#"><?= APP_AUTHOR ?></a>
                        </p>
                    </div>
                    <div class="col-12 col-sm-auto text-center">
                        <p class="mb-0 text-600 opacity-85">v<?= APP_VERSION ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of .container-->
    </section>
    <!-- <section> close ============================-->
    <!-- ============================================-->
</main>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->