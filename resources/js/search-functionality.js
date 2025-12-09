document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    const searchIcon = document.querySelector('.ri-search-line');

    searchIcon.addEventListener('click', () => {
        searchInput.classList.remove('w-0');
        searchInput.classList.add('w-64');
        searchInput.focus();
    });

    searchInput.addEventListener('blur', function() {
        if (!this.value) {
            searchInput.classList.remove('w-64');
            searchInput.classList.add('w-0');
        }
    });
});
