var commandsFunctions = {

    terminalText: document.querySelector('.terminal-text'),

    help: function () {
        terminal.addMessage('<p class="info">Voici la liste des commandes disponibles :</p>');
        var keys = Object.keys(commandsList);
        for (var i = 0; i < keys.length; i++) {
            var command = keys[i];
            var description = commandsList[keys[i]]['description'];
            terminal.addMessage('<p><span style="font-size: 1.25rem; color: #4ba7f2">' + command + '</span> : <i>' + description + '</i></p>');
        }
    },

    get: function (path) {
        var url = routes[path];
        terminal.addMessage('<p>Redirection vers la page ' + path +'...</p>');
        window.location.href = url;
    },
    
    login: function (login) {
        if (!login || login.trim() === '') {
            terminal.addMessage('<p class="error">Vous n\'avez pas écrit votre pseudo. La commande doit être sous la forme de "login pseudo".</p>');
            return;
        }
        var pseudo = login;
        // var terminalContent = document.querySelector('#terminal-content');
        // terminalContent.removeChild(terminal.terminalForm);
        terminal.terminalScreen.innerHTML +=
            '<p class="info">Veuillez saisir votre mot de passe.</p>' +
            '<form class="form-pass">' +
                '<input type="password" id="commandPass" name="commandPass" title="commandPass" placeholder="Mot de passe..." required>' +
                '<button type="submit">Valider</button>' +
            '</form>';
        var formPass = document.querySelector('.form-pass');
        formPass.addEventListener('submit', function (e) {
            e.preventDefault();
            var inputPass = document.querySelector('#commandPass');
            var password = inputPass.value;
            var data = new FormData();
            data.append('pseudo', pseudo);
            data.append('password', password);
            ajax.post(routes.login, data, function (response) {
                if (response === '1') {
                    terminal.addMessage('<p class="success">Connexion réussie.</p>');
                    window.location.replace(routes.admin);
                } else  if (response === '2') {
                    terminal.addMessage('<p class="info">Vous êtes déjà connecté.</p>');
                } else {
                    terminal.addMessage(response);
                }
            });
            inputPass.value = '';
            commandsFunctions.terminalText.removeChild(formPass);
            /*
            terminalContent.removeChild(formPass);
            terminalContent.appendChild(terminal.terminalForm);
            */
        });
    },

    logout: function () {
        ajax.get(routes.logout, function (response) {
            if (response === '1') {
                terminal.addMessage('<p class="success">Déconnexion réussie.</p>');
                window.location.replace(routes.home);
            } else {
                terminal.addMessage(response);
            }
        });
    },
    
    download: function (file) {
        window.location = '../public/download/' + file + '.pdf';
    },

    clear: function () {
        terminal.terminalScreen.innerHTML = '';
        sessionStorage.clear();
    }
    
};