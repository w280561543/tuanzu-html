$(document).ready(function() {
	var filterForm = $('#filterForm'),
		filterFormInput = filterForm.children('input');

	filterForm.on('click', 'a', function(event) {
		event.preventDefault();
		var _this = $(this);
		if(filterFormInput.is('#' + _this.data('key'))) {
			filterFormInput.filter('#' + _this.data('key')).val(_this.data('value'));
			for(var j = 0, len = filterFormInput.length; j < len; j++) {
				if(filterFormInput[j].value == '' || filterFormInput[j].value == '0') {
					filterFormInput[j].remove();
				}
			}
			filterForm.submit();
		}
	});
	if(obj != undefined) {
		for(k in obj) {
			filterFormInput.filter('#' + k).val(obj[k]);
			$('a[data-value=' + obj[k] + ']').parent().addClass('active').siblings().removeClass('active');
		}
	}
});