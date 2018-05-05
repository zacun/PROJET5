var comment = {

    init: function () {
        this.formShow = document.querySelector('.show-comment-form');
        this.form = document.querySelector('.comment-form');
        this.formShow.addEventListener('click', this.openAndClose);
    },

    openAndClose: function () {
        if (comment.form.classList.contains('off')) {
            comment.form.classList.remove('off');
            comment.form.classList.add('on');
            comment.formShow.innerHTML = "- Ajouter un commentaire";
        } else  {
            comment.form.classList.remove('on');
            comment.form.classList.add('off');
            comment.formShow.innerHTML = "+ Ajouter un commentaire";
        }
    }

};
comment.init();