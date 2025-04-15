jQuery(document).ready(function($) {
	let storage = new LocalStorage('noticias');
	let query = new Query();
	let pagination = new Pagination();
	let term = $('#term').val();
	let paged = 1;
	
	function PostPlaceholder() {
		let excerpt = '';
		for(let i = 0; i < Math.floor(Math.random() * 2) + 6; i++) {
			excerpt += `<span class="placeholder rounded col-${Math.floor(Math.random() * 4) + 2}"></span> `;
		}
		return `
		<div class="h-100 rounded border shadow overflow-hidden">
			<div class="vstack">
				<div class="d-flex border-bottom py-3">
					<div class="bg-dark bg-opacity-50 rounded-circle mx-auto" style="width: 80px;height: 80px;"></div>
				</div>
				<div class="vstack py-2 px-3">
					<h6 class="placeholder-glow mb-1"><span class="placeholder rounded col-${Math.floor(Math.random() * 4) + 4}"></h6>
					<p class="placeholder-glow mb-0">${excerpt}</p>
				</div>
			</div>
		</div>`;
	}
	function PostCard(post) {
		return `
		<div class="h-100 card-cover-hover rounded shadow overflow-hidden">
			<div class="position-absolute top-0 end-0 mt-2 me-2">
				<i class="bi bi-arrow-right text-white"></i>
			</div>
			<div class="vstack">
				<div class="vstack align-items-center border-bottom py-2">
					<div class="ratio ratio-1x1" style="width: 96px;">
						<img class="img-fluid bg-body rounded-circle" src="${post.thumbnail_url}" alt="">
					</div>
				</div>
				<div class="vstack p-3 z-1">
					<p class="fw-semibold mb-1">${post.title}</p>
					<p class="opacity-50 mb-0">${post.excerpt}</p>
				</div>
			</div>
			<a href="${post.permalink}" class="stretched-link"></a>
		</div>`;
	}
	
	async function renderPosts() {
		let portfolio = $('#portafolio');
		// Placeholder
		let foundPosts = storage.get('found_posts', 1);
		portfolio.html('');
		for(let i = 0; i < foundPosts; i++) {
			portfolio.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`portafolio/?term=${term}`);
		portfolio.html('');
		if (data.posts.length) {
			storage.set('found_posts', data.posts.length);
			data.posts.forEach((post, i) => {
				portfolio.append(`<div class="col">${PostCard(post)}</div>`);
			});
		}
	}

	function initEvents() {
		$(window).on('load', function() {
			window.scrollTo({
				top: storage.get('scrollY', 0),
				behavior: 'instant'
			});
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
		renderPosts();
		initEvents();
	}
	onCreate();
});