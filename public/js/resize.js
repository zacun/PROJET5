var resizeTerminal = {
    
    init: function () {
        this.terminalElt = terminalElt = document.querySelector('#terminal');
        this.resizeBtn = document.querySelector('.terminal-resize');
        this.resizingBtnHeight = this.resizeBtn.offsetTop;
        this.resizingBtnWidth = this.resizeBtn.offsetLeft;
        this.resizing = false;
        this.rect = 0;
        this.resizeBtn.addEventListener('mousedown', this.begin);
        window.addEventListener('mousemove', this.resize);
        window.addEventListener('mouseup', this.end);
    },
    
    begin: function () {
        resizeTerminal.resizing = true;
        resizeTerminal.rect = resizeTerminal.terminalElt.getBoundingClientRect();
    },
    
    resize: function (e) {
        e.preventDefault();
        if (resizeTerminal.resizing) {
            var diffX = e.clientX - resizeTerminal.rect.x + resizeTerminal.resizingBtnWidth;
            var diffY = e.clientY - resizeTerminal.rect.y + resizeTerminal.resizingBtnHeight;
            resizeTerminal.terminalElt.style.height = diffY + 'px';
            resizeTerminal.terminalElt.style.width = diffX + 'px';
        }
    },
    
    end: function () {
        resizeTerminal.resizing = false;
    }
    
};
resizeTerminal.init();