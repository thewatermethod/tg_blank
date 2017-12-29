window.onload = function(){
    if( document.querySelector('body').classList.contains('page-template-tmpl-full') ){
        insertSearch( '#main-menu');
    }

    insertPhone();

};

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
        
        jQuery('.tab ul.tabs li a').click(function (g) { 
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
