jQuery(document).ready(function($) {
	let query = new Query();
	let u = $('#u').val();
	
	function getCounter() {
		let themeData = JSON.parse(window.localStorage.getItem('supergiros-theme'));
		if (!themeData || !themeData.utilidades || !themeData.utilidades.found_posts) {
			return 1;
		}
		return themeData.utilidades.found_posts;
	}
	function setCounter(counter) {
		let themeData = JSON.parse(window.localStorage.getItem('supergiros-theme'));
		if (!themeData) {
			themeData = { utilidades: { found_posts: 1 } };
		} else if (!themeData.utilidades) {
			themeData.utilidades = { found_posts: 1 };
		}
		themeData.utilidades.found_posts = counter;
		window.localStorage.setItem('supergiros-theme', JSON.stringify(themeData));
	}
	
	function PostPlaceholder() {
		return `
		<div class="con-grid rounded border p-3" style="height: 183.19px;">
			<div class="w-100 ratio ratio-1x1 mb-3">
				<svg class="bd-placeholder-img rounded" width="116px" height="116px" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder" preserveAspectRatio="xMidYMid slice" focusable="false">
					<title>Placeholder</title>
					<rect width="100%" height="100%" fill="#868e96"></rect>
				</svg>
			</div>
			<h6 class="placeholder-glow text-center mb-1">
				<span class="placeholder rounded col-9"></span>
			</h6>
		</div>`;
	}
	function PostCard(post) {
		return `
		<div class="h-100 card-logo-hover rounded shadow overflow-hidden" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="${post.description}">
            <div class="h-100 vstack">
                <div class="ratio ratio-1x1 border-bottom">
                    <img class="object-fit-cover" src="${post.icon}" alt="Logo ${post.name}" />
                </div>
				<div class="h-100 vstack py-2 px-3">
					<p class="text-center fw-semibold my-auto">${post.name}</p>
				</div>
            </div>
			<a href="${post.url}" class="stretched-link" target="_Blank"></a>
        </div>`;
	}
	
	async function renderPosts() {
		let utilities = $('#utilities');
		// Placeholder
		let foundPosts = getCounter();
		utilities.html('');
		for(let i = 0; i < foundPosts; i++) {
			utilities.append(PostPlaceholder());
		}
		// Consulta
		let data = await query.post('utilidades/', { u });
		utilities.html('');
		if (data.utilidades.length) {
			setCounter(data.utilidades.length);
			data.utilidades.forEach((utilidad, i) => {
				utilities.append(`<div class="con-grid levitate-y">${PostCard(utilidad)}</div>`);
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
