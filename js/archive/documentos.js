jQuery(document).ready(function($) {
	let storage = new LocalStorage('noticias');
	let query = new Query();
	let pagination = new Pagination();
	let orderby = '';
	let order = '';
	let term = $('#term').val();
	let search = '';
	let paged = 1;
	
	function trimTitle(title) {
		if (title.length > 40) {
			title = title.substring(0, 40).trim().concat('...', '');
		}
		return title;
	}
	
	function PostPlaceholder() {
		return `
		<div class="rounded border shadow overflow-hidden">
			<div class="ratio" style="aspect-ratio: 3 / 4;">
				<div class="w-100 h-100 bg-dark bg-opacity-50"></div>
			</div>
			<div class="py-2 px-3">
				<h6 class="placeholder-glow mb-0"><span class="placeholder rounded col-9"></h6>
			</div>
			<div class="border-top py-2 px-3">
				<small class="placeholder-glow mb-0"><span class="placeholder rounded col-6"></small>
			</div>
		</div>`;
	}
	function PostCard(post) {
		let title = trimTitle(post.title);
		return `
		<div class="h-100 card-hover rounded shadow overflow-hidden">
			<div class="h-100 vstack">
				<div class="ratio" style="aspect-ratio: 3 / 4;">
					<div class="overflow-hidden border-bottom">
						<img class="img-fluid zoom-image" src="${post.thumbnail_url}" alt="Portada de ${post.title}">
					</div>
				</div>
				<div class="h-100 vstack py-2 px-3">
					${post.term_name ? `<small class="opacity-50 mb-1">${post.term_name}</small>` : ''}
					<p class="fw-semibold mb-0">${title}</p>
				</div>
				<div class="border-top py-2 px-3">
					<small class="opacity-50 mb-0">${post.modified_date}</small>
				</div>
			</div>
			<a href="${post.permalink}" title="${post.title}" class="stretched-link"></a>
		</div>`;
	}
	
	async function renderPosts() {
		let documents = $('#documents');
		// Placeholder
		let foundPosts = storage.get('found_posts', 1);
		documents.html('');
		for(let i = 0; i < foundPosts; i++) {
			documents.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`documentos/?orderby=${orderby}&order=${order}&paged=${paged}&s=${search}&term=${term}`);
		documents.html('');
		if (data.posts.length) {
			storage.set('found_posts', data.posts.length);
			data.posts.forEach((post, i) => {
				documents.append(`<div class="col">${PostCard(post)}</div>`);
			});
			let tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
			let tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
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
		$('#slOrder').change(function() {
			let arr = $(this).val().split('|');
			orderby = arr[0];
			order = arr[1];
			renderPosts();
		});
		$('#frmSearch').submit(async function(e) {
			e.preventDefault();
			let form = $(this).get(0);
			if (form.reportValidity()) {
				search = $('#ipSearch').val();
				renderPosts();
			}
		});
		$('#ipSearch').on('input', async function() {
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
	
	async function onCreate() {
		renderPosts();
		initEvents();
	}
	onCreate();
});
