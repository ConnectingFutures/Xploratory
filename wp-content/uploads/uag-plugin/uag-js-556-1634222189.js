document.addEventListener("DOMContentLoaded", function(){ 			window.addEventListener( 'load', function() {
				UAGBTabs.init( '.uagb-block-ae9c400b' );
				UAGBTabs.anchorTabId( '.uagb-block-ae9c400b' );
			});
			window.addEventListener( 'hashchange', function() {
				UAGBTabs.anchorTabId( '.uagb-block-ae9c400b' );
			}, false );
			 })