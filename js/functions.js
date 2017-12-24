window.onload = function(){
    insertSearch();
};


//inserts the search box in the top nav
function insertSearch(){

    if( !document.querySelector('#main-menu' ) ){
        return false;
    }

    var mainMenu = document.querySelector('#main-menu');
    
    var searchForm = document.createElement('form');
    searchForm.setAttribute( 'role', 'search');
    searchForm.setAttribute( 'method','get' );
    searchForm.setAttribute( 'class', 'search-form' );

    //to do -> localize script, etc
    searchForm.setAttribute( 'action', 'https://tg-template.dev');

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

    mainMenu.appendChild(searchForm);
}