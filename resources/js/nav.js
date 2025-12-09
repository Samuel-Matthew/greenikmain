// Mobile menu toggle
(function(){
    const btn = document.getElementById('mobile-menu-button');
    const menu = document.getElementById('mobile-menu');
    if (!btn || !menu) return;

    btn.addEventListener('click', function(e){
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!expanded));
        menu.classList.toggle('hidden');
    });

    // Close menu when a link is clicked
    menu.querySelectorAll('a').forEach(function(a){
        a.addEventListener('click', function(){
            menu.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
        });
    });

    // Close on outside click (only when menu open)
    document.addEventListener('click', function(e){
        if (!menu.contains(e.target) && !btn.contains(e.target)){
            menu.classList.add('hidden');
            btn.setAttribute('aria-expanded', 'false');
        }
    });
})();
