var terminal = {

    init: function () {
        this.terminalElt = document.querySelector('#terminal');
        this.terminalBtn = document.querySelector('.terminal-button');
        this.terminalClose = document.querySelector('.terminal-close');
        this.terminalBtn.addEventListener('click', this.openAndClose);
        this.terminalClose.addEventListener('click', this.openAndClose);
    },

    openAndClose: function (e) {
        if (terminal.terminalElt.classList.contains('off')) {
            terminal.terminalElt.className = 'terminal-on';
        } else {
            terminal.terminalElt.className = 'off';
        }
    }

};
terminal.init();