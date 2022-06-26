<?php
if (!defined('APP_TAG_NAME')) {
    die();
}

use core\enum\SessionEnum;

?>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main">
    <div class="container-fluid">
        <div class="row min-vh-100 bg-100">
            <div class="col-6 d-none d-lg-block position-relative">
                <div class="bg-holder"
                     style="background-image:url(../../public/assets/img/layout/confirm_email.jpg);background-position: 50% 30%;">
                </div>
            </div>
            <div class="col-sm-10 col-md-6 px-sm-0 align-self-center mx-auto py-5">
                <div class="row justify-content-center g-0">
                    <div class="col-lg-9 col-xl-8 col-xxl-6">
                        <div class="card">
                            <div class="card-header bg-circle-shape bg-shape text-center p-2">
                                <p class="font-sans-serif fw-bolder fs-4 z-index-1 position-relative link-light light">
                                    <?= APP_TAG_NAME ?>
                                </p>
                            </div>
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <img class="d-block mx-auto mb-4" src="../../public/assets/img/icons/email.png"
                                         alt="Email" width="96"/>
                                    <h3 class="mb-2">E-mail enviado!</h3>
                                    <p>Caso exista uma conta com o email informado:
                                        <strong><?= $_SESSION[SessionEnum::AccountEmail->value] ?></strong>,
                                        será possível recuperar sua conta.
                                    </p>
                                    <a class="btn btn-primary btn-sm mt-3" href="?action=index">
                                        <span class="fas fa-chevron-left me-1"
                                              data-fa-transform="shrink-4 down-1"></span>Retornar para login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- ===============================================-->
<!--    End of Main Content-->
<!-- ===============================================-->