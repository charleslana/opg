document.addEventListener("DOMContentLoaded", () => {
    if (document.getElementById('email-login') && localStorage.getItem('emailLogin')) {
        document.getElementById('email-login').value = localStorage.getItem('emailLogin');
        document.getElementById('password-login').value = localStorage.getItem('passwordLogin');
        document.getElementById('modal-checkbox').checked = true;
    }
});

let loadingInterval;

function getAxiosError(error) {
    const {data} = error.response;
    if (data) {
        errorAlert(data.message);
        return;
    }
    errorAlert(error.message);
}

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
        getAxiosError(error);
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

function getPostRegister() {
    return {
        email: document.getElementById('email-register').value,
        password: document.getElementById('password-register').value,
        passwordConfirmation: document.getElementById('confirm-password-register').value,
        name: document.getElementById('name-register').value
    };
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
    axios.post('?action=register', getPostRegister()).then(() => {
        redirect('confirm_email');
    }).catch(error => {
        getAxiosError(error);
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
    document.getElementById('offcanvasRightLabel').innerText = data.character.name;
    document.getElementById('characterImage').src = `../../public/assets/img/characters/landscape/${data.character.image}.png`;
    document.getElementById('strengthAttributes').innerText = `+${data.character.strengthAttributes}`;
    document.getElementById('defenseAttributes').innerText = `+${data.character.defenseAttributes}`;
    document.getElementById('lifeAttributes').innerText = `+${data.character.lifeAttributes}`;
    document.getElementById('energyAttributes').innerText = `+${data.character.energyAttributes}`;
    document.getElementById('agilityAttributes').innerText = `+${data.character.agilityAttributes}`;
    document.getElementById('resistanceAttributes').innerText = `+${data.character.resistanceAttributes}`;
    document.getElementById('intelligenceAttributes').innerText = `+${data.character.intelligenceAttributes}`;
    document.getElementById('maximumLevel').innerText = data.character.maximumLevel;
    document.getElementById('hakiUnlock').innerText = data.character.hakiUnlock === 'no' ? 'não' : 'sim';
    document.getElementById('akumaNoMiUnlock').innerText = data.character.akumaNoMiUnlock === 'no' ? 'não' : 'sim';
}

function getCharacterRequirementsDetails(data) {
    document.getElementById('playerLevelUnlock').style.width = `${barCalculation(data.account.level, +data.character.playerLevelUnlock)}%`;
    document.querySelector('#playerLevelUnlock > span').innerText = `${data.account.level}/${+data.character.playerLevelUnlock}`;
    document.getElementById('characterLevelUnlock').style.width = `${barCalculation(+data.accountCharacter.level, +data.character.characterLevelUnlock)}%`;
    document.querySelector('#characterLevelUnlock > span').innerText = `${+data.accountCharacter.level}/${+data.character.characterLevelUnlock}`;
    document.getElementById('characterNpcBattlesUnlock').style.width = `${barCalculation(+data.accountCharacter.npcBattles, +data.character.characterNpcBattlesUnlock)}%`;
    document.querySelector('#characterNpcBattlesUnlock > span').innerText = `${+data.accountCharacter.npcBattles}/${+data.character.characterNpcBattlesUnlock}`;
    document.getElementById('characterArenaBattlesUnlock').style.width = `${barCalculation(+data.accountCharacter.arenaBattles, +data.character.characterArenaBattlesUnlock)}%`;
    document.querySelector('#characterArenaBattlesUnlock > span').innerText = `${+data.accountCharacter.arenaBattles}/${+data.character.characterArenaBattlesUnlock}`;
    document.getElementById('characterNpcWinsUnlock').style.width = `${barCalculation(+data.accountCharacter.npcWins, +data.character.characterNpcWinsUnlock)}%`;
    document.querySelector('#characterNpcWinsUnlock > span').innerText = `${+data.accountCharacter.npcWins}/${+data.character.characterNpcWinsUnlock}`;
    document.getElementById('characterArenaWinsUnlock').style.width = `${barCalculation(+data.accountCharacter.arenaWins, +data.character.characterArenaWinsUnlock)}%`;
    document.querySelector('#characterArenaWinsUnlock > span').innerText = `${+data.accountCharacter.arenaWins}/${+data.character.characterArenaWinsUnlock}`;
}

function getCharacterFreeRecruitDetails(data) {
    const freeRecruitElement = document.getElementById('free-recruit');
    freeRecruitElement.style.display = 'block';
    freeRecruitElement.removeAttribute('disabled');
    if (data.account.level < +data.character.playerLevelUnlock || +data.accountCharacter.level < +data.character.characterLevelUnlock || +data.accountCharacter.npcBattles < +data.character.characterNpcBattlesUnlock || +data.accountCharacter.arenaBattles < +data.character.characterArenaBattlesUnlock || +data.accountCharacter.npcWins < +data.character.characterNpcWinsUnlock || +data.accountCharacter.arenaWins < +data.character.characterArenaWinsUnlock) {
        freeRecruitElement.setAttribute('disabled', '');
    }
    return freeRecruitElement;
}

function getCharacterGoldUnlockDetails(data) {
    const goldUnlockElement = document.getElementById('goldUnlock');
    goldUnlockElement.style.display = 'block';
    goldUnlockElement.removeAttribute('disabled');
    goldUnlockElement.innerHTML = `Recrutar ${numberAbbreviation(data.character.goldUnlock)} <span class="gold-icon"></span>`;
    goldUnlockElement.setAttribute('data-bs-original-title', `${numberFormat(data.character.goldUnlock)} Ouro`);
    if (data.account.gold < data.character.goldUnlock) {
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
    if (arrayAccountCharacterIds.indexOf(data.character.id) !== -1) {
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
    freeRecruitElement.setAttribute('data-id', data.character.id);
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
        getAxiosError(error);
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
    return [{value: 1, symbol: ''}, {value: 1e3, symbol: 'K'}, {value: 1e6, symbol: 'M'}, {
        value: 1e9,
        symbol: 'B'
    }, {value: 1e12, symbol: 't'}, {value: 1e15, symbol: 'q'}, {value: 1e18, symbol: 'Q'}, {
        value: 1e21,
        symbol: 's'
    }, {value: 1e24, symbol: 'S'}, {value: 1e27, symbol: 'o'}, {value: 1e30, symbol: 'n'}, {value: 1e33, symbol: 'd'}];
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
    return item ? (num / item.value).toFixed(digits).replace(rx, '$1') + item.symbol : '0';
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
        if (data) {
            closeOffCanvas();
            successAlert(data.message);
        }
    }).catch(error => {
        getAxiosError(error);
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
            id: id, isPaid: true
        }
    }).then(response => {
        const {data} = response;
        if (data) {
            closeOffCanvas();
            successAlert(data.message);
        }
    }).catch(error => {
        getAxiosError(error);
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
                getAxiosError(error);
            }).finally(() => {
                loading(false);
            });
        }
    })
}

document.getElementById('activateEmailForm')?.addEventListener('submit', (event) => {
    event.preventDefault();
    loading(true);
    const button = document.getElementById('activate-email-button');
    button.disabled = true;
    axios.post('?action=activate_email', {
        email: document.getElementById('activate-email').value
    }).then(() => {
        redirect('confirm_activate_email');
    }).catch(error => {
        getAxiosError(error);
    }).finally(() => {
        loading(false);
        button.disabled = false;
    });
});

document.getElementById('recoverPasswordForm')?.addEventListener('submit', (event) => {
    event.preventDefault();
    loading(true);
    const button = document.getElementById('recover-password-button');
    button.disabled = true;
    axios.post('?action=recover_password', {
        email: document.getElementById('recover-password').value
    }).then(() => {
        redirect('confirm_recover_password');
    }).catch(error => {
        getAxiosError(error);
    }).finally(() => {
        loading(false);
        button.disabled = false;
    });
});

function getRecoverAccountSuccess(response) {
    const {data} = response;
    if (data) {
        document.getElementById('recoverAccount').innerHTML = `
            <div class="text-center">
                <p>${data.message}</p>
                <a class="btn btn-primary btn-sm mt-3" href="?action=index">
                    <span class="fas fa-chevron-left me-1" data-fa-transform="shrink-4 down-1"></span>Retornar para login
                </a>
            </div>
        `;
    }
}

document.getElementById('recoverAccountForm')?.addEventListener('submit', (event) => {
    event.preventDefault();
    if (document.getElementById('new-password').value !== document.getElementById('confirm-password').value) {
        errorAlert('As senhas não são iguais.');
        return;
    }
    loading(true);
    const button = document.getElementById('recover-password-button');
    button.disabled = true;
    axios.post('?action=recover', {
        password: document.getElementById('new-password').value, token: getQueryStringParams('token')
    }).then(response => {
        getRecoverAccountSuccess(response);
    }).catch(error => {
        getAxiosError(error);
    }).finally(() => {
        loading(false);
        button.disabled = false;
    });
});

function getQueryStringParams(param) {
    const pageURL = window.location.search.substring(1);
    const urlVariables = pageURL.split('&');
    for (const element of urlVariables) {
        const parameterName = element.split('=');
        if (parameterName[0] === param) {
            return parameterName[1];
        }
    }
}