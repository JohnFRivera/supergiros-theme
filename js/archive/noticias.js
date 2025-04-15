jQuery(document).ready(function($) {
	let storage = new LocalStorage('noticias');
	let query = new Query();
	let pagination = new Pagination();
	let term = $('#term').val();
	let search = '';
	let paged = 1;
	
	function trimTitle(title) {
		if (title.length > 48) {
			title = title.substring(0, 48).concat('...', '');
		}
		return title;
	}
	
	function PostPlaceholder() {
		return `
		<div class="h-100 vstack rounded border shadow overflow-hidden">
			<div class="ratio ratio-16x9">
				<div class="w-100 h-100 bg-dark bg-opacity-50"></div>
			</div>
			<div class="h-100 vstack py-2 px-3">
				<p class="placeholder-glow mb-0"><span class="placeholder rounded col-8"></span></p>
			</div>
			<div class="border-top py-2 px-3">
				<small class="placeholder-glow mb-0"><span class="placeholder rounded col-5"></small>
			</div>
		</div>`;
	}
	function PostCard(post, isFirst = false) {
		let title = trimTitle(post.title);
		return `
		<div class="h-100 card-hover vstack rounded shadow overflow-hidden">
			<div class="position-relative">
				<div class="ratio ratio-16x9">
					<div class="overflow-hidden border-bottom">
						<img class="img-fluid" src="${post.thumbnail_url}" alt="Miniatura de ${post.title}">
					</div>
				</div>
				${post.term_name ? `
				<div class="position-absolute top-0 start-0 m-1">
					<span class="badge text-bg-danger rounded shadow-sm">${post.term_name}</span>
				</div>` : ''}
			</div>
			<div class="h-100 vstack py-2 px-3">
				${isFirst ? `<p class="fw-semibold fs-4 mb-0">${title}</p>` : `<p class="fw-semibold mb-0">${title}</p>`}
				${isFirst ? `<p class="opacity-50 mt-1 mb-0">${post.excerpt}</p>` : ''}
			</div>
			<div class="border-top py-2 px-3 mt-auto">
				<small class="opacity-50 mb-0">${post.modified_date}</small>
			</div>
			<a class="stretched-link" title="${post.title}" href="${post.permalink}"></a>
		</div>`;
	}
	
	async function renderFeatured() {
		let mainNotice = $('#mainNotice');
		let submainNotices = $('#submainNotices');
		// Placeholder
		let foundFeatured = storage.get('found_featured', 1);
		mainNotice.html('');
		submainNotices.html('');
		for(let i = 0; i < foundFeatured; i++) {
			if (i === 0) {
				mainNotice.append(PostPlaceholder());
			} else {
				submainNotices.append(`<div class="col">${PostPlaceholder()}</div>`);
			}
		}
		// Consulta
		let data = await query.get(`noticias/?posts_per_page=5&term=&paged=&s=`);
		mainNotice.html('');
		submainNotices.html('');
		if (data.posts.length) {
			storage.set('found_featured', data.posts.length);
			data.posts.forEach((post, i) => {
				if (i === 0) {
					mainNotice.append(PostCard(post, true));
				} else {
					submainNotices.append(`<div class="col">${PostCard(post)}</div>`);
				}
			});
		}
	}
	
	async function renderPosts() {
		let notices = $('#notices');
		// Placeholder
		let foundPosts = storage.get('found_posts', 0);
		notices.html('');
		for(let i = 0; i < foundPosts; i++) {
			notices.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`noticias/?posts_per_page=&term=${term}&paged=${paged}&s=${search}`);
		notices.html('');
		if (data.posts.length) {
			storage.set('found_posts', data.posts.length);
			data.posts.forEach((post, i) => {
				notices.append(`<div class="col">${PostCard(post)}</div>`);
			});
			let tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
			let tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
		} else {
			notices.parent().html(`
			<div class="w-100 h-100 d-flex align-items-center justify-content-center">
				No hay noticias
			</div>`);
		}
		pagination.setData(data.found_posts, 15);
	}
	
	function initEvents() {
		$(window).on('load', function() {
			window.scrollTo({
				top: storage.get('scrollY', 0),
				behavior: 'instant'
			});
		});
		$('#frmSearch').submit(function(e) {
			e.preventDefault();
			let form = $(this).get(0);
			if (form.reportValidity()) {
				search = $('#ipSearch').val();
				renderPosts();
			}
		});
		$('#ipSearch').on('input', function() {
			if (search && $(this).val() === '') {
				search = '';
				renderPosts();
			}
		});
		pagination.change(function(newPage) {
			paged = newPage;
			renderPosts();
		});
		pagination.prev(function(newPage) {
			paged = newPage;
			renderPosts();
		});
		pagination.next(function(newPage) {
			paged = newPage;
			renderPosts();
		});
		$(window).on('beforeunload', function() {
			storage.set('scrollY', $(this).scrollTop());
		});
	}
	
	function onCreate() {
		renderFeatured();
		renderPosts();
		initEvents();
	}
	onCreate();
});
