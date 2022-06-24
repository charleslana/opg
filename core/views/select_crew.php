<?php

use core\classes\Functions;
use core\service\AccountCharacterService;

$nextPage = true;
$page = !isset($_GET['page']) ? 1 : Functions::setAbsoluteValue($_GET['page']);
$accountCharacters = AccountCharacterService::showAllCharacter($page);
if (!$accountCharacters) {
    $nextPage = false;
}
?>
<div class="card mb-3">
    <div class="card-header">
        <div class="row flex-between-end">
            <div class="col-auto align-self-center">
                <h5 class="mb-0" data-anchor="data-anchor" id="additional-content">
                    Selecione um tripulante para começar a jogar!
                </h5>
            </div>
        </div>
    </div>
</div>
<?php if ($nextPage) : ?>
    <div class="row row-cols-auto mb-3">
        <?php foreach ($accountCharacters as $accountCharacter) : ?>
            <div class="col text-start separate-column">
                <div class="character-portrait"
                     onclick="selectCharacter(<?= $accountCharacter->id ?>, '<?= $accountCharacter->name ?>', <?= $accountCharacter->level ?>)"
                     style="background-image: url('/public/assets/img/characters/portrait/<?= $accountCharacter->image ?>.png')"></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php elseif ($page == 1): ?>
    <div class="alert alert-danger text-center mb-3" role="alert">
        Você não tem nenhum tripulante, clique <a href="?action=recruit_crew">aqui</a> para recrutar um personagem!
    </div>
<?php endif; ?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <?php if ($page > 1) : ?>
            <li class="page-item">
                <a class="page-link" href="?action=select_crew&page=<?= $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                </a>
            </li>
        <?php endif; ?>
        <li class="page-item active">
            <span class="page-link"><?= $page ?></span>
        </li>
        <?php if ($nextPage) : ?>
            <li class="page-item">
                <a class="page-link" href="?action=select_crew&page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Próximo</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>