let planesData = getLocalStorage('planes-de-premios');
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
    let postsCount = planesData ? planesData.postsCount : 1;
    rowLoterias.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowLoterias.innerHTML += placeholder;
    }
    var data = await postData('planes-de-premios', body);
    if (!data.message) {
      planesData.postsCount = data.length;
      setLocalStorage('planes-de-premios', planesData);
      fillPosts(data);
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
// Eventos
document.addEventListener('DOMContentLoaded', () => {
  getPosts({});
});
