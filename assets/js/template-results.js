let resultadosData = getLocalStorage('resultados');
const titleResults = document.getElementById('title-results');
const ipDate = document.getElementById('ip-date');
const rowResults = document.getElementById('row-results');
const placeholder = `
<div class="col" style="height: 155.578px;">
    <div class="border border-bottom-0 rounded-top-1 p-3">
        <h3 class="placeholder-glow text-center mb-3">
            <span class="placeholder rounded-1 col-6"></span>
        </h3>
        <h6 class="placeholder-glow text-center mb-0">
            <span class="placeholder rounded-1 col-10"></span>
            <span class="placeholder rounded-1 col-5"></span>
        </h6>
    </div>
    <div class="border rounded-bottom-1 p-1">
        <p class="placeholder-glow text-center mb-0">
            <span class="placeholder rounded-1 col-8"></span>
        </p>
    </div>
</div>
`;

// Funciones
const titleFormat = (date) => {
  const months = [
    'Enero',
    'Febrero',
    'Marzo',
    'Abril',
    'Mayo',
    'Junio',
    'Julio',
    'Agosto',
    'Septiembre',
    'Octubre',
    'Noviembre',
    'Diciembre',
  ];
  const arrDate = date.split('-');
  return `Resultados del ${arrDate[2]} de ${
    months[parseInt(arrDate[1]) - 1]
  }, ${arrDate[0]}`;
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
const fillResultados = (results) => {
  rowResults.innerHTML = '';
  results.forEach((result) => {
    rowResults.innerHTML += `
    <div class="col post-translate">
        <div class="shadow-sm bg-white rounded-top-1 p-3">
            <h2 class="text-primary text-center fw-bold mb-3">${
              result.number
            }</h2>
            <div class="d-flex flex-column align-items-center justify-content-center" style="height: 40.188px;">
                <h6 class="text-center mb-0">${result.lottery.display_name}</h6>
                ${
                  result.zodiac_sign
                    ? `<small class="text-black-50 text-uppercase mb-0">${result.zodiac_sign}</small>`
                    : ''
                }
            </div>
        </div>
        <div class="shadow-sm bg-primary rounded-bottom-1 p-1">
            <small class="d-flex justify-content-center text-white">
                ${result.played_at}
            </small>
        </div>
    </div>
    `;
  });
};
const getResults = async (body) => {
  try {
    console.log(resultadosData);
    let postsCount = resultadosData ? resultadosData.postsCount : 1;
    rowResults.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowResults.innerHTML += placeholder;
    }
    var data = await postData('resultados-sorteos', body);
    if (data.resultados.length > 0) {
      if (resultadosData) {
        resultadosData.postsCount = data.resultados.length;
      } else {
        resultadosData = { postsCount: data.resultados.length };
      }
      setLocalStorage('resultados', resultadosData);
      fillResultados(data.resultados);
    } else {
      rowResults.innerHTML = `
        <div class="w-100 d-flex align-items-center justify-content-center" style="height: 405px;">
          <i class="bi bi-info-circle-fill fs-4"></i>
          <span class="fw-medium fs-4">No hay resultados aún</span>
        </div>`;
    }
  } catch (error) {
    innerError(error, rowResults);
  }
};

// Eventos
document.addEventListener('DOMContentLoaded', async () => {
  ipDate.max = new Date().toISOString().split('T')[0];
  await getResults({});
});
ipDate.addEventListener('change', async (e) => {
  titleResults.innerText = titleFormat(e.target.value);
  var fecha = dateFormat(e.target.value);
  await getResults({ fecha });
});
