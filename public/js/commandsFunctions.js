var commandsFunctions = {

    terminalText: document.querySelector('.terminal-text'),

    get: function (path) {
        var url = routes[path];
        var message = '<p>Redirection ver la page ' + path +'...</p>';
        commandsFunctions.terminalText.innerHTML = message;
        location.href = url;
    },
    
    login: function (logins) {
        if (logins.indexOf(':') !== -1) {
            var login = logins.split(/:/);
            var pseudo = login[0];
            var password = login[1];
            var data = new FormData();
            data.append('pseudo', pseudo);
            data.append('password', password);
            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function () {
                if (httpRequest.readyState === XMLHttpRequest.DONE) {
                    if (httpRequest.status === 200) {
                        var message = httpRequest.responseText;
                        commandsFunctions.terminalText.innerHTML += message;
                        window.location.replace(routes.admin);
                    } else {
                        var message = '<p class="error">Un problème est survenu lors de l\'envoi de la requête au serveur.</p>';
                        commandsFunctions.terminalText.innerHTML += message;
                    }
                }
            };
            httpRequest.open('POST', routes.login, true);
            httpRequest.send(data);
        } else {
            var message = '<p class="error">Les identifiants n\'ont pas été écrits correctement.</p>';
            commandsFunctions.terminalText.innerHTML += message;
        }
    },

    logout: function () {
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    var message = httpRequest.responseText;
                    commandsFunctions.terminalText.innerHTML += message;
                    window.location.replace(routes.home);
                } else {
                    var message = '<p class="error">Un problème est survenu lors de l\'envoi de la requête au serveur.</p>';
                    commandsFunctions.terminalText.innerHTML += message;
                }
            }
        };
        httpRequest.open('GET', routes.logout, true);
        httpRequest.send(null);
    },
    
    download: function (file) {
        window.location = '../public/download/' + file + '.pdf';
    },

    clear: function () {
        commandsFunctions.terminalText.innerHTML = '';
    }
    
};