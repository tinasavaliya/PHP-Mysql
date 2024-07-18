
    jQuery(document).ready(function($) {
        $(".search-icon").click(function(){
            $(".search").stop().slideToggle();
        });
    //     $(".search-btn").click(function () {
    //         $(".search").animate({ height: 'toggle' });
            
    //   });

        $(".humburgmenu, .close").on('click', function() {
            $("#header-menu .menu-list").toggleClass('menu-open');
        });
    });