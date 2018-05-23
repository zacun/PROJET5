var commandsList = {

    '-help': {
        'function': commandsFunctions.help,
        'description': 'Affiche toutes les commandes disponibles.'
    },

    'get': {
        'function': commandsFunctions.get,
        'description': 'Redirige vers la page souhaitée, ex : "get blog" redirigera vers la page blog.'
    },

    'login': {
        'function': commandsFunctions.login,
        'description': 'Permet de se connecter, ex : "login pseudo"'
    },

    'logout': {
        'function': commandsFunctions.logout,
        'description': 'Permet de se déconnecter.'
    },

    'download': {
        'function': commandsFunctions.download,
        'description': 'Permet de télécharger un fichier, ex : "download cv" vous permettra de télécharger le pdf de mon CV.'
    },

    'clear': {
        'function': commandsFunctions.clear,
        'description': 'Permet d\'effacer le contenu textuel du terminal'
    }

};