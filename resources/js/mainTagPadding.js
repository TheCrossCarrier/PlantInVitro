// Отступ сверху основной части (<main>) (равен фактической высоте "шапки")
document.querySelector('.main').style.paddingTop =
  document.querySelector('.header').getBoundingClientRect().height + 'px'
