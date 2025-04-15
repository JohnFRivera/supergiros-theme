jQuery(document).ready(function($) {
	let storage = new LocalStorage('resultados-y-secos');
	let query = new Query();
	let pagination = new Pagination();
	let lottery = '';
	let year = '';
	let month = '';
	let day = '';
	let paged = 1;
	let yearList = [];
	let monthList = [];
	let dayList = [];
	
	function setLists(filters) {
		yearList = filters.year;
		monthList = filters.month;
		dayList = filters.day;
	}
	
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
	
	function renderYears() {
		let slYear = $('#slYear');
		slYear.html('<option value="">Todos los años</option>');
		yearList.forEach(year => {
			slYear.append(`<option value="${year}">${year}</option>`);
		});
		slYear.fadeIn(100);
	}
	function renderMonths() {
		let slMonth = $('#slMonth');
		slMonth.html('<option value="">Todos los meses</option>');
		monthList.forEach(month => {
			slMonth.append(`<option value="${month.value}">${month.text}</option>`);
		});
		slMonth.fadeIn(100);
	}
	function renderDays() {
		let slDay = $('#slDay');
		slDay.html('<option value="">Todos los días</option>');
		dayList.forEach(day => {
			slDay.append(`<option value="${day}">${day}</option>`);
		});
		slDay.fadeIn(100);
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
		let data = await query.get(`resultados-y-secos/?term=${lottery}&year=${year}&monthnum=${month}&day=${day}&paged=${paged}`);
		lotteries.html('');
		setLists(data.filters);
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
		$('#slLottery').change(async function() {
			paged = 1;
			lottery = $(this).val();
			year = '';
			month = '';
			day = '';
			await renderPosts();
			renderYears();
			$('#slMonth').fadeOut(100);
			$('#slDay').fadeOut(100);
		});
		$('#slYear').change(async function() {
			paged = 1;
			year = $(this).val();
			month = '';
			day = '';
			await renderPosts();
			!year ? $('#slMonth').fadeOut(100) : renderMonths();
			$('#slDay').fadeOut(100);
		});
		$('#slMonth').change(async function() {
			paged = 1;
			month = $(this).val();
			day = '';
			await renderPosts();
			!month ? $('#slDay').fadeOut(100) : renderDays();
		});
		$('#slDay').change(function() {
			paged = 1;
			day = $(this).val();
			renderPosts();
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
	}

	async function onCreate() {
		await renderPosts();
		renderYears();
		initEvents();
	}
	onCreate();
});
