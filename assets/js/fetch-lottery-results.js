const ENDPOINT_LOTTERY_RESULTS = HOSTNAME + '/sorteos/resultados/';
const ipLotteryResultsDate = document.getElementById('ip-lottery-results-date');
ipLotteryResultsDate.max = new Date().toISOString().split('T')[0];
const divLotteryResults = document.getElementById('loop-lottery-results');

// Funciones
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
const fillLotteryResults = (results) => {
  if (results.length > 0) {
    divLotteryResults.innerHTML = '';
    results.forEach((result) => {
      divLotteryResults.innerHTML += `
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
  } else {
    divLotteryResults.innerHTML = `
    <div class="w-100 d-flex align-items-center justify-content-center" style="height: 405px;">
      <i class="bi bi-info-circle-fill fs-4"></i>
      <span class="fw-medium fs-4">No hay resultados aún</span>
    </div>`;
  }
};
const getLotteryResults = async (body = {}) => {
  divLotteryResults.innerHTML = `
  <div class="w-100 d-flex align-items-center justify-content-center" style="height: 405px;">
      <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Cargando...</span>
      </div>
  </div>
  `;
  try {
    const lotteryResults = await postData(ENDPOINT_LOTTERY_RESULTS, body);
    fillLotteryResults(lotteryResults.resultados);
  } catch (error) {
    innerError(error, divLotteryResults);
  }
};

// Eventos
const handleLoadLotteryResults = async () => {
  getLotteryResults();
};
const handleChangeLotteryResultsDate = async (e) => {
  const date = dateFormat(e.target.value);
  await getLotteryResults({ fecha: date });
};
document.addEventListener('DOMContentLoaded', handleLoadLotteryResults);
ipLotteryResultsDate.addEventListener('change', handleChangeLotteryResultsDate);
