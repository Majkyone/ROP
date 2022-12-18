const button = document.getElementsByClassName('button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

button.addEventListener('click', () => {
    navbarLinks.classList.toggle('active')
})