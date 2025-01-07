const ENDPOINT = HOSTNAME + '/loterias/resultados-y-secos/posts/';
const ENDPOINT_FILTER = HOSTNAME + '/loterias/resultados-y-secos/filter/';
const spanCounter = document.getElementById('span-counter');
const slLoteria = document.getElementById('sl-loteria');
const slYear = document.getElementById('sl-year');
const slMonth = document.getElementById('sl-month');
const slDay = document.getElementById('sl-day');
const divLoop = document.getElementById('loop-container');
const Placeholder = `
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
const clearSelect = (select) => {
  while (select.children.length > 1) {
    select.removeChild(select.lastElementChild);
  }
};
const addSelect = (select, value = '', text = '') => {
  select.innerHTML += `<option value="${value}">${text}</option>`;
};
const toggleSelects = () => {
  slLoteria.disabled = !slLoteria.disabled;
  slYear.disabled = !slYear.disabled;
  slMonth.disabled = !slMonth.disabled;
  slDay.disabled = !slDay.disabled;
};
const validSelect = (value = '', select) => {
  if (value === '') {
    select.classList.add('d-none');
    clearSelect(select);
  } else {
    select.classList.remove('d-none');
  }
};
const getYears = async () => {
  toggleSelects();
  clearSelect(slYear);
  clearSelect(slMonth);
  clearSelect(slDay);
  const data = await postData(ENDPOINT_FILTER, {
    loteria: slLoteria.value,
  });
  data.array.forEach((year) => {
    addSelect(slYear, year, year);
  });
  toggleSelects();
};
const getMonths = async () => {
  if (slYear.value !== '') {
    toggleSelects();
    clearSelect(slMonth);
    clearSelect(slDay);
    const data = await postData(ENDPOINT_FILTER, {
      loteria: slLoteria.value,
      year: slYear.value,
    });
    data.array.forEach((month) => {
      addSelect(slMonth, month.value, month.text);
    });
    toggleSelects();
  }
};
const getDays = async () => {
  if (slMonth.value !== '') {
    toggleSelects();
    clearSelect(slDay);
    const data = await postData(ENDPOINT_FILTER, {
      year: slYear.value,
      month: slMonth.value,
    });
    data.array.forEach((day) => {
      addSelect(slDay, day, day);
    });
    toggleSelects();
  }
};

const fillPosts = (posts) => {
  divLoop.innerHTML = '';
  posts.forEach((post) => {
    divLoop.innerHTML += `
      <article class="col" id="loteria-${post.id}">
          <div class="h-100 d-flex flex-column justify-content-between shadow-sm bg-body rounded-1 p-3">
              <div class="w-50 ratio ratio-1x1 mx-auto mb-2">
                  <img class="object-fit-cover rounded-circle" src="${post.thumbnail_url}" alt="Logo de ${post.title}">
              </div>
              <h5 class="text-center mb-0">${post.title}</h5>
              <p class="text-black-50 text-center mb-3">${post.date}</p>
              <div class="d-flex justify-content-center">
                  <a class="btn btn-primary rounded-1 px-3" href="${post.url}">Resultado</a>
              </div>
          </div>
      </article>
      `;
  });
};

// Eventos
const handleLoad = async () => {
  getYears();
  getPosts({});
};
const handleLoteria = async (e) => {
  validSelect('', slMonth);
  validSelect('', slDay);
  await getYears();
  await getPosts({
    loteria: slLoteria.value,
  });
};
const handleYear = async (e) => {
  validSelect(slYear.value, slMonth);
  validSelect('', slDay);
  await getMonths();
  await getPosts({
    loteria: slLoteria.value,
    year: slYear.value,
  });
};
const handleMonth = async (e) => {
  validSelect(slMonth.value, slDay);
  await getDays();
  await getPosts({
    loteria: slLoteria.value,
    year: slYear.value,
    month: slMonth.value,
  });
};
const handleDay = async (e) => {
  await getPosts({
    loteria: slLoteria.value,
    year: slYear.value,
    month: slMonth.value,
    day: slDay.value,
  });
};
document.addEventListener('DOMContentLoaded', handleLoad);
slLoteria.addEventListener('change', handleLoteria);
slYear.addEventListener('change', handleYear);
slMonth.addEventListener('change', handleMonth);
slDay.addEventListener('change', handleDay);
