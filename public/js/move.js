// This script allows to freely move the terminal

var moveTerminal = {

    init: function () {
        this.terminalElt = terminalElt = document.querySelector('#terminal');
        this.terminalMoveBar = document.querySelector('.terminal-name');
        this.moving = false;
        this.diffX = 0;
        this.diffY = 0;
        this.terminalMoveBar.addEventListener('mousedown', this.begin);
        window.addEventListener('mousemove', this.move);
        window.addEventListener('mouseup', this.end);
    },
    
    begin: function (e) {
        moveTerminal.moving = true;
        var rect = terminalElt.getBoundingClientRect();
        moveTerminal.diffX = e.clientX - rect.x;
        moveTerminal.diffY = e.clientY - rect.y;
        moveTerminal.terminalElt.style.zIndex = 9000;
    },
    
    move: function (e) {
        if (moveTerminal.moving) {
            moveTerminal.terminalElt.style.left = e.clientX - moveTerminal.diffX + 'px';
            moveTerminal.terminalElt.style.top = e.clientY - moveTerminal.diffY + 'px';
        }
    },
    
    end: function () {
        if (moveTerminal.moving) {
            moveTerminal.moving = false;
        }
    }

};
moveTerminal.init();

var moveMobile = {

    init: function () {
        this.terminalElt = terminalElt = document.querySelector('#terminal');
        this.terminalMoveBar = document.querySelector('.terminal-name');
        this.moving = false;
        this.diffX = 0;
        this.diffY = 0;
        this.terminalMoveBar.addEventListener('touchstart', this.begin);
        window.addEventListener('touchmove', this.move);
        window.addEventListener('touchend', this.end);
        window.addEventListener('touchleave', this.end);
        window.addEventListener('touchcancel', this.end);
    },

    begin: function (e) {
        e.preventDefault();
        moveMobile.moving = true;
        var rect = terminalElt.getBoundingClientRect();
        moveMobile.terminalElt.style.zIndex = 9000;
        var touches = e.changedTouches;
        for (var i = 0; i < touches.length; i++) {
            moveMobile.diffX = touches[i].clientX - rect.x;
            moveMobile.diffY = touches[i].clientY - rect.y;
        }
    },

    move: function (e) {
        e.preventDefault();
        var touches = e.changedTouches;
        if (moveMobile.moving) {
            for (var i = 0; i < touches.length; i++) {
                moveMobile.terminalElt.style.left = touches[i].clientX - moveMobile.diffX + 'px';
                moveMobile.terminalElt.style.top = touches[i].clientY - moveMobile.diffY + 'px';
            }
        }
    },

    end: function () {
        if (moveMobile.moving) {
            moveMobile.moving = false;
        }
    }

};
moveMobile.init();