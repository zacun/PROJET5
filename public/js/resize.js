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
    window.addEventListener('mousemove', resize);
    window.addEventListener('mouseup', end);


    function begin () {
        self.resizing = true;
        self.rect = self.elementToResize.getBoundingClientRect();
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
    }
    
};
Resize(document.querySelector('#terminal'), document.querySelector('.terminal-resize'));