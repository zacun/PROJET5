// This script allows you to freely move the terminal

var Move = function (elementToMove, elementForMoving) {

    var self = this;
    this.elementToMove = elementToMove;
    if (elementForMoving === undefined) {
        this.elementForMoving = elementToMove;
    }
    this.elementForMoving = elementForMoving;
    this.moving = false;
    this.diffX = 0;
    this.diffY = 0;
    this.elementForMoving.addEventListener('mousedown', begin);
    window.addEventListener('mouseup', end);
    
    function begin (e) {
        self.moving = true;
        var rect = self.elementToMove.getBoundingClientRect();
        self.diffX = e.clientX - rect.x;
        self.diffY = e.clientY - rect.y;
        self.elementToMove.style.zIndex = 9000;
        window.addEventListener('mousemove', move);
    }
    
    function move (e) {
        if (self.moving) {
            self.elementToMove.style.left = e.clientX - self.diffX + 'px';
            self.elementToMove.style.top = e.clientY - self.diffY + 'px';
        }
    }
    
    function end () {
        if (self.moving) {
            self.moving = false;
            window.removeEventListener('mousemove', move);
        }
    }

};

var MoveMobile = function (elementToMove, elementForMoving) {

    var self = this;
    this.elementToMove = elementToMove;
    if (elementForMoving === undefined) {
        this.elementForMoving = elementToMove;
    }
    this.elementForMoving = elementForMoving;
    this.moving = false;
    this.diffX = 0;
    this.diffY = 0;
    this.elementForMoving.addEventListener('touchstart', begin);
    window.addEventListener('touchmove', move);
    window.addEventListener('touchend', end);
    window.addEventListener('touchleave', end);
    window.addEventListener('touchcancel', end);

    function begin (e) {
        e.preventDefault();
        self.moving = true;
        var rect = self.elementToMove.getBoundingClientRect();
        self.elementToMove.style.zIndex = 9000;
        var touches = e.changedTouches;
        for (var i = 0; i < touches.length; i++) {
            self.diffX = touches[i].clientX - rect.x;
            self.diffY = touches[i].clientY - rect.y;
        }
    }

    function move (e) {
        e.preventDefault();
        var touches = e.changedTouches;
        if (self.moving) {
            for (var i = 0; i < touches.length; i++) {
                self.elementToMove.style.left = touches[i].clientX - self.diffX + 'px';
                self.elementToMove.style.top = touches[i].clientY - self.diffY + 'px';
            }
        }
    }

    function end () {
        if (self.moving) {
            self.moving = false;
        }
    }

};
Move(terminal.terminalElt, document.querySelector('.terminal-name'));
MoveMobile(terminal.terminalElt, document.querySelector('.terminal-name'));