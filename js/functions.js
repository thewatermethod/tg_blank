window.onload = function(){


    if( document.querySelector('body').classList.contains('page-template-tmpl-home') || document.querySelector('body').classList.contains('page-template-tmpl-full')){
        insertSearch( '#main-menu');
        sizeQuotes();
       
        var hero = document.querySelector('header.site-header .hero');

        if( hero ){
            document.onscroll = function() {
                if ( window.scrollY > 48 ) {
                    hero.style.opacity = 0;
                } else {
                    hero.style.opacity = 1;
                }
            };
        }
    }

    isIE();

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


function isIE() {

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE ");

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) {
       document.querySelector('body').classList.add('isIE');
       return true;
    }


    return false;
}