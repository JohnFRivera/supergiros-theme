// FUNCTION
const getPosts = async (body) => {
  try {
    divLoop.innerHTML = Placeholder;
    const data = await postData(ENDPOINT, body);
    if (data.posts) {
      var postsFound = data.count;
      fillPosts(data.posts);
      generatePaginator(postsFound, 8);
    } else {
      divLoop.innerHTML = `
        <div class="w-100 d-flex flex-column align-items-center justify-content-center text-black-50" style="height: ${divLoop.clientHeight}px;">
            <i class="bi bi-info-circle fs-5"></i>
            <h5 class="fw-normal">${data.message}</h5>
        </div>
        `;
    }
  } catch (error) {
    innerError(error, divLoop);
  }
};

// PAGINATOR
const getPaged = () => {
  var windowHash = parseInt(window.location.hash.substring(1));
  return windowHash ? windowHash : 1;
};
const innerPageLinks = (countItems) => {
  var pageLinks = ``;
  for (let i = 0; i < countItems; i++) {
    var page = i + 1;
    var active = page === getPaged() ? ' active' : '';
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
const setPageActive = (paged) => {
  var pageLinks = document.querySelectorAll('.page-link');
  pageLinks.forEach((link) => {
    var dataValue = link.getAttribute('data-value');
    if (dataValue == paged) {
      link.classList.add('active');
    } else {
      link.classList.remove('active');
    }
  });
};
const handlePageLinks = (e) => {
  const countItems = document
    .getElementById('navPaginator')
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
const generatePaginator = (postsFound, postsPerPage) => {
  const divPaginator = document.getElementById('divPaginator');
  countItems = Math.ceil(postsFound / postsPerPage);
  if (countItems > 1) {
    divPaginator.innerHTML = `
    <div class="col">
        <nav class="d-flex justify-content-center" id="navPaginator" aria-label="Page navigation" data-count="${countItems}">
            <ul class="pagination gap-1 mb-0">
                <li class="page-item">
                    <button class="page-link" type="button" data-value="prev">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                </li>
                ${innerPageLinks(countItems)}
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
