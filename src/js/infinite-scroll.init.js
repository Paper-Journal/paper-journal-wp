document.addEventListener("DOMContentLoaded", function() {
	var elem = document.querySelector('.index');
	var pagination = document.querySelector('.pagination')
	var paginationOlder = document.querySelector('.pagination__older a')
	var infiniteScrollDiv = document.querySelector('.infinite-scroll');
	var infiniteScrollButton = document.querySelector('.infinite-scroll-button');
	var infScroll = new InfiniteScroll( elem, {
		path: '.pagination__older a',
		checkLastPage: true,
		append: '.post__preview',
		history: 'replace',
		button: '.infinite-scroll-button',
		loadOnScroll: false,
		hideNav: '.pagination',
	});
	
	if (paginationOlder !== undefined && paginationOlder !== null) {
		infiniteScrollButton.addEventListener( 'click', function() {
		  // load next page
		  infScroll.loadNextPage();
		  // enable loading on scroll
		  infScroll.options.loadOnScroll = true;
		  // hide page
		  infiniteScrollDiv.style.display = 'none';
		});
	} else {
		infiniteScrollDiv.style.display = 'none';
		pagination.style.display = 'none';
	}
	
	var isSafari = window.safari !== undefined;
	
	if (isSafari) {
		infScroll.on( 'append', function( response, path, items ) {
			for ( var i=0; i < items.length; i++ ) {
				reloadSrcsetImgs( items[i] );
			}
		});

		function reloadSrcsetImgs( item ) {
			var imgs = item.querySelectorAll('img[srcset]');
			for ( var i=0; i < imgs.length; i++ ) {
				var img = imgs[i];
				img.outerHTML = img.outerHTML;
			}
		}
	}
});