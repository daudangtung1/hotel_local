(function($) {
    'use strict';

    $(function() {

     

        $(".dv-main-navigation li.menu-item-has-children").prepend("<span class='dv-open-menu-mobile'></span>");
		    $(".dv-toggle-menu").click(function() {
		      $('.dv-main-navigation').toggleClass('active-menu');

		      $(".dv-toggle-menu").toggleClass("active");

		    });

	    // multi level menu
	    $(".dv-open-menu-mobile").on("click", function() {
	      $(this).toggleClass("active");
	      $(this).parent("li").siblings().find("ul").hide();
	      $(this).parent("li").siblings().find(".dv-open-menu-mobile").removeClass("active");
	      $(this).siblings('ul').toggleClass('active-menu'); 
	    });
	     /*Menu Resonsive svg*/
	        var button = document.getElementById('menu-toggle');
	        $('.menu-toggle').click(function(event) {
				$('body').toggleClass('active');	
	            if (-1 !== button.className.indexOf('opened')) {
	                button.className = button.className.replace(' opened', '');
	                button.setAttribute('aria-expanded', 'false');
	            } else {
	                button.className += ' opened';
	                button.setAttribute('aria-expanded', 'true');
	            }
	        });
			 

	    // body click hide menu
	   

	    var wow = new WOW({	
			boxClass:     'wow',      // default
			animateClass: 'animated', // default
			offset:       0,          // default
			mobile:       false,       // default
			live:         true        // default
		});
		
		wow.init();
		
    }); // end document ready

})(jQuery); // end JQuery namespace