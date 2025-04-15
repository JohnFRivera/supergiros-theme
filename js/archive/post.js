jQuery(document).ready(function($) {
	let storage = new LocalStorage('post');
	let query = new Query();
	let pagination = new Pagination();
	let term = $('#term').val();
	let search = '';
	let paged = 1;
	
	function PostPlaceholder() {
		return `
		<div class="h-100 vstack rounded border shadow overflow-hidden">
			<div class="ratio ratio-16x9">
				<div class="w-100 h-100 bg-dark bg-opacity-50"></div>
			</div>
			<div class="h-100 vstack py-2 px-3">
				<p class="placeholder-glow mb-1"><span class="placeholder rounded col-8"></span></p>
				<p class="placeholder-glow mb-0">
					<span class="placeholder rounded col-3"></span>
					<span class="placeholder rounded col-5"></span>
					<span class="placeholder rounded col-2"></span>
					<span class="placeholder rounded col-1"></span>
					<span class="placeholder rounded col-4"></span>
				</p>
			</div>
			<div class="border-top py-2 px-3">
				<small class="placeholder-glow mb-0"><span class="placeholder rounded col-5"></small>
			</div>
		</div>`;
	}
	function PostCard(post) {
		return `
		<div class="h-100 card-hover vstack rounded shadow overflow-hidden">
			<div>
				<div class="ratio ratio-16x9 border-bottom overflow-hidden">
					<img class="img-fluid object-fit-cover" src="${post.thumbnail_url}" alt="Miniatura de ${post.title}">
				</div>
			</div>
			<div class="h-100 vstack py-2 px-3">
				<p class="fw-semibold mb-1">${post.title}</p>
				<p class="opacity-50 mb-0">${post.excerpt}</p>
			</div>
			<div class="border-top py-2 px-3 mt-auto">
				<small class="opacity-50 mb-0">${post.modified_date}</small>
			</div>
			<a class="stretched-link" title="${post.title}" href="${post.permalink}"></a>
		</div>`;
	}

	async function renderPosts() {
		let posts = $('#posts');
		// Placeholder
		let foundPosts = storage.get('found_posts', 1);
		posts.html('');
		for(let i = 0; i < foundPosts; i++) {
			posts.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`post/?paged=&term=${term}&s=${search}`);
		posts.html('');
		if (data.posts.length) {
			storage.set('found_posts', data.posts.length);
			data.posts.forEach((post, i) => {
				posts.append(`<div class="col">${PostCard(post)}</div>`);
			});
		}
		pagination.setData(data.found_posts, 15);
	}

	function onCreate() {
		renderPosts();
	}
	onCreate();
});
