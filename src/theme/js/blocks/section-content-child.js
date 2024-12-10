( function( $ ) {
	let initBlock = function( section = false ) {
		let $section = section ? $( section ) : $( '.section-content-child' );

		if ( $section ) {
			// Custom code
		}
	};

	window.app.loadBlock( initBlock, 'section-content-child', '.section-content-child' );
} )( jQuery );