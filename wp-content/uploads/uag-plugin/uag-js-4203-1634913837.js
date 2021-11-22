document.addEventListener("DOMContentLoaded", function(){ 			window.addEventListener( 'load', function() {
				UAGBTabs.init( '.uagb-block-e8556d3f' );
				UAGBTabs.anchorTabId( '.uagb-block-e8556d3f' );
			});
			window.addEventListener( 'hashchange', function() {
				UAGBTabs.anchorTabId( '.uagb-block-e8556d3f' );
			}, false );
			 })