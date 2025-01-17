let resultadosData = getLocalStorage('resultados-y-secos');
let slLottery = document.getElementById('sl-lottery');
let slYear = document.getElementById('sl-year');
let slMonth = document.getElementById('sl-month');
let slDay = document.getElementById('sl-day');
let rowLoterias = document.getElementById('row-loterias');
let placeholder = `
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
// Funciones
const fillPosts = (data) => {
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
const getPosts = async (body) => {
  try {
    let postsCount = resultadosData ? resultadosData.postsCount : 1;
    rowLoterias.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowLoterias.innerHTML += placeholder;
    }
    var data = await postData('resultados-y-secos', body);
    if (!data.message) {
      resultadosData.postsCount = data.results.length;
      setLocalStorage('resultados-y-secos', resultadosData);
      fillPosts(data.results);
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
const fillYear = (data) => {
  slYear.innerHTML = '<option value="">Todos los años</option>';
  data.forEach((item) => {
    slYear.innerHTML += `<option value="${item}">${item}</option>`;
  });
};
const fillMonth = (data) => {
  slMonth.innerHTML = '<option value="">Todos los meses</option>';
  data.forEach((item) => {
    slMonth.innerHTML += `<option value="${item.value}">${item.text}</option>`;
  });
};
const fillDay = (data) => {
  slDay.innerHTML = '<option value="">Todos los días</option>';
  data.forEach((item) => {
    slDay.innerHTML += `<option value="${item}">${item}</option>`;
  });
};
// Eventos
document.addEventListener('DOMContentLoaded', async () => {
  var data = await getPosts();
  fillYear(data.year);
});
slLottery.addEventListener('change', async (e) => {
  slYear.value = '';
  if (!slMonth.classList.contains('d-none')) {
    slMonth.classList.add('d-none');
    slMonth.value = '';
  }
  if (!slDay.classList.contains('d-none')) {
    slDay.classList.add('d-none');
    slDay.value = '';
  }
  var data = await getPosts({
    term: slLottery.value,
  });
  fillYear(data.year);
});
slYear.addEventListener('change', async (e) => {
  if (e.target.value) {
    slMonth.classList.remove('d-none');
  } else {
    slMonth.classList.add('d-none');
    slMonth.value = '';
    if (!slDay.classList.contains('d-none')) {
      slDay.classList.add('d-none');
      slDay.value = '';
    }
  }
  var data = await getPosts({
    term: slLottery.value,
    year: slYear.value,
  });
  fillMonth(data.month);
});
slMonth.addEventListener('change', async (e) => {
  if (e.target.value) {
    slDay.classList.remove('d-none');
  } else {
    slDay.classList.add('d-none');
    slDay.value = '';
  }
  var data = await getPosts({
    term: slLottery.value,
    year: slYear.value,
    month: slMonth.value,
  });
  fillDay(data.day);
});
slDay.addEventListener('change', async (e) => {
  var data = await getPosts({
    term: slLottery.value,
    year: slYear.value,
    month: slMonth.value,
    day: slDay.value,
  });
});
