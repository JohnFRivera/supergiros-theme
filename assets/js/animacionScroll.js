const btnScrollTop = document.getElementById('btnScrollTop');
const btnScrollNoticias = document.getElementById('btnScrollNoticias');
const btnScrollSecos = document.getElementById('btnScrollSecos');
const btnScrollSorteos = document.getElementById('btnScrollSorteos');
const btnScrollChance = document.getElementById('btnScrollChance');

const scrollAnimation = (top = 0) => {
  window.scrollTo({
    top,
    behavior: 'smooth',
  });
};

btnScrollTop.addEventListener('click', () => {
  scrollAnimation(0);
});
btnScrollNoticias.addEventListener('click', () => {
  scrollAnimation(790);
});
btnScrollSecos.addEventListener('click', () => {
  scrollAnimation(1629);
});
btnScrollSorteos.addEventListener('click', () => {
  scrollAnimation(2470);
});
btnScrollChance.addEventListener('click', () => {
  scrollAnimation(3312);
});
