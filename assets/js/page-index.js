let btnScrollTop = document.getElementById('btnScrollTop');
let btnScrollNoticias = document.getElementById('btnScrollNoticias');
let btnScrollSecos = document.getElementById('btnScrollSecos');
let btnScrollSorteos = document.getElementById('btnScrollSorteos');
let btnScrollChance = document.getElementById('btnScrollChance');

let noticiasData = getLocalStorage('noticias');
let noticiasLinks = document.querySelectorAll('.nav-noticias');
let rowNoticias = document.getElementById('row-noticias');
let placeholderNoticias = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 200.84px;">
        <div class="w-100 ratio ratio-16x9 mb-2">
            <svg class="bd-placeholder-img rounded-1" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
        </div>
        <h5 class="placeholder-glow mb-1">
            <span class="placeholder rounded-1 col-8"></span>
        </h5>
        <small class="placeholder-glow">
            <span class="placeholder rounded-1 col-5"></span>
        </small>
    </div>
</div>
`;
let loteriasData = getLocalStorage('resultados-y-secos');
let rowLoterias = document.getElementById('row-loterias');
let placeholderLoterias = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 249.19px;">
        <div class="w-50 ratio ratio-1x1 mx-auto mb-2">
            <svg class="bd-placeholder-img rounded-circle" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
        </div>
        <h5 class="placeholder-glow text-center mb-1">
          <span class="placeholder rounded-1 col-5"></span>
        </h5>
        <p class="placeholder-glow text-center mb-3">
          <span class="placeholder rounded-1 col-9"></span>
        </p>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary rounded-1 disabled placeholder col-6" aria-disabled="true"></a>
        </div>
    </div>
</div>
`;
let ipResultados = document.getElementById('ip-resultados');
let rowResultados = document.getElementById('row-resultados');
let spinnerResultados = `
<div class="w-100 d-flex align-items-center justify-content-center" style="height: 389px;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>
`;
// Funciones
const scrollAnimation = (top = 0) => {
  window.scrollTo({
    top,
    behavior: 'smooth',
  });
};

const activeLink = (hash) => {
  noticiasLinks.forEach((link) => {
    if (link.hash === hash) {
      link.classList.add('active');
    } else {
      link.classList.contains('active') && link.classList.remove('active');
    }
  });
};
const fillNoticias = (data) => {
  rowNoticias.innerHTML = '';
  data.forEach((item) => {
    rowNoticias.innerHTML += `
      <article class="col" id="noticia-${item.id}">
          <div class="position-relative post-translate shadow-sm bg-body rounded-1 p-3">
              <div class="w-100 ratio ratio-16x9 mb-2">
                  <img class="object-fit-cover rounded-1 border" src="${item.thumbnail}" alt="Miniatura de ${item.title}">
              </div>
              <h6 class="mb-1">${item.title}</h6>
              <small class="text-black-50">${item.date}</small>
              <a class="stretched-link" href="${item.link}"></a>
          </div>
      </article>
      `;
  });
};
const getNoticias = async (term) => {
  try {
    let postsCount = noticiasData ? noticiasData.postsCount : 1;
    rowNoticias.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowNoticias.innerHTML += placeholderNoticias;
    }
    var body;
    if (term === 'noticias') {
      body = {};
    } else {
      body = { term };
    }
    var data = await postData('noticias', body);
    if (!data.message) {
      noticiasData.postsCount = data.length;
      setLocalStorage('noticias', noticiasData);
      fillNoticias(data);
    } else {
      rowNoticias.innerHTML = `
        <div class="w-100 align-content-center" style="height: 447.56px;">
          <p class="text-black-50 text-center">${data.message}</p>
        </div>
        `;
    }
  } catch (error) {
    console.error(error);
  }
};

const fillLoterias = (data) => {
  rowLoterias.innerHTML = '';
  data.forEach((item) => {
    rowLoterias.innerHTML += `
      <article class="col" id="loteria-${item.id}">
          <div class="h-100 d-flex flex-column justify-content-between shadow-sm bg-body rounded-1 p-3">
              <div class="w-50 ratio ratio-1x1 mx-auto mb-2">
                  <img class="object-fit-cover rounded-circle" src="${item.logo}" alt="Logo de ${item.title}">
              </div>
              <h5 class="text-center mb-0">${item.title}</h5>
              <p class="text-black-50 text-center mb-3">${item.date}</p>
              <div class="d-flex justify-content-center">
                  <a class="btn btn-primary rounded-1 px-3" href="${item.link}">Premios</a>
              </div>
          </div>
      </article>
      `;
  });
};
const getLoterias = async () => {
  try {
    let postsCount = loteriasData ? loteriasData.postsCount : 1;
    rowLoterias.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowLoterias.innerHTML += placeholderLoterias;
    }
    var data = await postData('resultados-y-secos', {});
    if (!data.message) {
      loteriasData.postsCount = data.results.length;
      setLocalStorage('resultados-y-secos', loteriasData);
      fillLoterias(data.results);
      return data;
    } else {
      rowLoterias.innerHTML = `
        <div class="w-100 align-content-center" style="height: 200.84px;">
          <p class="text-black-50 text-center">${data.message}</p>
        </div>
        `;
    }
  } catch (error) {
    console.error(error);
  }
};

const dateFormat = (date) => {
  const arrDate = date.split('-');
  return `${arrDate[2]}/${arrDate[1]}/${arrDate[0]}`;
};
const hourFormat = (hour) => {
  let arrHour = hour.split(':');
  let horary = 'a.m.';
  if (arrHour[1] > 12) {
    arrHour[1] -= 12;
    horary = 'p.m.';
  }
  return `${arrHour[1]}:${arrHour[2]} ${horary}`;
};
const separarCifras = (numero) => {
  let result = ``;
  numero
    .toString()
    .split('')
    .forEach((cifra) => {
      result += `
        <span class="d-flex align-items-center justify-content-center bg-secondary rounded-circle" style="width: 32px; height: 32px;">
          <span class="d-flex align-items-center justify-content-center bg-body rounded-circle text-dark fw-bold" style="width: 18px; height: 18px;">
            ${cifra}
          </span>
        </span>
        `;
    });
  return result;
};
const fillResultados = (results) => {
  rowResultados.innerHTML = '';
  results.forEach((result) => {
    rowResultados.innerHTML += `
        <tr id="${result.lottery.name}">
            <td class="py-3 ps-4 align-content-center">
                <div class="d-flex align-items-center gap-2">
                  ${result.lottery.display_name}
                  ${
                    result.zodiac_sign
                      ? `<span class="badge bg-secondary rounded-1 text-dark text-uppercase">
                      ${result.zodiac_sign}                  
                    </span>`
                      : ''
                  }
                </div>
            </td>
            <td class="py-3 align-middle text-black-50">
                ${hourFormat(result.lottery.played_hour)}
            </td>
            <td class="py-3 pe-4">
                <div class="d-flex justify-content-end gap-1">
                    ${separarCifras(result.number)}
                </div>
            </td>
        </tr>
        `;
  });
};
const getResultados = async (body) => {
  rowResultados.innerHTML = spinnerResultados;
  try {
    var data = await postData('resultados-sorteos', body);
    if (data.resultados.length > 0) {
      fillResultados(data.resultados);
    } else {
      rowResultados.innerHTML = `
        <div class="w-100 d-flex align-items-center justify-content-center" style="height: 405px;">
          <i class="bi bi-info-circle-fill fs-4"></i>
          <span class="fw-medium fs-4">No hay resultados aún</span>
        </div>`;
    }
  } catch (error) {
    innerError(error, divLotteryResults);
  }
};
// Eventos
document.addEventListener('DOMContentLoaded', async () => {
  activeLink('#noticias');
  await getNoticias('');
  await getLoterias();
  ipResultados.max = new Date().toISOString().split('T')[0];
  await getResultados({});
});
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
noticiasLinks.forEach((link) => {
  link.addEventListener('click', async (e) => {
    var hash = e.target.hash;
    activeLink(hash);
    var term = hash.substring(1);
    await getNoticias(term);
  });
});
ipResultados.addEventListener('change', async (e) => {
  const date = dateFormat(e.target.value);
  await getResultados({ fecha: date });
});
