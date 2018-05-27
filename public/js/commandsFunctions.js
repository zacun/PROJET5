var commandsFunctions = {

    help: function () {
        terminal.addMessage('Voici la liste des commandes disponibles :', 'info', true);
        var keys = Object.keys(commandsList);
        for (var i = 0; i < keys.length; i++) {
            var command = keys[i];
            var description = commandsList[keys[i]]['description'];
            terminal.addMessage('<p><span style="font-size: 1.25rem; color: #4ba7f2">' + command + '</span> : <i>' + description + '</i></p>', null, true);
        }
    },

    get: function (path) {
        var url = routes[path];
        terminal.addMessage('Redirection vers la page ' + path + '...', 'info');
        window.location.href = url;
    },
    
    login: function (login) {
        if (!login || login.trim() === '') {
            terminal.addMessage('Vous n\'avez pas écrit votre pseudo. La commande doit être sous la forme de "login pseudo".', 'error', true);
            return;
        }
        terminal.addMessage('Veuillez saisir votre mot de passe.', 'info');
        terminal.addMessage(
            '<form class="form-pass">' +
                '<input type="password" id="commandPass" name="commandPass" title="commandPass" placeholder="Mot de passe..." required>' +
                '<button type="submit">Valider</button>' +
            '</form>'
        );
        var formPass = document.getElementsByClassName('form-pass')[0];
        var inputPass = document.getElementById('commandPass');
        inputPass.focus();
        formPass.addEventListener('submit', function (e) {
            e.preventDefault();
            var password = inputPass.value;
            var data = new FormData();
            data.append('pseudo', login);
            data.append('password', password);
            ajax.post(routes.login, data, function (response) {
                if (response === 'connection successful') {
                    terminal.addMessage('Connexion réussie.', 'success', true);
                    window.location.replace(routes.admin);
                } else  if (response === 'already connected') {
                    terminal.addMessage('Vous êtes déjà connecté.', 'info', true);
                } else {
                    terminal.addMessage('Identifiants incorrects', 'error', true);
                }
            });
            terminal.terminalScreen.removeChild(formPass);
        });
    },

    logout: function () {
        ajax.get(routes.logout, function (response) {
            if (response === 'logout successful') {
                terminal.addMessage('Déconnexion réussie.', 'success', true);
                window.location.replace(routes.home);
            } else {
                terminal.addMessage('Vous n\'êtes pas connecté.', 'info', true);
            }
        });
    },

    contact: function () {
        terminal.addMessage('Vous pouvez me contacter :', 'info', true);
        terminal.addMessage(
            '<ul>' +
                '<li>&gt;&gt; <a target="_top" href="mailto:batpaulin@gmail.com">En cliquant ici</a> &lt;&lt;</li>' +
                '<li><a href="' + routes.home + '#contact">Via le formulaire de contact</a></li>' +
                '<li>Directement avec l\'addresse mail : <i>batpaulin@gmail.com</i></li>' +
            '</ul>', null, true
        );
    },
    
    download: function (file) {
        window.location = '../public/download/' + file + '.pdf';
    },

    clear: function () {
        terminal.terminalScreen.innerHTML = '';
        sessionStorage.removeItem('messages');
    }
    
};