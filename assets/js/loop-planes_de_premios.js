const ENDPOINT = HOSTNAME + '/loterias/planes-de-premios/posts/';
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
const fillPosts = (posts) => {
  divLoop.innerHTML = '';
  posts.forEach((post) => {
    divLoop.innerHTML += `
      <div class="col" id="loteria-${post.id}">
          <div class="h-100 d-flex flex-column justify-content-between shadow-sm bg-body rounded-1 p-3">
              <div class="w-50 ratio ratio-1x1 mx-auto mb-2">
                  <img class="object-fit-cover rounded-circle" src="${post.thumbnail_url}" alt="Logo de ${post.title}">
              </div>
              <h5 class="text-center mb-0">${post.title}</h5>
              <p class="text-black-50 text-center mb-3">${post.date}</p>
              <div class="d-flex justify-content-center">
                  <a class="btn btn-primary rounded-1 px-3" href="${post.url}">Premios</a>
              </div>
          </div>
      </div>
      `;
  });
};

// Eventos
const handleLoad = async () => {
  getPosts({});
};
document.addEventListener('DOMContentLoaded', handleLoad);
