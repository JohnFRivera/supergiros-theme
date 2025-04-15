jQuery(document).ready(function($) {
	let storage = new LocalStorage('planes-de-premios');
	let query = new Query();
	let pagination = new Pagination();
	let paged = 1;
	
	function PostPlaceholder() {
		return `
		<div class="vstack rounded border shadow">
			<div class="py-2 mx-auto">
				<div class="bg-dark bg-opacity-50 rounded-circle" style="width: 110px;height: 110px;"></div>
			</div>
			<div class="border-top py-2 px-3">
				<small class="placeholder-glow mb-0">
					<span class="placeholder rounded col-6"></span>
				</small>
			</div>
		</div>`;
	}
	function PostCard(post) {
		return `
		<div class="card-logo-hover bg-body rounded shadow" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${post.term_name}">
			<div class="vstack">
				<div class="py-2 mx-auto">
					<div class="ratio ratio-1x1" style="width: 110px;">
						<img class="img-fluid" src="${post.logotipo_url}" alt="Logo de ${post.term_name}">
					</div>
				</div>
				<div class="border-top py-2 px-3">
					<small class="opacity-50 text-center mb-0">${post.modified_date}</small>
				</div>
			</div>
			<a href="${post.permalink}" class="stretched-link"></a>
		</div>`;
	}
	
	async function renderPosts() {
		let lotteries = $('#lotteries');
		// Placeholder
		let foundPosts = storage.get('found_posts', 1);
		lotteries.html('');
		for(let i = 0; i < foundPosts; i++) {
			lotteries.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`planes-de-premios/?paged=${paged}`);
		lotteries.html('');
		if (data.posts.length) {
			storage.set('found_posts', data.posts.length);
			data.posts.forEach((post, i) => {
				lotteries.append(`<div class="col">${PostCard(post)}</div>`);
			});
			let tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
			let tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
		} else {
			lotteries.append(`<div class="w-100 d-flex align-items-center justify-content-center" style="min-height: 400px;">No hay ninguna lotería</div>`);
		}
		pagination.setData(data.found_posts, 10);
	}
	
	function initEvents() {
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
	}
	
	function onCreate() {
		renderPosts();
		initEvents();
	}
	onCreate();
});
