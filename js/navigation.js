( function() {
	const siteNavigation = document.getElementById( 'site-navigation' );
	if ( ! siteNavigation ) { return; }
	const button = siteNavigation.getElementsByTagName( 'button' )[ 0 ];
	if ( 'undefined' === typeof button ) { return; }
	const menu = siteNavigation.getElementsByTagName( 'ul' )[ 0 ];
	if ( 'undefined' === typeof menu ) { button.style.display = 'none'; return; }
	if ( ! menu.classList.contains( 'nav-menu' ) ) { menu.classList.add( 'nav-menu' ); }
	button.addEventListener( 'click', function() {
		siteNavigation.classList.toggle( 'toggled' );
		button.setAttribute( 'aria-expanded', button.getAttribute( 'aria-expanded' ) === 'true' ? 'false' : 'true' );
	} );
	document.addEventListener( 'click', function( event ) {
		if ( ! siteNavigation.contains( event.target ) ) {
			siteNavigation.classList.remove( 'toggled' );
			button.setAttribute( 'aria-expanded', 'false' );
		}
	} );
}() );

( function () {
	const hamburger = document.getElementById( 'navHamburger' );
	const mobileMenu = document.getElementById( 'mobileMenu' );
	if ( ! hamburger || ! mobileMenu ) { return; }
	hamburger.addEventListener( 'click', function () {
		const isOpen = hamburger.classList.toggle( 'active' );
		mobileMenu.classList.toggle( 'active', isOpen );
		hamburger.setAttribute( 'aria-expanded', String( isOpen ) );
	} );
	document.addEventListener( 'click', function ( event ) {
		if ( ! hamburger.contains( event.target ) && ! mobileMenu.contains( event.target ) ) {
			hamburger.classList.remove( 'active' );
			mobileMenu.classList.remove( 'active' );
			hamburger.setAttribute( 'aria-expanded', 'false' );
		}
	} );
}() );
