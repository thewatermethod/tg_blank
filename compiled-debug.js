window.onload = function(){
    if( document.querySelector('body').classList.contains('page-template-tmpl-home') || document.querySelector('body').classList.contains('page-template-tmpl-full')){
        insertSearch( '#main-menu');
        sizeQuotes();
       
        var hero = document.querySelector('header.site-header .hero');

        document.onscroll = function() {
           if ( window.scrollY > 48 ) {
                hero.style.opacity = 0;
           } else {
                hero.style.opacity = 1;
           }
             
        };

    }

    insertPhone();




};

function sizeQuotes(){

    var heights = [];    
    var quotes = document.querySelectorAll('.quote');
    
    if( window.innerWidth > 800){
        quotes.forEach(element => {
            heights.push( element.clientHeight );
        });

        heights.sort();
        var max = heights[ heights.length-1 ];

        quotes.forEach(element => {
            element.style.color = 'black';
            element.style.height = max + 'px';
        });
    } else {
        quotes.forEach(element => {
            element.style.color = 'black';
            element.style.height = 'auto';
        });       
    }



}

function insertPhone(){
    if( siteSettings.phone == null ){
        return;
    }

    var body = document.querySelector('body');
    
    var link = document.createElement('a');
    link.classList.add('phone');
    link.setAttribute('href', siteSettings.url + '/contact' );

    var phone = document.createTextNode('Contact Us: ' + siteSettings.phone);
    link.appendChild(phone);
    body.appendChild(link);
}


//inserts the search box in the top nav
function insertSearch( selectorString ){

    if( !document.querySelector( selectorString ) || siteSettings.url == null ){
        return false;
    }

    var parentElement = document.querySelector( selectorString );
    
    var searchForm = document.createElement('form');
    searchForm.setAttribute( 'role', 'search');
    searchForm.setAttribute( 'method','get' );
    searchForm.setAttribute( 'class', 'search-form' );

    //to do -> localize script, etc
    searchForm.setAttribute( 'action', siteSettings.url );

    var label = document.createElement('label');

    var span = document.createElement('span');
    span.setAttribute( 'class', 'screen-reader-text' );
    
    var txt = document.createTextNode('Search for:');
    span.appendChild(txt);
    
    var input = document.createElement( 'input' );
    input.setAttribute( 'type', 'search' );
    input.setAttribute( 'class', 'search-field' );
    input.setAttribute( 'placeholder', 'Search...' );
    input.setAttribute( 'value', '' );  
    input.setAttribute( 'name', 's' );
    
    label.appendChild(span);
    label.appendChild(input);

    var submit = document.createElement('submit');
    submit.setAttribute( 'class', 'search-submit');
    submit.setAttribute( 'value', 'Search' );

    searchForm.appendChild( label );
    searchForm.appendChild( submit );    

    parentElement.appendChild(searchForm);
}


jQuery(document).ready(function() { 

    (function (jQuery) { 
        jQuery('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
        
        jQuery('.tab ul.tabs li').click(function (g) { 
            var tab = jQuery(this).closest('.tab'), 
                index = jQuery(this).closest('li').index();
            
            tab.find('ul.tabs > li').removeClass('current');
            jQuery(this).closest('li').addClass('current');
            
            tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
            tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
            
            g.preventDefault();
        } );
    })(jQuery);

});

/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	var container, button, menu, links, i, len;

	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function() {
	var isIe = /(trident|msie)/i.test( navigator.userAgent );

	if ( isIe && document.getElementById && window.addEventListener ) {
		window.addEventListener( 'hashchange', function() {
			var id = location.hash.substring( 1 ),
				element;

			if ( ! ( /^[A-z0-9_-]+$/.test( id ) ) ) {
				return;
			}

			element = document.getElementById( id );

			if ( element ) {
				if ( ! ( /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) ) ) {
					element.tabIndex = -1;
				}

				element.focus();
			}
		}, false );
	}
})();
