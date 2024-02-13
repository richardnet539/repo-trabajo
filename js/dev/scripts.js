(function ($) {
	// Efecto busqueda
	var estado_search = function () {
		$('.search-block-form .form-search').on('click', function () {
			console.log('click a input');
			$('.search-block-form').addClass('js-state-search');
		});
		$('.search-block-form .form-search').blur(function () {
			$('.search-block-form').removeClass('js-state-search');
		});
	};

	function checkEstadoSearch() {
		if (window.matchMedia('(max-width: 767px)').matches) {
			// console.log('hola 767px');
			estado_search();
		} else {
			// console.log('mayor a 435px');
			$('#search--form input[type=search]').on('click', function () {
				$('#block-formulariodebusqueda').removeClass('js-state-search');
			});
		}
	}

	checkEstadoSearch();

	// Format
	$(
		'#submit, button[type=submit], html input[type=button], input[type=reset], input[type=submit], .more-link'
	).addClass('btn btn-sm btn-primary');
	$('.comment-reply-link').addClass('btn btn-sm btn-primary');
	$('table#wp-calendar').addClass('table table-striped table-bordered');

	$('.search-form .search-field').addClass('form-control form-control-sm');
	$('.post-edit-link').addClass('btn btn-sm');

	function masonry() {
		$('.filters ul li').click(function () {
			$('.filters ul li').removeClass('active');
			$(this).addClass('active');

			var data = $(this).attr('data-filter');
			$grid.isotope({
				filter: data,
			});
		});

		var $grid = $('.grid').isotope({
			itemSelector: '.masonry__item',
			percentPosition: true,
			masonry: {
				// columnWidth: 100,
				// gutter: 2,
				// fitWidth: true
			},
		});
	}
	masonry();

	$(window).on('load', function () {
		masonry();
		hideEntries();
	});

	function hideEntries() {
		const widgetEntries = $('.widget_recent_entries');
		if (widgetEntries && widgetEntries.length > 0) {
			const ATag = widgetEntries.find('ul li a');
			ATag.each((index, element) => {
				if ($(element).attr('aria-current') || $(element).attr('href').includes('/haz-tu-reserva')) {
					$(element).parent().addClass('hide');
				}
			});
		}
	}

	// Scroll to top
	$('.js-to-top').click(function () {
		$('body, html').animate(
			{
				scrollTop: '0px',
			},
			400
		);
		event.preventDefault();
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() > 0) {
			$('.js-to-top').slideDown(400);
		} else {
			$('.js-to-top').slideUp(400);
		}
	});

	// // parallax
	// $('.parallax-thumbnail').paroller();

	// Slider Home
	if ($('#home-slider').length > 0) {
		$('#home-slider').slick({
			dots: false,
			arrows: true,
			nextArrow: '.home-slider__control--right',
			prevArrow: '.home-slider__control--left',
			autoplay: true,
			autoplaySpeed: 9000,
			infinite: true,
			fade: true,
			cssEase: 'linear',
		});
	}
	//

	// Slider alojamientos UNEA
	if ($('#slider-alojamiento').length > 0) {
		$('#slider-alojamiento').slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: false,
			arrows: true,
			autoplay: true,
			variableWidth: true,
			adaptiveHeight: true,
			centerMode: true,
			swipeToSlide: true,
			infinite: true,

			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	}

	if ($('#slider-alojamiento-2').length > 0) {
		$('#slider-alojamiento-2').slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: false,
			arrows: true,
			autoplay: true,
			variableWidth: true,
			adaptiveHeight: true,
			centerMode: true,
			swipeToSlide: true,
			infinite: true,

			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	}

	// Slider Servicios UNEA
	if ($('#slider-lavanderia').length > 0) {
		$('#slider-lavanderia').slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: false,
			arrows: true,
			autoplay: true,
			variableWidth: true,
			adaptiveHeight: true,
			centerMode: true,
			swipeToSlide: true,
			infinite: true,

			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
  }

  if ($('#slider-ocio').length > 0) {
		$('#slider-ocio').slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: false,
			arrows: true,
			autoplay: true,
			variableWidth: true,
			adaptiveHeight: true,
			centerMode: true,
			swipeToSlide: true,
			infinite: true,

			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
  }

  if ($('#slider-gimnasio').length > 0) {
		$('#slider-gimnasio').slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			dots: false,
			arrows: true,
			autoplay: true,
			variableWidth: true,
			adaptiveHeight: true,
			centerMode: true,
			swipeToSlide: true,
			infinite: true,

			responsive: [
				{
					breakpoint: 991,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 767,
					settings: {
						slidesToShow: 2,
						slidesToScroll: 2,
					},
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 1,
						slidesToScroll: 1,
					},
				},
			],
		});
	}

	//cambiar color a un SVG
	$('.js-img-svg').each(function () {
		var $img = jQuery(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');

		jQuery.get(
			imgURL,
			function (data) {
				// Get the SVG tag, ignore the rest
				var $svg = jQuery(data).find('svg');

				// Add replaced image's ID to the new SVG
				if (typeof imgID !== 'undefined') {
					$svg = $svg.attr('id', imgID);
				}
				// Add replaced image's classes to the new SVG
				if (typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass + ' replaced-svg');
				}

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr('xmlns:a');

				// Check if the viewport is set, else we gonna set it if we can.
				if (
					!$svg.attr('viewBox') &&
					$svg.attr('height') &&
					$svg.attr('width')
				) {
					$svg.attr(
						'viewBox',
						'0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width')
					);
				}

				// Replace image with new SVG
				$img.replaceWith($svg);
			},
			'xml'
		);
	});

	// Ancla en Dropdown
	var ancla_animada = function () {
		$('html, body').animate(
			{
				scrollTop: $($(this).attr('href')).offset().top - 10,
			},
			500
		);
		return false;
	};

	$('a.js-anchor').on('click', ancla_animada);
	$('.region-sidebar-left .sub-menu > li a').on('click', ancla_animada);

	// HASH URL en tabs
	var hash = window.location.hash;
	hash && $('ul[role="tablist"] a[href="' + hash + '"]').tab('show');

	$('ul[role="tablist"] a').click(function (e) {
		$(this).tab('show');
		// var scrollmem = $('body').scrollTop();
		window.location.hash = this.hash;
		// $('html,body').scrollTop(scrollmem);
	});

	// Evita el click derecho a las imagenes
	// $(document).on('contextmenu', 'img', function() {
	//     return false;
	// });

	html_lang = document.documentElement.lang;
	switch (html_lang) {
		case 'es-ES':
			$('.top .icon--lang').addClass('icon--lang__es');
			break;
		case 'en-US':
			$('.top .icon--lang').addClass('icon--lang__en');
			break;
		case 'pt-BR':
			$('.top .icon--lang').addClass('icon--lang__pt-br');
			break;
		case 'fr-FR':
			$('.top .icon--lang').addClass('icon--lang__fr');
			break;
		case 'it-IT':
			$('.top .icon--lang').addClass('icon--lang__it');
			break;
		case 'zh-CN':
			$('.top .icon--lang').addClass('icon--lang__zh-hans');
			break;
		default:
			$('.top .icon--lang').addClass('icon--lang__es');
	}

	// Ejecuta script segun estado de pagina
	var Responsive = {
		status_page: false,
		maxWidth: 767.98,
		lastIndex: 1,

		// Cuando sea menor a 575.98px
		loadResponsive: function () {
			// if ($('.region-sidebar-left a[aria-expanded="true"]').length > 0) {
			//     $('.region-sidebar-left a[data-toggle="collapse"]').trigger("click");
			// }
		},

		// Cuando sea mayor a 575.98px
		rollbackResponsive: function () {
			// if ($('.region-sidebar-left a[aria-expanded="false"]').length > 0) {
			//     $('.region-sidebar-left a[data-toggle="collapse"]').trigger("click");
			// }
		},
		evalState: function () {
			var status_page =
				$(window).width() < Responsive.maxWidth ? 'responsive' : 'normal';
			if (Responsive.status_page != status_page) {
				// console.log('state change ' + status_page);
				Responsive.status_page = status_page;
				Responsive.loadState();
			}
		},
		loadState: function () {
			switch (Responsive.status_page) {
				case 'responsive':
					{
						Responsive.loadResponsive();
					}
					break;

				case 'normal': {
					Responsive.rollbackResponsive();
				}
			}
		},
	};

	Responsive.evalState();

	// verifica al redimensionar el navegador
	$(window).on('resize', function () {
		Responsive.evalState();
		// checkState();
	});
})(jQuery);