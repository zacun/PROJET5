var commandsFunctions = {

    terminalText: document.querySelector('.terminal-text'),

    get: function (path) {
        routes.url = routes[path];
        var message = '<p>Redirection ver la page ' + path +'...</p>';
        commandsFunctions.terminalText.innerHTML = message;
        location.href = routes.url;
    },
    
    login: function (logins) {
        if (logins.indexOf(':')) {
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
                    } else {
                        var message = '<p class="error">Un problème est survenu lors de l\'envoi de la requête au serveur.</p>';
                        commandsFunctions.terminalText.innerHTML += message;
                    }
                }
            };
            httpRequest.open('POST', '/login', true);
            httpRequest.send(data);
            window.location.replace(routes.admin);
        } else {
            var message = '<p class="error">Les identifiants n\'ont pas été écrits correctement.</p>';
            commandsFunctions.terminalText.innerHTML = message;
        }
    },

    logout: function () {
        httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function () {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    var message = httpRequest.responseText;
                    commandsFunctions.terminalText.innerHTML += message;
                } else {
                    var message = '<p class="error">Un problème est survenu lors de l\'envoi de la requête au serveur.</p>';
                    commandsFunctions.terminalText.innerHTML += message;
                }
            }
        };
        httpRequest.open('GET', '/logout', true);
        httpRequest.send(null);
        window.location.replace(routes.home);
    },
    
    download: function (file) {

    },

    clear: function () {
        commandsFunctions.terminalText.innerHTML = '';
    }
    
};