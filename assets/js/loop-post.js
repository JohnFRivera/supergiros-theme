const ENDPOINT = HOSTNAME + '/post/posts/';
const TERM = document.getElementById('ip-term').value;
const TAG = document.getElementById('ip-tag').value;
const divLoop = document.getElementById('loop-posts');
const Placeholder = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 249.5px;">
        <div class="w-100 ratio ratio-16x9 mb-2">
            <svg class="bd-placeholder-img rounded-1" width="100%" height="157.5" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
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
const fillPosts = (posts) => {
  divLoop.innerHTML = '';
  posts.forEach((post) => {
    divLoop.innerHTML += `
        <article class="col" id="noticia-${post.id}">
            <div class="position-relative shadow-sm bg-body rounded-1 p-3">
                <div class="w-100 ratio ratio-16x9 mb-2">
                    <img class="object-fit-cover rounded-1 border" src="${post.thumbnail_url}" alt="Miniatura de ${post.title}" />
                </div>
                <h5 class="mb-1">${post.title}</h5>
                <p class="text-dark text-opacity-50 mb-0">${post.date}</p>
                <a class="stretched-link" href="${post.url}"></a>
            </div>
        </article>
        `;
  });
};

// Eventos
const handleLoad = async () => {
  getPosts({
    term: TERM,
    tag: TAG,
  });
};
document.addEventListener('DOMContentLoaded', handleLoad);
