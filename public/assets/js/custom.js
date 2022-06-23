(function($) {
    'use strict';

    $(function() {
		// $('body').addClass('aos-animate');
// tab
		var btn = $('.wrap-tab .top-tab ul li'),
		    info = $('.wrap-tab .info-content');

		btn.click(function(e) {
			e.preventDefault();
			var index = $(this).index();
			$(this).parents('.wrap-tab').find('.info-content').hide();
			$(this).parents('.wrap-tab').find('.info-content').eq(index).show();
			$(this).parents('.wrap-tab').find('.top-tab ul li').removeClass('is-active');
			$(this).addClass('is-active');
		});
//end tab
//
	$(".remove").click(function(event) {
	  $(this).parents().eq(1).remove();
	});
//



//fancybox

		$('[data-fancybox="datphongnhanh"]').fancybox({
			// Options will go here
		});
		$('[data-fancybox="danhsachmakhachhang"]').fancybox({
			// Options will go here
		});
		$('[data-fancybox="quanlynhomkhach"]').fancybox({
			// Options will go here
		});


//end fancybox

//datetimepicker

		$('#datetimepicker1').datetimepicker({
		  showSecond: true,format:'d/m/Y H:i'
		});
		$('#datetimepicker2').datetimepicker({
		  showSecond: true,format:'d/m/Y H:i'
		});

		$('.wrap-ds-ma-kh .dsmkh-left .row50 #ngaycapsgt').datetimepicker({
		  showSecond: true,format:'d/m/Y'
		});
		$('.wrap-ds-ma-kh .dsmkh-left .row50 #ngaysinh').datetimepicker({
		  showSecond: true,format:'d/m/Y'
		});
		$('.wrap-ds-ma-kh .dsmkh-left .row50 #thoihanvisa').datetimepicker({
		  showSecond: true,format:'d/m/Y'
		});
		$('.wrap-ds-ma-kh .dsmkh-left .row50 #tamtrutu').datetimepicker({
		  showSecond: true,format:'d/m/Y'
		});
		$('.wrap-ds-ma-kh .dsmkh-left .row50 #tamtruden').datetimepicker({
		  showSecond: true,format:'d/m/Y'
		});



//end datetimepicker



    }); // end document ready

})(jQuery); // end JQuery namespace


