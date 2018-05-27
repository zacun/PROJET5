var search = {
    init: function () {
        this.articles = Array.from(document.getElementsByClassName('blog-post'));
        this.searchBar = document.getElementById('searchbar');
        this.searchBar.addEventListener('keyup', this.search);
    },

    search: function () {
        var searchValue = search.searchBar.value.toLowerCase();
        search.articles.forEach(function (article) {
            var value = article.childNodes[1].textContent.toLowerCase();
            if (value.indexOf(searchValue) === -1) {
                article.classList.add('off');
            } else {
                article.classList.remove('off');
            }
        });
    }

};
search.init();