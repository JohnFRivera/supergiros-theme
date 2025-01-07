const ENDPOINT_LAST = HOSTNAME + '/noticias/last/';
const ENDPOINT = HOSTNAME + '/noticias/posts/';
const TERM = document.getElementById('ip-term').value;
const frmSearcher = document.getElementById('frm-searcher');
const ipSearcher = document.getElementById('ip-searcher');
const slOrder = document.getElementById('sl-order');
const divLast = document.getElementById('loop-ultima-noticia');
const divLoop = document.getElementById('loop-noticias');
const Placeholder = `
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

// Funciones
const fillLastPosts = (posts) => {
  divLast.innerHTML = '';
  posts.forEach((post) => {
    divLast.innerHTML += `
      <article class="col" id="ultima-noticia-${post.id}">
          <div class="position-relative shadow-sm bg-body rounded-1 p-3">
              <div class="w-100 ratio ratio-16x9 mb-2">
                  <img class="rounded-1 border" src="${post.thumbnail_url}" alt="Miniatura de ${post.title}">
              </div>
              <h5 class="mb-1">${post.title}</h5>
              <p class="text-black-50 mb-0">${post.date}</p>
              <a class="stretched-link" href="${post.url}"></a>
          </div>
      </article>
      `;
  });
};
const fillPosts = (posts) => {
  divLoop.innerHTML = '';
  posts.forEach((post) => {
    divLoop.innerHTML += `
      <article class="col" id="noticia-${post.id}">
          <div class="position-relative shadow-sm bg-body rounded-1 p-3">
              <div class="w-100 ratio ratio-16x9 mb-2">
                  <img class="rounded-1 border" src="${post.thumbnail_url}" alt="Miniatura de ${post.title}">
              </div>
              <h5 class="mb-1">${post.title}</h5>
              <small class="text-black-50">${post.date}</small>
              <a class="stretched-link" href="${post.url}"></a>
          </div>
      </article>
      `;
  });
};
const getLastPosts = async () => {
  divLast.innerHTML = `
  <div class="col">
      <div class="rounded-1 border p-3" style="height: 336.69px;">
          <div class="w-100 ratio ratio-16x9 mb-2">
              <svg class="bd-placeholder-img rounded-1" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#868e96"></rect>
              </svg>
          </div>
          <h5 class="placeholder-glow mb-1">
            <span class="placeholder rounded-1 col-8"></span>
          </h5>
          <p class="placeholder-glow mb-0">
            <span class="placeholder rounded-1 col-5"></span>
          </p>
      </div>
  </div>
  <div class="col">
      <div class="rounded-1 border p-3" style="height: 336.69px;">
          <div class="w-100 ratio ratio-16x9 mb-2">
              <svg class="bd-placeholder-img rounded-1" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
                <title>Placeholder</title>
                <rect width="100%" height="100%" fill="#868e96"></rect>
              </svg>
          </div>
          <h5 class="placeholder-glow mb-1">
            <span class="placeholder rounded-1 col-8"></span>
          </h5>
          <p class="placeholder-glow mb-0">
            <span class="placeholder rounded-1 col-5"></span>
          </p>
      </div>
  </div>
  `;
  const data = await postData(ENDPOINT_LAST, {});
  if (data.posts) {
    fillLastPosts(data.posts);
  } else {
    divLast.innerHTML = `
    <div class="w-100 d-flex align-items-center justify-content-center" style="height: ${archiveContainer.clientHeight}px;">
        <h5>${data.message}</h5>
    </div>
    `;
  }
};

// Eventos
const handleLoad = async () => {
  getLastPosts();
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
    order: slOrder.value,
  });
};
document.addEventListener('DOMContentLoaded', handleLoad);
frmSearcher.addEventListener('submit', handleSearch);
ipSearcher.addEventListener('input', handleRestart);
slOrder.addEventListener('change', handleOrder);
