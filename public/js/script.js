(function($) {

	$.fn.menumaker = function(options) {

		var cssmenu = $(this), settings = $.extend({
			title: "Menu",
			format: "dropdown",
			sticky: false
		}, options);

		return this.each(function() {
			// cssmenu.prepend('<div id="menu-button">' + settings.title + '</div>');
			$(this).find("#menu-button").on('click', function(){
				$(this).toggleClass('menu-opened');
				var mainmenu = $(this).siblings('ul');

				if (mainmenu.hasClass('open')) {
					mainmenu.slideUp().removeClass('open');
				} else {
					$i = $('.js-dd-panel').find('i:first');

					if ($i.hasClass('fa-remove')) {
						$i.addClass('fa-chevron-down').removeClass('fa-remove');
						$('.search-block').toggleClass('show-search-block');
					}

					mainmenu.slideDown().addClass('open');
					if (settings.format === "dropdown") {
						mainmenu.find('ul').show();
					}
				}
			});

			cssmenu.find('li ul').parent().addClass('has-sub');

			multiTg = function() {
				cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
				cssmenu.find('.submenu-button').on('click', function() {
					$(this).toggleClass('submenu-opened');
					if ($(this).siblings('ul').hasClass('open')) {
						$(this).siblings('ul').removeClass('open').hide();
					}
					else {
						$(this).siblings('ul').addClass('open').show();
					}
				});
			};

			if (settings.format === 'multitoggle') multiTg();
			else cssmenu.addClass('dropdown');

			if (settings.sticky === true) cssmenu.css('position', 'fixed');

			resizeFix = function() {
				if (window.innerWidth > 924) {
					cssmenu.find('ul:first').show().removeAttr('style');
				}

				if (window.innerWidth <= 924) {
					// cssmenu.find('ul:first').show();
					if (false == cssmenu.find('ul:first').hasClass('open')) {
						cssmenu.find('ul:first').hide();
					}
				}
			};
			resizeFix();
			return $(window).on('resize', resizeFix);

		});
	};
})(jQuery);

(function($){
	$(document).ready(function(){
		$(document).ready(function() {
			$("#cssmenu").menumaker({
				title: '',
				format: "multitoggle"
			});

			// $("#cssmenu").prepend("<div id='menu-line'></div>");

			// var foundActive = false, activeElement, linePosition = 0, menuLine = $("#cssmenu #menu-line"), lineWidth, defaultPosition, defaultWidth;

			// $("#cssmenu > ul > li").each(function() {
			// 	if ($(this).hasClass('active')) {
			// 		activeElement = $(this);
			// 		foundActive = true;
			// 	}
			// });

			// if (foundActive === false) {
			// 	activeElement = $("#cssmenu > ul > li").first();
			// }

			// defaultWidth = lineWidth = activeElement.width();

			// defaultPosition = linePosition = activeElement.position().left || 0;

			// menuLine.css("width", lineWidth);
			// menuLine.css("left", linePosition);

			// $("#cssmenu > ul > li").hover(function() {
			// 		activeElement = $(this);
			// 		lineWidth = activeElement.width();
			// 		linePosition = activeElement.position().left;
			// 		menuLine.css("width", lineWidth);
			// 		menuLine.css("left", linePosition);
			// 	},
			// 	function() {
			// 		menuLine.css("left", defaultPosition);
			// 		menuLine.css("width", defaultWidth);
			// });

			$('.js-dd-panel').on('click', function (e) {
				e.preventDefault();

				var $this = $(this);
				var target = $this.data('target') || '.search-block';
				var $i = $this.find('i:first');

				if ($i.hasClass('fa-chevron-down')) {
					$i.removeClass('fa-chevron-down').addClass('fa-remove');
				} else {
					$i.addClass('fa-chevron-down').removeClass('fa-remove');
				}

				var mainmenu = $('#menu-button').siblings('ul');

				if (mainmenu.hasClass('open') && window.innerWidth <= 924) {
					mainmenu.hide().removeClass('open');
				}

				$(target).toggleClass('show-search-block');
			});
		});

	});

})(jQuery);
