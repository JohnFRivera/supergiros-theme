jQuery(document).ready(function($) {
	let storage = new LocalStorage('index');
	let query = new Query();
	
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
					<small class="opacity-50 text-center mb-0">${post.date}</small>
				</div>
			</div>
			<a href="${post.permalink}" class="stretched-link"></a>
		</div>`;
	}

	async function renderPosts() {
		let lotteryDry = $('#lotteryDry');
		// Placeholder
		let foundPosts = storage.get('resultados_y_secos', 1);
		lotteryDry.html('');
		for(let i = 0; i < foundPosts; i++) {
			lotteryDry.append(`<div class="col">${PostPlaceholder()}</div>`);
		}
		// Consulta
		let data = await query.get(`resultados-y-secos/?term=&year=&monthnum=&day=&paged=`);
		lotteryDry.html('');
		if (data.posts.length) {
			storage.set('resultados_y_secos', data.posts.length);
			data.posts.forEach((post, i) => {
				lotteryDry.append(`<div class="col">${PostCard(post)}</div>`);
			});
			let tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
			let tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
		}
	}

	function onCreate() {
		renderPosts();
	}
	onCreate();
});
