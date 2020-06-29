document.addEventListener("DOMContentLoaded", function() {
	var elem = document.querySelector('.index');
	var infScroll = new InfiniteScroll( elem, {
		path: '.pagination__older a',
		checkLastPage: true,
		//path: 'page/{{#}}/',
		//checkLastPage: '.pagination__older a',
		append: '.post__preview',
		history: 'replace',
		button: '.infinite-scroll-button',
		loadOnScroll: false,
		hideNav: '.pagination',
	});
	var infiniteScrollDiv = document.querySelector('.infinite-scroll');
	var infiniteScrollButton = document.querySelector('.infinite-scroll-button');

	if (infiniteScrollButton !== undefined && infiniteScrollButton !== null) {
		infiniteScrollButton.addEventListener( 'click', function() {
		  // load next page
		  infScroll.loadNextPage();
		  // enable loading on scroll
		  infScroll.options.loadOnScroll = true;
		  // hide page
		  infiniteScrollDiv.style.display = 'none';
		});
	}
});