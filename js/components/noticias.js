jQuery(document).ready(function($) {
	let storage = new LocalStorage('index');
	let query = new Query();
	let term = '';
	
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
	function PostCard(post) {
		return `
		<div class="h-100 card-hover vstack rounded shadow overflow-hidden">
			<div class="position-relative">
				<div class="ratio ratio-16x9">
					<div class="overflow-hidden border-bottom">
						<img class="img-fluid zoom-image" src="${post.thumbnail_url}" alt="Miniatura de ${post.title}">
					</div>
				</div>
				${post.term_name ? `
				<div class="position-absolute top-0 start-0 m-1">
					<span class="badge text-bg-danger rounded shadow-sm">${post.term_name}</span>
				</div>` : ''}
			</div>
			<div class="h-100 vstack py-2 px-3">
				<p class="fw-semibold mb-0">${post.title}</p>
			</div>
			<div class="border-top py-2 px-3 mt-auto">
				<small class="opacity-50 mb-0">${post.modified_date}</small>
			</div>
			<a class="stretched-link" title="${post.title}" href="${post.permalink}"></a>
		</div>`;
	}
	
	async function renderPosts() {
		let news = $('#news');
		// Placeholder
		let foundPosts = storage.get('noticias', 0);
		news.html('');
		for(let i = 0; i < foundPosts; i++) {
			news.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`noticias/?posts_per_page=10&term=${term}&paged=&s=`);
		news.html('');
		if (data.posts.length) {
			storage.set('noticias', data.posts.length);
			data.posts.forEach((post, i) => {
				news.append(`<div class="col">${PostCard(post)}</div>`);
			});
		}
	}
	
	function initEvents() {
		$('#typesNews').on('click', '.nav-link', function(e) {
			e.preventDefault();
			$(this).parent().children().removeClass('active');
			$(this).addClass('active');
			term = $(this).attr('href').substring(1);
			renderPosts();
		});
	}
	
	function onCreate() {
		renderPosts();
		initEvents();
	}
	onCreate();
});