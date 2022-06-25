<?php
if (!defined('APP_TAG_NAME')) {
    die();
}
?>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main">
    <div class="container" data-layout="container">
        <div class="row flex-center min-vh-100 py-6 text-center">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xxl-5">
                <p class="d-flex flex-center mb-4">
                    <span class="font-sans-serif fw-bolder fs-5 d-inline-block"><?= APP_TAG_NAME ?></span>
                </p>
                <div class="card">
                    <div class="card-body p-4 p-sm-5">
                        <img class="me-2" src="../../public/assets/img/icons/not_found.png" alt="" width="48"/>
                        <p class="lead mt-4 text-800 font-sans-serif fw-semi-bold w-md-75 w-xl-100 mx-auto">
                            A página solicitada não foi encontrada.
                        </p>
                        <hr/>
                        <p>Se você acha que foi um erro, por favor contate com o suporte.</p>
                        <a class="btn btn-primary btn-sm mt-3" href="?action=index">
                            <span class="fas fa-home me-2"></span>Ir para página inicial
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->