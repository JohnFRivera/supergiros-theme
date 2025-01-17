let paged = Obj_Post_Type.paged ? Obj_Post_Type.paged : 1;
let countPageLinks = 0;
const divPaginator = document.getElementById('paginator');

const innerPageLinks = () => {
  var pageLinks = ``;
  for (let i = 0; i < countPageLinks; i++) {
    var page = i + 1;
    var active = page === paged ? ' active' : '';
    pageLinks += `
    <li class="page-item">
        <button class="page-link${active}" type="button" data-value="${page}">
            ${page}
        </button>
    </li>
    `;
  }
  return pageLinks;
};
const handlePageLinks = (e) => {
  const countItems = document
    .getElementById('nav-paginator')
    .getAttribute('data-count');
  var dataValue = e.target.closest('button').getAttribute('data-value');
  var hash = parseInt(window.location.hash.substring(1));
  var paged = hash ? hash : 1;
  switch (dataValue) {
    case 'prev':
      e.preventDefault();
      if (paged > 1) {
        paged--;
      }
      break;
    case 'next':
      e.preventDefault();
      if (paged < countItems) {
        paged++;
      }
      break;
    default:
      paged = parseInt(dataValue);
      break;
  }
  if (hash !== paged) {
    window.location.hash = paged;
    setPageActive(paged);
  }
};
const generatePaginator = () => {
  countPageLinks = Math.ceil(postsFound / postsPerPage);
  if (countPageLinks > 1) {
    divPaginator.innerHTML = `
    <div class="col">
        <nav class="d-flex justify-content-center" id="nav-paginator" aria-label="Page navigation" data-count="${countPageLinks}">
            <ul class="pagination gap-1 mb-0">
                <li class="page-item">
                    <button class="page-link" type="button" data-value="prev">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </li>
                ${innerPageLinks(countPageLinks)}
                <li class="page-item">
                    <button class="page-link" type="button" data-value="next">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
    `;
    const pageLinks = document.querySelectorAll('.page-link');
    pageLinks.forEach((link) => {
      link.addEventListener('click', handlePageLinks);
    });
  }
};
