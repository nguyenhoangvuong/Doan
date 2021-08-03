// hamburger
const hamburger = document.querySelector('.header__menu-icon')
const navList = document.querySelector('.navigation')

hamburger.addEventListener('click',()=>{
    navList.classList.toggle('open')
})