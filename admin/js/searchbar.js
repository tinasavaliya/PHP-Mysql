
    jQuery(document).ready(function($) {
        $(".search-icon").click(function(){
            console.log('Hello');
            $(".search").stop().slideToggle();
        });

        $(".humburgmenu").on('click', function() {
            console.log('Hello');
            $("#header-menu .menu-list").toggleClass('menu-open');
        });
    });