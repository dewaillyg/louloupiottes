function isClickHandler(isClick, headerResponsiveNavbar, headerResponsiveButton) {
    if (isClick) {
        document.querySelector('body').style.overflow = 'hidden'
        headerResponsiveNavbar[0].classList.add('active');
        headerResponsiveButton[0].classList.add('active');
        setTimeout(function () {
            headerResponsiveButton[0].classList.add('active_span');
        }, 100);
    } else {
        document.querySelector('body').style.overflow = 'visible';
        headerResponsiveButton[0].classList.remove('active_span');
        setTimeout(function () {
            headerResponsiveNavbar[0].classList.remove('active');
            headerResponsiveButton[0].classList.remove('active');
        }, 100);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const headerResponsiveNavbar = document.getElementsByClassName('header__responsive');
    const headerResponsiveButton = document.getElementsByClassName('header__hamburger');
    let isClick = false;

    headerResponsiveButton[0].addEventListener('click', function () {
        isClick = !isClick;
        isClickHandler(isClick, headerResponsiveNavbar, headerResponsiveButton);
    });
    
    // header__errors
    const errors = document.getElementsByClassName('header__errors');
    
    if (errors.length > 0) {
        isClick = !isClick;
        isClickHandler(isClick, headerResponsiveNavbar, headerResponsiveButton);
        const headerLogin = document.getElementsByClassName('header__login');
        headerLogin[0].appendChild(errors[0]);
        
    }

});

