document.addEventListener("DOMContentLoaded", function(){ 			window.addEventListener( 'load', function() {
				UAGBTabs.init( '.uagb-block-f25cfa0f' );
				UAGBTabs.anchorTabId( '.uagb-block-f25cfa0f' );
			});
			window.addEventListener( 'hashchange', function() {
				UAGBTabs.anchorTabId( '.uagb-block-f25cfa0f' );
			}, false );
			 })