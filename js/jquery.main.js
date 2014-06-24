(function(){

	$.fn.equalHeightColumns = function() {
		var tallest = 0;
		
		$(this).each(function() {
			if ($(this).outerHeight(true) > tallest) {
				tallest = $(this).outerHeight(true);
			}
		});
		
		$(this).each(function() {
			var diff = 0;
			diff = tallest - $(this).outerHeight(true);
			$(this).height($(this).height() + diff);
		});
	};
	
	$(function(){
		//$('li').has('ul.sub-menu').addClass('nockick');
		$('.btn-m-nav').click(function(){
			$('#header nav').toggleClass('open');
		});

		$( '#nav li:has(ul)' ).doubleTapToGo();
		
		/*$('#nav > li.menu-item-has-children > a').click(function(){
			
			if($(this).parent().hasClass('open')){
				var $currOpenLi = $(this).parent();
			}
			
			$('#nav > li.menu-item-has-children').not($currOpenLi).removeClass('open');
			
			$(this).parent().toggleClass('open');
			
			return false;
			
		});*/
	});
	
})(jQuery);