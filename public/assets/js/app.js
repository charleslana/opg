document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById('email-login') && localStorage.getItem('emailLogin')) {
        document.getElementById('email-login').value = localStorage.getItem('emailLogin');
        document.getElementById('password-login').value = localStorage.getItem('passwordLogin');
        document.getElementById('modal-checkbox').checked = true;
    }
});

let loadingInterval;

document.getElementById('loginForm')?.addEventListener('submit', (event) => {
    event.preventDefault();
    loading(true);
    const button = document.getElementById('login-button');
    button.disabled = true;
    axios.post('?action=login', {
        email: document.getElementById('email-login').value, password: document.getElementById('password-login').value
    }).then(response => {
        const {data} = response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        validateSaveLoginData();
        redirect('select_crew');
    }).catch(error => {
        errorAlert(error.message);
    }).finally(() => {
        loading(false);
        button.disabled = false;
    });
});

function successAlert(message) {
    Swal.fire('Atenção!', message, 'success');
}

function errorAlert(message) {
    Swal.fire('Atenção!', message, 'error');
}

document.getElementById('registerForm')?.addEventListener('submit', (event) => {
    event.preventDefault();
    if (document.getElementById('password-register').value !== document.getElementById('confirm-password-register').value) {
        errorAlert('As senhas não são iguais.');
        return;
    }
    loading(true);
    const button = document.getElementById('register-button');
    button.disabled = true;
    axios.post('?action=register', {
        email: document.getElementById('email-register').value,
        password: document.getElementById('password-register').value,
        passwordConfirmation: document.getElementById('confirm-password-register').value,
        name: document.getElementById('name-register').value
    }).then(response => {
        const {data} = response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        redirect('confirm_email');
    }).catch(error => {
        errorAlert(error.message);
    }).finally(() => {
        loading(false);
        button.disabled = false;
    });
});

function loading(isLoading) {
    clearInterval(loadingInterval);
    const loadingIcon = document.getElementById('loadingIcon');
    const progressToggle = document.getElementById('progressToggle');
    if (isLoading) {
        loadingIcon.style.display = 'block';
        progressToggle.classList.add('inner');
        progressToggle.style.animationPlayState = 'running';
        progressToggle.addEventListener('animationend', function () {
            clearInterval(loadingInterval);
            loadingInterval = setInterval(() => {
                clearInterval(loadingInterval);
                if (document.getElementById('progressToggle').classList.contains('inner')) {
                    errorAlert('Ocorreu um erro com a conexão do servidor.');
                    loadingIcon.style.display = 'none';
                }
            }, 10000);
        });
        return;
    }
    fadeOutLoading();
}

function fadeOutLoading() {
    const loadingIcon = document.getElementById('loadingIcon');
    const progressToggle = document.getElementById('progressToggle');
    progressToggle.classList.remove('inner');
    progressToggle.style.width = '100%';
    const interval = setInterval(() => {
        clearInterval(interval);
        loadingIcon.style.display = 'none';
    }, 100);
}

function redirect(page) {
    window.location.href = `?action=${page}`;
}

function validateSaveLoginData() {
    if (document.getElementById('modal-checkbox').checked) {
        localStorage.setItem('emailLogin', document.getElementById('email-login').value);
        localStorage.setItem('passwordLogin', document.getElementById('password-login').value);
        return;
    }
    localStorage.removeItem('emailLogin');
    localStorage.removeItem('passwordLogin');
}

function showCharacterDetailsCanvas(data) {
    document.getElementById('offcanvasRightLabel').innerText = data.name;
    document.getElementById('characterImage').src = `../../public/assets/img/characters/landscape/${data.image}.png`;
    document.getElementById('strengthAttributes').innerText = `+${data.strength_attributes}`;
    document.getElementById('defenseAttributes').innerText = `+${data.defense_attributes}`;
    document.getElementById('lifeAttributes').innerText = `+${data.life_attributes}`;
    document.getElementById('energyAttributes').innerText = `+${data.energy_attributes}`;
    document.getElementById('agilityAttributes').innerText = `+${data.agility_attributes}`;
    document.getElementById('resistanceAttributes').innerText = `+${data.resistance_attributes}`;
    document.getElementById('maximumLevel').innerText = data.maximum_level;
    document.getElementById('hakiUnlock').innerText = data.haki_unlock === 'no' ? 'não' : 'sim';
    document.getElementById('akumaNoMiUnlock').innerText = data.akuma_no_mi_unlock === 'no' ? 'não' : 'sim';
    document.getElementById('playerLevelUnlock').style.width = `${barCalculation(data.accountLevel, +data.player_level_unlock)}%`;
    document.querySelector('#playerLevelUnlock > span').innerText = `${data.accountLevel}/${+data.player_level_unlock}`;
    document.getElementById('characterLevelUnlock').style.width = `${barCalculation(+data.level, +data.character_level_unlock)}%`;
    document.querySelector('#characterLevelUnlock > span').innerText = `${+data.level}/${+data.character_level_unlock}`;
    document.getElementById('characterNpcBattlesUnlock').style.width = `${barCalculation(+data.npc_battles, +data.character_npc_battles_unlock)}%`;
    document.querySelector('#characterNpcBattlesUnlock > span').innerText = `${+data.npc_battles}/${+data.character_npc_battles_unlock}`;
    document.getElementById('characterArenaBattlesUnlock').style.width = `${barCalculation(+data.arena_battles, +data.character_arena_battles_unlock)}%`;
    document.querySelector('#characterArenaBattlesUnlock > span').innerText = `${+data.arena_battles}/${+data.character_arena_battles_unlock}`;
    document.getElementById('characterNpcWinsUnlock').style.width = `${barCalculation(+data.npc_wins, +data.character_npc_wins_unlock)}%`;
    document.querySelector('#characterNpcWinsUnlock > span').innerText = `${+data.npc_wins}/${+data.character_npc_wins_unlock}`;
    document.getElementById('characterArenaWinsUnlock').style.width = `${barCalculation(+data.arena_wins, +data.character_arena_wins_unlock)}%`;
    document.querySelector('#characterArenaWinsUnlock > span').innerText = `${+data.arena_wins}/${+data.character_arena_wins_unlock}`;
    if (data.accountLevel < +data.player_level_unlock || +data.level < +data.character_level_unlock || +data.npc_battles < +data.character_npc_battles_unlock || +data.arena_battles < +data.character_arena_battles_unlock || +data.npc_wins < +data.character_npc_wins_unlock || +data.arena_wins < +data.character_arena_wins_unlock) {
        document.getElementById('free-recruit').setAttribute('disabled', '');
    } else {
        document.getElementById('free-recruit').removeAttribute('disabled');
    }
    const element = document.getElementById('offcanvasRight');
    const bsOffcanvas = new bootstrap.Offcanvas(element);
    bsOffcanvas.show();
}

function showCharacterDetails(id) {
    loading(true);
    axios.get('?action=get_character_details', {
        params: {
            id: id
        }
    }).then(response => {
        const {data} = response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        showCharacterDetailsCanvas(data);
    }).catch(error => {
        errorAlert(error.message);
    }).finally(() => {
        loading(false);
    });
}

function barCalculation(min, max) {
    if (min >= max) {
        return 100;
    }
    const multiply = (min * max) / max;
    const result = (multiply * 100) / max;
    if (result > 100) {
        return 100;
    }
    return result;
}