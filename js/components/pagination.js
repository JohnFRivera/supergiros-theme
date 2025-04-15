(function($) {
	class Pagination {
		#pagination;
		#btnPrev;
		#btnNext;
		#ipPage;
		#txtLimit;
		#paged;
		#limit;

		/**
		 * Constructor de Pagination
		 */
		constructor() {
			this.#pagination = $('#pagination');
			this.#btnPrev = $('#btnPrev');
			this.#btnNext = $('#btnNext');
			this.#ipPage = $('#ipPage');
			this.#txtLimit = $('#txtLimit');
			this.#paged = 1;
			this.#limit = 0;
		}
	
		#checkDisabled() {
			this.#btnPrev.removeClass('disabled');
			this.#btnNext.removeClass('disabled');
			if (this.#paged === 1) {
				this.#btnPrev.addClass('disabled');
			}
			if (this.#paged === this.#limit) {
				this.#btnNext.addClass('disabled');
			}
		}
	
		setData(foundPosts, postsPerPage) {
			let limit = Math.ceil(foundPosts / postsPerPage);
			if (limit > 1) {
				this.#ipPage.val(this.#paged);
				this.#txtLimit.text(limit);
				this.#limit = limit;
				this.#checkDisabled();
				this.#pagination.removeClass('d-none');
			} else {
				this.#pagination.addClass('d-none');
			}
		}
		
		change(callback) {
			this.#ipPage.change(() => {
				let value = parseInt(this.#ipPage.val());
				this.#paged = value < 1 ? 1 : value > this.#limit ? this.#limit : value;
				this.#ipPage.val(this.#paged);
				callback(this.#paged);
				this.#checkDisabled();
			});
		}
		
		prev(callback) {
			this.#btnPrev.click((e) => {
				e.preventDefault();
				let value = parseInt(this.#ipPage.val());
				if (value > 1) {
					this.#paged--;
					this.#ipPage.val(this.#paged);
					callback(this.#paged);
				}
				this.#checkDisabled();
			});
		}
		
		next(callback) {
			this.#btnNext.click((e) => {
				e.preventDefault();
				let value = parseInt(this.#ipPage.val());
				if (value < this.#limit) {
					this.#paged++;
					this.#ipPage.val(this.#paged);
					callback(this.#paged);
				}
				this.#checkDisabled();
			});
		}
	}

	window.Pagination = Pagination;
})(jQuery)
