const header = document.getElementsByClassName('louloupiottes__header');
const sidebar = document.getElementsByClassName('sidebar-social');

let lastScroll = 0;

window.addEventListener('scroll', function() {
    let currentScroll = window.scrollY;
    if (currentScroll > lastScroll) {
        header[0].classList.add('hidden');
        sidebar[0].classList.add('hidden');
    } else {
        header[0].classList.remove('hidden');
        sidebar[0].classList.remove('hidden');
    }

    lastScroll = currentScroll;
    
});