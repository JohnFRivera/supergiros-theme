const ENDPOINT_LAST_NEWS = HOSTNAME + '/noticias/posts/';
const termsNews = document.querySelectorAll('button.categoria-noticias');
const divLastNews = document.getElementById('loop-last-news');

// Funciones
const setActiveTermsNews = (navActive) => {
  termsNews.forEach((navLink) => {
    navLink.classList.remove('active');
    if (navLink.id === navActive) {
      navLink.classList.add('active');
    }
  });
};
const fillLastNews = (posts) => {
  divLastNews.innerHTML = '';
  posts.forEach((post) => {
    divLastNews.innerHTML += `
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
const getLastNews = async (body) => {
  divLastNews.innerHTML = `
  <div class="col">
      <div class="rounded-1 border p-3" style="height: 249.5px;">
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
  try {
    const data = await postData(ENDPOINT_LAST_NEWS, body);
    if (data.posts) {
      fillLastNews(data.posts);
    } else {
      divLastNews.innerHTML = `
      <div class="w-100 d-flex flex-column align-items-center justify-content-center text-black-50" style="height: ${divLastNews.clientHeight}px;">
          <i class="bi bi-info-circle fs-5"></i>
          <h5 class="fw-normal">${data.message}</h5>
      </div>
      `;
    }
  } catch (error) {
    innerError(error, divLastNews);
  }
};

// Eventos
const handleLoadLastNews = async () => {
  setActiveTermsNews(termsNews.item(0).id);
  getLastNews({
    posts_per_page: 8,
    term: termsNews.item(0).id,
  });
};
const handleClickTermsNews = async (e) => {
  setActiveTermsNews(e.target.id);
  await getLastNews({
    posts_per_page: 8,
    term: e.target.id,
  });
};
document.addEventListener('DOMContentLoaded', handleLoadLastNews);
termsNews.forEach((navLink) => {
  navLink.addEventListener('click', handleClickTermsNews);
});
