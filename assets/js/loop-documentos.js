const ENDPOINT = HOSTNAME + '/documentos/posts/';
const TERM = document.getElementById('ip-term').value;
const frmSearcher = document.getElementById('frm-searcher');
const ipSearcher = document.getElementById('ip-searcher');
const slOrder = document.getElementById('sl-order');
const divLoop = document.getElementById('loop-documentos');
const Placeholder = `
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
const fillPosts = (posts) => {
  divLoop.innerHTML = '';
  posts.forEach((post) => {
    divLoop.innerHTML += `
      <article class="col" id="documento-${post.id}">
          <div class="h-100 position-relative shadow-sm bg-body rounded-1 p-3">
              <div class="vratio vratio-3x4 mb-2">
                  <img class="object-fit-cover rounded-1 border" src="${post.thumbnail_url}" alt="Portada de ${post.title}">
              </div>
              <h6 class="mb-1">${post.title}</h6>
              <small class="opacity-50">${post.date}</small>
              <a class="stretched-link" href="${post.pdf_url}" target="__Blank"></a>
          </div>
      </article>
      `;
  });
};

// Eventos
const handleLoad = async () => {
  getPosts({
    term: TERM,
  });
};
const handleSearch = async (e) => {
  e.preventDefault();
  await getPosts({
    term: TERM,
    search: ipSearcher.value,
  });
};
const handleRestart = async (e) => {
  if (e.data === undefined || (e.data === null && ipSearcher.value === '')) {
    await getPosts({
      term: TERM,
    });
  }
};
const handleOrder = async (e) => {
  await getPosts({
    term: TERM,
    order: e.target.value,
  });
};
document.addEventListener('DOMContentLoaded', handleLoad);
frmSearcher.addEventListener('submit', handleSearch);
ipSearcher.addEventListener('input', handleRestart);
slOrder.addEventListener('change', handleOrder);
