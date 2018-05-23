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
    window.addEventListener('mousemove', move);
    window.addEventListener('mouseup', end);
    
    function begin (e) {
        self.moving = true;
        var rect = self.elementToMove.getBoundingClientRect();
        self.diffX = e.clientX - rect.x;
        self.diffY = e.clientY - rect.y;
        self.elementToMove.style.zIndex = 9000;
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
        var rect = terminalElt.getBoundingClientRect();
        self.terminalElt.style.zIndex = 9000;
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
                self.terminalElt.style.left = touches[i].clientX - self.diffX + 'px';
                self.terminalElt.style.top = touches[i].clientY - self.diffY + 'px';
            }
        }
    }

    function end () {
        if (self.moving) {
            self.moving = false;
        }
    }

};
Move(document.querySelector('#terminal'), document.querySelector('.terminal-name'));
MoveMobile(document.querySelector('#terminal'), document.querySelector('.terminal-name'));