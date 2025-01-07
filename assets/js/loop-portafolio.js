const ENDPOINT = HOSTNAME + '/portafolio/posts/';
const divLoop = document.getElementById('loop-portafolio');
const Placeholder = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 336px;">
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
          <span class="placeholder rounded-1 col-4"></span>
        </p>
        <div class="d-flex justify-content-center">
            <a class="btn btn-primary rounded-1 disabled placeholder col-4" aria-disabled="true"></a>
        </div>
    </div>
</div>
`;

// Funciones
const fillPosts = (posts) => {
  divLoop.innerHTML = '';
  posts.forEach((post) => {
    divLoop.innerHTML += `
      <div class="col" id="portafolio-${post.id}">
          <div class="h-100 d-flex flex-column justify-content-between shadow-sm bg-body rounded-1 p-3">
              <div class="w-25 ratio ratio-1x1 bg-body-tertiary rounded-circle mx-auto mb-2">
                  <img class="object-fit-cover rounded-circle p-2" src="${post.thumbnail_url}" alt="Logo de ${post.title}">
              </div>
              <h5 class="text-center mb-1">${post.title}</h5>
              <p class="opacity-50 text-center mb-3">${post.excerpt}</p>
              <div class="d-flex justify-content-center">
                  <a class="btn btn-primary rounded-1 px-3" href="${post.url}">Ver más</a>
              </div>
          </div>
      </div>
      `;
  });
};

// Eventos
const handleLoad = async () => {
  await getPosts({});
};
const handlePaged = async (e) => {
  var paged = parseInt(e.target.location.hash.substring(1));
  getPosts({ paged });
};
document.addEventListener('DOMContentLoaded', handleLoad);
window.addEventListener('hashchange', handlePaged);
