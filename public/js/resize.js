// This script allows you to freely resize the terminal

var Resize = function (elementToResize, elementForResizing) {

    var self = this;
    this.elementToResize = elementToResize;
    this.resizingBtn = elementForResizing;
    this.resizingBtnHeight = this.resizingBtn.offsetHeight;
    this.resizingBtnWidth = this.resizingBtn.offsetWidth;
    this.resizing = false;
    this.rect = 0;
    this.resizingBtn.addEventListener('mousedown', begin);
    window.addEventListener('mouseup', end);


    function begin () {
        self.resizing = true;
        self.rect = self.elementToResize.getBoundingClientRect();
        window.addEventListener('mousemove', resize);
    }
    
    function resize (e) {
        e.preventDefault();
        if (self.resizing) {
            var diffX = e.clientX - self.rect.x + self.resizingBtnWidth / 4; // divided by 4 -> because my resize button has "transform: translate3D(25%, 25%, 0)"; which make it go out of the parent element.
            var diffY = e.clientY - self.rect.y + self.resizingBtnHeight / 4;
            self.elementToResize.style.height = diffY + 'px';
            self.elementToResize.style.width = diffX + 'px';
        }
    }
    
    function end () {
        self.resizing = false;
        window.removeEventListener('mousemove', resize);
    }
    
};

var ResizeMobile = function (elementToResize, elementForResizing) {

    var self = this;
    this.elementToResize = elementToResize;
    this.resizingBtn = elementForResizing;
    this.resizingBtnHeight = this.resizingBtn.offsetHeight;
    this.resizing = false;
    this.rect = 0;
    this.resizingBtn.addEventListener('touchstart', begin);
    window.addEventListener('touchend', end);


    function begin (e) {
        e.preventDefault();
        self.resizing = true;
        self.rect = self.elementToResize.getBoundingClientRect();
        window.addEventListener('touchmove', resize);
    }

    function resize (e) {
        e.preventDefault();
        var touches = e.changedTouches;
        if (self.resizing) {
            for (var i = 0; i < touches.length; i++) {
                var diffY = touches[i].clientY - self.rect.y + self.resizingBtnHeight / 4; // divided by 4 -> because my resize button has "transform: translate3D(25%, 25%, 0)"; which make it go out of the parent element.
                self.elementToResize.style.height = diffY + 'px';
            }
        }
    }

    function end () {
        self.resizing = false;
        window.removeEventListener('touchmove', resize);
    }

};
new Resize(terminal.terminalElt, document.getElementsByClassName('terminal-resize')[0]);
new ResizeMobile(terminal.terminalElt, document.getElementsByClassName('terminal-resize')[0]);