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
        redirect('?action=create_crew');
    }).catch(err => {
        console.error(err);
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
    axios.post('?action=register', {
        email: 'my-email@email', password: 'my-password'
    }).then(response => {
        const {data} = response;
        if (data.error) {
            errorAlert(data.error);
            return;
        }
        console.log(response);
        console.log(data);
        successAlert(data);
    }).catch(err => {
        console.error(err);
    }).finally(() => loading(false));
    return false;
}

function loading(isLoading) {
    const loadingIcon = document.getElementById('loadingIcon');
    const progressToggle = document.getElementById('progressToggle');
    if (isLoading) {
        loadingIcon.style.display = 'block';
        progressToggle.classList.add('inner');
        progressToggle.style.animationPlayState = 'running';
        progressToggle.addEventListener('animationend', function () {
            errorAlert('Ocorreu um erro com a conexão do servidor.');
            loadingIcon.style.display = 'none';
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
    window.location.href = page;
}