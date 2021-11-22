document.addEventListener("DOMContentLoaded", function(){ 			window.addEventListener( 'load', function() {
				UAGBTabs.init( '.uagb-block-ee495eaf' );
				UAGBTabs.anchorTabId( '.uagb-block-ee495eaf' );
			});
			window.addEventListener( 'hashchange', function() {
				UAGBTabs.anchorTabId( '.uagb-block-ee495eaf' );
			}, false );
			 })