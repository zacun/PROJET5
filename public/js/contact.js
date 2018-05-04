var contact = {

    init: function () {
        this.contactShow = document.querySelector('.contact-show');
        this.contactShowMessage = document.querySelector('.contact-show-message');
        this.contactForm = document.querySelector('.contact-form');
        this.contactShow.addEventListener('click', this.openAndClose);
    },

    openAndClose: function () {
        if (contact.contactForm.classList.contains('off')) {
            contact.contactForm.classList.remove('off');
            contact.contactForm.classList.add('on');
            contact.contactShowMessage.innerHTML = '- Masquer';
        } else  {
            contact.contactForm.classList.remove('on');
            contact.contactForm.classList.add('off');
            contact.contactShowMessage.innerHTML = '+ Afficher';
        }
    }

};
contact.init();