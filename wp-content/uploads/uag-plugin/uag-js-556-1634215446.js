document.addEventListener("DOMContentLoaded", function(){ 			window.addEventListener( 'load', function() {
				UAGBTabs.init( '.uagb-block-b6ee8aad' );
				UAGBTabs.anchorTabId( '.uagb-block-b6ee8aad' );
			});
			window.addEventListener( 'hashchange', function() {
				UAGBTabs.anchorTabId( '.uagb-block-b6ee8aad' );
			}, false );
			 })