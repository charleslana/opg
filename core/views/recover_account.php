<?php
if (!defined('APP_TAG_NAME')) {
    die();
}
?>
<!-- ===============================================-->
<!--    Main Content-->
<!-- ===============================================-->
<main class="main">
    <div class="container-fluid">
        <div class="row min-vh-100 bg-100">
            <div class="col-6 d-none d-lg-block position-relative">
                <div class="bg-holder"
                     style="background-image:url(../../public/assets/img/layout/recover_password.jpg);background-position: 50% 30%;">
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
                            <div class="card-body p-4" id="recoverAccount">
                                <h3 class="text-center">Recuperar senha</h3>
                                <form class="mt-3" id="recoverAccountForm">
                                    <div class="mb-3">
                                        <label class="form-label" for="new-password">Nova senha</label>
                                        <input class="form-control" type="password" id="new-password" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="confirm-password">Confirme sua nova senha</label>
                                        <input class="form-control" type="password" id="confirm-password" required>
                                    </div>
                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit"
                                            id="recover-password-button">
                                        Alterar senha
                                    </button>
                                </form>
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