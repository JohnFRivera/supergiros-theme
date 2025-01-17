let term = document.getElementById('term').value;
let frmSearcher = document.getElementById('frm-searcher');
let ipSearcher = document.getElementById('ip-searcher');
let slOrder = document.getElementById('sl-order');
let rowPosts = document.getElementById('row-posts');
let placeholder = `
<div class="col">
    <div class="rounded-1 border p-3" style="height: 244.688px;">
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
const fillPosts = (data) => {
  rowPosts.innerHTML = '';
  data.forEach((item) => {
    rowPosts.innerHTML += `
      <article class="col" id="noticia-${item.id}">
          <div class="position-relative post-translate shadow-sm bg-body rounded-1 p-3">
              <div class="w-100 ratio ratio-16x9 mb-2">
                  <img class="object-fit-cover rounded-1 border" src="${item.thumbnail}" alt="Miniatura de ${item.title}">
              </div>
              <h6 class="mb-1">${item.title}</h6>
              <small class="text-black-50">${item.date}</small>
              <a class="stretched-link" href="${item.link}"></a>
          </div>
      </article>
      `;
  });
};
const getPosts = async (body) => {
  try {
    rowPosts.innerHTML = placeholder;
    var data = await postData('posts', body);
    if (!data.message) {
      fillPosts(data);
    } else {
      rowPosts.innerHTML = `
        <div class="w-100 align-content-center" style="height: 244.688px;">
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
