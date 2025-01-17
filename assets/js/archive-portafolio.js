let portafolioData = getLocalStorage('portafolio');
let rowPortafolio = document.getElementById('row-portafolio');
let placeholder = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 408px;">
        <div class="w-25 ratio ratio-1x1 mx-auto mb-2">
            <svg class="bd-placeholder-img rounded-circle" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
        </div>
        <h5 class="placeholder-glow text-center mb-1">
          <span class="placeholder rounded-1 col-4"></span>
        </h5>
        <p class="placeholder-glow text-center mb-3">
          <span class="placeholder rounded-1 col-7"></span>
          <span class="placeholder rounded-1 col-4"></span>
          <span class="placeholder rounded-1 col-8"></span>
          <span class="placeholder rounded-1 col-5"></span>
          <span class="placeholder rounded-1 col-6"></span>
          <span class="placeholder rounded-1 col-5"></span>
          <span class="placeholder rounded-1 col-5"></span>
          <span class="placeholder rounded-1 col-4"></span>
          <span class="placeholder rounded-1 col-5"></span>
          <span class="placeholder rounded-1 col-3"></span>
          <span class="placeholder rounded-1 col-6"></span>
          <span class="placeholder rounded-1 col-7"></span>
          <span class="placeholder rounded-1 col-3"></span>
          <span class="placeholder rounded-1 col-4"></span>
          <span class="placeholder rounded-1 col-7"></span>
          <span class="placeholder rounded-1 col-4"></span>
        </p>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary rounded-1 disabled placeholder col-4" aria-disabled="true"></a>
        </div>
    </div>
</div>
`;
// Funciones
const fillPosts = (data) => {
  rowPortafolio.innerHTML = '';
  data.forEach((item) => {
    rowPortafolio.innerHTML += `
    <article class="col" id="portafolio-${item.id}">
        <div class="h-100 d-flex flex-column justify-content-between shadow-sm bg-body rounded-1 p-3">
            <div class="w-25 ratio ratio-1x1 bg-body-tertiary rounded-circle mx-auto mb-2">
                <img class="object-fit-cover rounded-circle p-2" src="${item.logo}" alt="Logo de ${item.title}">
            </div>
            <h5 class="text-center mb-1">${item.title}</h5>
            <p class="opacity-50 text-center mb-3">${item.excerpt}</p>
            <div class="d-flex justify-content-center">
                <a class="btn btn-primary rounded-1 px-3" href="${item.link}">Ver más</a>
            </div>
        </div>
    </article>
    `;
  });
};
const getPosts = async (body) => {
  try {
    let postsCount = portafolioData ? portafolioData.postsCount : 1;
    rowPortafolio.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowPortafolio.innerHTML += placeholder;
    }
    var data = await postData('portafolio', body);
    if (!data.message) {
      portafolioData.postsCount = data.length;
      setLocalStorage('portafolio', portafolioData);
      fillPosts(data);
    } else {
      rowPortafolio.innerHTML = `
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
