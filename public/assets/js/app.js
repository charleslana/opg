let loadingInterval;

function login() {
    loading(true);
    axios.post('?action=login', {
        email: document.getElementById('email-login').value, password: 'my-password'
    }).then(response => {
        const {data} = response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        console.log(response);
        console.log(data);
        redirect('create_crew');
    }).catch(error => {
        errorAlert(error.message);
    }).finally(() => loading(false));
    return false;
}

function successAlert(message) {
    Swal.fire('Atenção!', message, 'success');
}

function errorAlert(message) {
    Swal.fire('Atenção!', message, 'error');
}

function register() {
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
    return false;
}

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