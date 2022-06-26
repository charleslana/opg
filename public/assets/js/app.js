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
    }).then(() => {
        validateSaveLoginData();
        redirect('select_crew');
    }).catch(error => {
        const {data} = error.response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        errorAlert(error.message);
    }).finally(() => {
        loading(false);
        button.disabled = false;
    });
});

function successAlert(message) {
    Swal.fire('Sucesso!', message, 'success');
}

function errorAlert(message) {
    Swal.fire('Erro!', message, 'error');
}

async function confirmAlert() {
    return Swal.fire({
        title: 'Confirmação!',
        text: 'Tem certeza que realmente deseja continuar?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
    }).then((result) => {
        if (result.isConfirmed) {
            return true;
        }
    })
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
    }).then(() => {
        redirect('confirm_email');
    }).catch(error => {
        const {data} = error.response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
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

function getCharacterStatusDetails(data) {
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
}

function getCharacterRequirementsDetails(data) {
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
}

function getCharacterFreeRecruitDetails(data) {
    const freeRecruitElement = document.getElementById('free-recruit');
    freeRecruitElement.style.display = 'block';
    freeRecruitElement.removeAttribute('disabled');
    if (data.accountLevel < +data.player_level_unlock || +data.level < +data.character_level_unlock || +data.npc_battles < +data.character_npc_battles_unlock || +data.arena_battles < +data.character_arena_battles_unlock || +data.npc_wins < +data.character_npc_wins_unlock || +data.arena_wins < +data.character_arena_wins_unlock) {
        freeRecruitElement.setAttribute('disabled', '');
    }
    return freeRecruitElement;
}

function getCharacterGoldUnlockDetails(data) {
    const goldUnlockElement = document.getElementById('goldUnlock');
    goldUnlockElement.style.display = 'block';
    goldUnlockElement.removeAttribute('disabled');
    goldUnlockElement.innerHTML = `Recrutar ${numberAbbreviation(data.gold_unlock)} <span class="gold-icon"></span>`;
    goldUnlockElement.setAttribute('data-bs-original-title', `${numberFormat(data.gold_unlock)} Ouro`);
    if (data.accountGold < data.gold_unlock) {
        goldUnlockElement.setAttribute('disabled', '');
    }
    return goldUnlockElement;
}

function getArrayAccountCharacterIds(data) {
    const arrayAccountCharacterIds = [];
    if (typeof data.accountCharacterIds === 'string') {
        const accountCharacterIds = data.accountCharacterIds.split(',');
        accountCharacterIds.forEach(function (obj) {
            arrayAccountCharacterIds.push(parseInt(obj, 10));
        });
    }
    return arrayAccountCharacterIds;
}

function getCharacterAlertRecruitDetails(arrayAccountCharacterIds, data, freeRecruitElement, goldUnlockElement) {
    const alert = document.getElementById('alert');
    alert.classList.remove('alert-success');
    alert.classList.add('alert-warning');
    alert.innerHTML = 'Você pode pagar com <span class="gold-icon"></span> para recrutar agora!';
    const tabRecruitHr = document.querySelector('#tab-recruit hr');
    tabRecruitHr.style.display = 'block';
    if (arrayAccountCharacterIds.indexOf(data.id) !== -1) {
        freeRecruitElement.style.display = 'none';
        goldUnlockElement.style.display = 'none';
        alert.classList.remove('alert-warning');
        alert.classList.add('alert-success');
        alert.innerText = 'Você já possui este tripulante!';
        tabRecruitHr.style.display = 'none';
    }
}

function showCharacterDetailsCanvas(data) {
    getCharacterStatusDetails(data);
    getCharacterRequirementsDetails(data);
    const freeRecruitElement = getCharacterFreeRecruitDetails(data);
    const goldUnlockElement = getCharacterGoldUnlockDetails(data);
    const arrayAccountCharacterIds = getArrayAccountCharacterIds(data);
    getCharacterAlertRecruitDetails(arrayAccountCharacterIds, data, freeRecruitElement, goldUnlockElement);
    freeRecruitElement.setAttribute('data-id', data.id);
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
        showCharacterDetailsCanvas(data);
    }).catch(error => {
        const {data} = error.response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
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

function numberAbbreviationSymbol() {
    return [
        {value: 1, symbol: ''},
        {value: 1e3, symbol: 'K'},
        {value: 1e6, symbol: 'M'},
        {value: 1e9, symbol: 'B'},
        {value: 1e12, symbol: 't'},
        {value: 1e15, symbol: 'q'},
        {value: 1e18, symbol: 'Q'},
        {value: 1e21, symbol: 's'},
        {value: 1e24, symbol: 'S'},
        {value: 1e27, symbol: 'o'},
        {value: 1e30, symbol: 'n'},
        {value: 1e33, symbol: 'd'},
    ];
}

function numberAbbreviation(num, digits = 1) {
    const lookup = numberAbbreviationSymbol();
    const rx = /\.0+$|(\.[0-9]*[1-9])0+$/;
    const item = lookup
        .slice()
        .reverse()
        .find(function (it) {
            return num >= it.value;
        });
    return item
        ? (num / item.value).toFixed(digits).replace(rx, '$1') + item.symbol
        : '0';
}

function numberFormat(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function recruitCrewFree() {
    const freeRecruitButton = document.getElementById('free-recruit');
    const id = freeRecruitButton.getAttribute('data-id');
    loading(true);
    freeRecruitButton.disabled = true;
    axios.post('?action=add_crew', null, {
        params: {
            id: id
        }
    }).then(response => {
        const {data} = response;
        if (data.success) {
            closeOffCanvas();
            successAlert(data.success);
        }
    }).catch(error => {
        const {data} = error.response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        errorAlert(error.message);
    }).finally(() => {
        loading(false);
        freeRecruitButton.disabled = false;
    });
}

function closeOffCanvas() {
    const element = document.getElementById('offcanvasRight');
    const openedCanvas = bootstrap.Offcanvas.getInstance(element);
    openedCanvas.hide();
}

async function recruitPaidCrew() {
    const checkConfirmAlert = await confirmAlert();
    if (!checkConfirmAlert) {
        return;
    }
    const goldUnlockButton = document.getElementById('goldUnlock');
    const id = document.getElementById('free-recruit').getAttribute('data-id');
    const tooltip = bootstrap.Tooltip.getInstance(goldUnlockButton);
    tooltip.hide();
    loading(true);
    goldUnlockButton.disabled = true;
    axios.post('?action=add_crew', null, {
        params: {
            id: id,
            isPaid: true
        }
    }).then(response => {
        const {data} = response;
        if (data.success) {
            closeOffCanvas();
            successAlert(data.success);
        }
    }).catch(error => {
        const {data} = error.response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        errorAlert(error.message);
    }).finally(() => {
        loading(false);
        goldUnlockButton.disabled = false;
    });
}

function selectCharacter(id, name, level) {
    Swal.fire({
        text: `${name} [${level}]`,
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: 'Conectar',
        cancelButtonText: 'Fechar',
    }).then((result) => {
        if (result.isConfirmed) {
            loading(true);
            axios.post('?action=create_crew_session', null, {
                params: {
                    id: id
                }
            }).then(() => {
                redirect('status');
            }).catch(error => {
                const {data} = error.response;
                if (data.error) {
                    errorAlert(data.error);
                    return;
                }
                errorAlert(error.message);
            }).finally(() => {
                loading(false);
            });
        }
    })
}