var terminal = {

    init: function () {
        this.terminalElt = document.querySelector('#terminal');
        this.terminalBtn = document.querySelector('.terminal-button');
        this.terminalClose = document.querySelector('.terminal-close');
        this.terminalForm = document.querySelector('.terminal-form');
        this.terminalScreen = document.querySelector('.terminal-text');
        this.inputCommand = null;
        this.commandName = null;
        this.param = null;
        this.terminalBtn.addEventListener('click', this.openAndClose);
        this.terminalClose.addEventListener('click', this.openAndClose);
        this.terminalForm.addEventListener('submit', this.submit);
        window.addEventListener('load', this.getMessages);
    },

    openAndClose: function () {
        if (terminal.terminalElt.classList.contains('off')) {
            terminal.terminalElt.className = 'terminal-on';
        } else {
            terminal.terminalElt.className = 'off';
        }
    },

    submit: function (e) {
        e.preventDefault();
        terminal.inputCommand = document.querySelector('#command');
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
                terminal.addMessage('<p class="error">La commande ' + '"<i>' + terminal.commandName + '</i>"' + ' n\'existe pas.</p>');
                return;
            }
            terminal.commandName = commands[0];
            terminal.param = commands[1];
        }
        if (!(terminal.commandName in commandsList)) {
            terminal.addMessage('<p class="error">La commande ' + '"<i>' + terminal.commandName + '</i>"' + ' n\'existe pas.</p>');
            return;
        }
        var functionToRun = commandsList[terminal.commandName]['function'];
        functionToRun(terminal.param);
    },

    clearInput: function () {
        terminal.inputCommand.value = '';
    },

    addMessage: function (message) {
        terminal.terminalScreen.innerHTML += message;
        var messages = sessionStorage.getItem('messages');
        if (!messages) {
            messages = [];
        } else {
            messages = JSON.parse(messages);
        }
        messages.push(message);
        sessionStorage.setItem('messages', JSON.stringify(messages));
    },

    getMessages: function () {
        var messages = sessionStorage.getItem('messages');
        if (messages) {
            messages = JSON.parse(messages);
            messages.forEach(function (message) {
                terminal.terminalScreen.innerHTML += message;
            });
        }
    }

};
terminal.init();