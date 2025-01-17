let documentosData = getLocalStorage('documentos');
let term = document.getElementById('term').value;
let rowDocumentos = document.getElementById('row-documentos');
let frmSearcher = document.getElementById('frm-searcher');
let ipSearcher = document.getElementById('ip-searcher');
let slOrder = document.getElementById('sl-order');
let placeholder = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 345.17px;">
        <div class="vratio vratio-3x4 mb-2">
            <svg class="bd-placeholder-img rounded-1" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
              <title>Placeholder</title>
              <rect width="100%" height="100%" fill="#868e96"></rect>
            </svg>
        </div>
        <h6 class="placeholder-glow mb-1">
          <span class="placeholder rounded-1 col-8"></span>
        </h6>
        <small class="placeholder-glow">
          <span class="placeholder rounded-1 col-5"></span>
        </small>
    </div>
</div>
`;
// Funciones
const fillPosts = (data) => {
  rowDocumentos.innerHTML = '';
  data.forEach((item) => {
    rowDocumentos.innerHTML += `
    <article class="col" id="documento-${item.id}">
        <div class="h-100 position-relative post-translate shadow-sm bg-body rounded-1 p-3">
            <div class="vratio vratio-3x4 mb-2">
                <img class="object-fit-cover rounded-1 border" src="${item.thumbnail}" alt="Portada de ${item.title}">
            </div>
            <h6 class="mb-1">${item.title}</h6>
            <small class="opacity-50">${item.date}</small>
            <a class="stretched-link" href="${item.link}" target="__Blank"></a>
        </div>
    </article>
    `;
  });
};
const getPosts = async (body) => {
  try {
    let postsCount = documentosData ? documentosData.postsCount : 1;
    rowDocumentos.innerHTML = '';
    for (var i = 0; i < postsCount; i++) {
      rowDocumentos.innerHTML += placeholder;
    }
    var data = await postData('documentos', body);
    if (!data.message) {
      documentosData.postsCount = data.length;
      setLocalStorage('documentos', documentosData);
      fillPosts(data);
    } else {
      rowDocumentos.innerHTML = `
      <div class="w-100 align-content-center" style="height: 345.17px;">
        <p class="text-black-50 text-center fs-5">${data.message}</p>
      </div>
      `;
    }
  } catch (error) {
    console.error(error);
  }
};
// Eventos
document.addEventListener('DOMContentLoaded', () => {
  getPosts({ term });
});
frmSearcher.addEventListener('submit', (e) => {
  e.preventDefault();
  var search = ipSearcher.value;
  getPosts({ term, search });
});
ipSearcher.addEventListener('input', (e) => {
  if (e.data === undefined || (e.data === null && ipSearcher.value === '')) {
    getPosts({ term });
  }
});
slOrder.addEventListener('change', (e) => {
  var order = e.target.value;
  getPosts({ term, order });
});
