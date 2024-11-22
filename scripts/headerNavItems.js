document.addEventListener('DOMContentLoaded', function() { 
    const headerNavitems = document.querySelectorAll('.louloupiottes__header #menu-menu-principal li');
    const headerNavitemsResponsive = document.querySelectorAll('.header__responsive .top__right li');
    

    const url = window.location.href;
    const urlParts = url.split('/');
    const currentPages = urlParts[urlParts.length - 2];
    const pages = ['boutique', 'contact', 'articles'];
    let pagesCheck = false;

    for (let i = 0; i < pages.length; i++) {
        if (currentPages == pages[i]) {
            for (let j = 0; j < headerNavitems.length; j++) {
                if (!pagesCheck && pages[i] == headerNavitems[j].textContent.toLowerCase()) {
                    headerNavitems[j].classList.add('active');
                    headerNavitemsResponsive[j].classList.add('active');
                    pagesCheck = !pagesCheck;
                }
            }
        }
    }

    if (!pagesCheck) {
        for (let j = 0; j < headerNavitems.length; j++) {
            if (!pagesCheck && 'accueil' == headerNavitems[j].textContent.toLowerCase()) {
                headerNavitems[j].classList.add('active');
                headerNavitemsResponsive[j].classList.add('active');
                pagesCheck = !pagesCheck;
            }
        }
    }
    
});