// hamburger
const hamburger = document.querySelector('.header__menu-icon')
const navList = document.querySelector('.navigation')

hamburger.addEventListener('click',()=>{
    navList.classList.toggle('open')
})
const hamburger1 = document.querySelector('.header__menu-icon-close')
hamburger1.addEventListener('click',()=>{
    navList.classList.toggle('open')
})


const partinopen = document.querySelector('.header__overview-icon')
const partin = document.querySelector('.partin')

partinopen.addEventListener('click',()=>{
    partin.classList.toggle('open');
})
const partinclose = document.querySelector('.partin__header-icon')
partinclose.addEventListener('click',()=>{
    partin.classList.toggle('open')
})

