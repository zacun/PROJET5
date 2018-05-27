var terminal = {

    init: function () {
        this.terminalElt = document.getElementById('terminal');
        this.terminalBtn = document.getElementsByClassName('terminal-button')[0];
        this.terminalClose = document.getElementsByClassName('terminal-close')[0];
        this.terminalForm = document.getElementsByClassName('terminal-form')[0];
        this.terminalScreen = document.getElementsByClassName('terminal-text')[0];
        this.inputCommand = null;
        this.commandName = null;
        this.param = null;
        ['click', 'touchend'].forEach(function (e) {
            terminal.terminalBtn.addEventListener(e, terminal.openAndClose);
            terminal.terminalClose.addEventListener(e, terminal.openAndClose);
        });
        window.addEventListener('keydown', function (e) {
            if (e.altKey && e.keyCode === 84 /* alt+ t */) {
                terminal.openAndClose();
            }
        });
        this.terminalForm.addEventListener('submit', this.submit);
        window.addEventListener('load', this.getMessages);
    },

    openAndClose: function () {
        terminal.terminalElt.classList.toggle('terminal-on');
    },

    submit: function (e) {
        e.preventDefault();
        terminal.inputCommand = document.getElementById('command');
        var inputValue = terminal.inputCommand.value;
        terminal.clearInput();
        inputValue.trim();
        inputValue.toLowerCase();
        terminal.commandName = inputValue;
        terminal.runCommand(inputValue);
    },

    runCommand: function (command) {
        if (command.indexOf(' ')) {
            var commands = command.split(/\s/);
            if (commands.length > 2) {
                terminal.unknownCommand();
                return;
            }
            terminal.commandName = commands[0];
            terminal.param = commands[1];
        }
        if (!(terminal.commandName in commandsList)) {
            terminal.unknownCommand();
            return;
        }
        var functionToRun = commandsList[terminal.commandName]['function'];
        functionToRun(terminal.param);
    },

    clearInput: function () {
        terminal.inputCommand.value = '';
    },

    unknownCommand: function () {
        terminal.addMessage('La commande "<i>' + terminal.commandName + '</i>" n\'existe pas.', 'error', true);
    },

    addMessage: function (message, type, toStore) {
        var messageElt;
        if (type === null) {
            messageElt = message;
        } else {
            messageElt = '<p class="' + type + '">' + message + '</p>';
        }
        if (toStore) {
            var messages = terminal.getStoredMessages();
            messages.push(messageElt);
            sessionStorage.setItem('messages', JSON.stringify(messages));
        }
        terminal.terminalScreen.innerHTML += messageElt;
    },

    getMessages: function () {
        var messages = terminal.getStoredMessages();
        if (messages.length > 0) {
            messages.forEach(function (message) {
                terminal.terminalScreen.innerHTML += message;
            });
        }
    },

    getStoredMessages : function () {
        var messages = sessionStorage.getItem('messages');
        if (!messages) {
            messages = [];
        } else {
            messages = JSON.parse(messages);
        }
        return messages;
    }

};
terminal.init();