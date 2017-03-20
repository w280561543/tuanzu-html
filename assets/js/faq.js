$(document).ready(function() {
	var wi = $(window),
		faq = $('.faq'),
		faqGroup = $('.faq-group'),
		faqTitle = $('.faq-title');
	faqTrigger = $('.faq-trigger'),
		faqItems = $('.faq-items'),
		faqCategories = $('.faq-categories'),
		faqsCategoriesA = faqCategories.find('a');

	faqsCategoriesA.on('click', function(event) {
		event.preventDefault();
		var selectedHref = $(this).attr('href'),
			target = $(selectedHref);
		$('body,html').animate({ 'scrollTop': target.offset().top - 19 }, 200);
	});

	faqTrigger.on('click', function(event) {
		event.preventDefault();
		var _this = $(this),
			_thisS = _this.children('span'),
			_thisC = _this.next('.faq-content');

		if(_thisC.is(':hidden')) {
			_thisS.text('-');
			_thisC.show();
		} else {
			_thisS.text('+');
			_thisC.hide();
		}
	});

	wi.on('scroll', function() {
		updateCategory();
	});

	function updateCategory() {
		updateCategoryPosition();
		updateSelectedCategory();
	}

	function updateCategoryPosition() {
		var top = faq.offset().top,
			height = faq.height() - faqCategories.height(),
			wst = wi.scrollTop();
		if((top - 20) <= wst && (top - 20 + height) > wst) {
			faqCategories.addClass('faq-fixed');
		} else {
			faqCategories.removeClass('faq-fixed');
		}
	}

	function updateSelectedCategory() {
		faqGroup.each(function() {
			var _this = $(this),
				margin = parseInt(faqTitle.eq(1).css('marginTop').replace('px', '')),
				activeCategory = $('.faq-categories a[href="#' + _this.attr('id') + '"]'),
				topSection = (activeCategory.parent('li').is(':first-child')) ? 0 : Math.round(_this.offset().top);
			if((topSection - 20 <= wi.scrollTop()) && (Math.round(_this.offset().top) + _this.height() + margin - 20 > wi.scrollTop())) {
				activeCategory.parent('li').addClass('selected');
			} else {
				activeCategory.parent('li').removeClass('selected');
			}
		});
	}
});