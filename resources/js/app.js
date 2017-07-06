$(document).ready(function () {


	$(document).on('submit', '.js-form', function (evt) {
		evt.preventDefault();
		var $form = $(this);

		$.ajax({
			url: $form.attr('action'),
			type: 'post',
			method: 'post',
			data: $form.serialize(),
			success: function (data) {
				var $data = $(data);

				$('.js-table').replaceWith($data.find('.js-table'));
			}
		});
	});

	$(document).on('click', '.js-clear', function (evt) {
		evt.preventDefault();
		var $form = $('.js-form');
		$form.trigger('reset');

		$.ajax({
			url: $form.attr('action'),
			type: 'post',
			method: 'post',
			data: $form.serialize(),
			success: function (data) {
				var $data = $(data);

				$('.js-table').replaceWith($data.find('.js-table'));
			}
		});
	});
});