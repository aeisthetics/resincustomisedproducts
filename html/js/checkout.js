
	shoe.render();

	shoe.cart.on('shoe_checkout', function (evt) {
		var items, len, i;

		if (this.subtotal() > 0) {
			items = this.items();

			for (i = 0, len = items.length; i < len; i++) {}
		}
	});

	$('.value-plus').on('click', function () {
		var divUpd = $(this).parent().find('.value'),
			newVal = parseInt(divUpd.text(), 10) + 1;
		divUpd.text(newVal);
	});

	$('.value-minus').on('click', function () {
		var divUpd = $(this).parent().find('.value'),
			newVal = parseInt(divUpd.text(), 10) - 1;
		if (newVal >= 1) divUpd.text(newVal);
	});

	$(document).ready(function (c) {
		$('.close1').on('click', function (c) {
			$('.rem1').fadeOut('slow', function (c) {
				$('.rem1').remove();
			});
		});
	});

	$(document).ready(function (c) {
		$('.close2').on('click', function (c) {
			$('.rem2').fadeOut('slow', function (c) {
				$('.rem2').remove();
			});
		});
	});

	$(document).ready(function (c) {
		$('.close3').on('click', function (c) {
			$('.rem3').fadeOut('slow', function (c) {
				$('.rem3').remove();
			});
		});
	});

	jQuery(document).ready(function ($) {
		$(".scroll").click(function (event) {
			event.preventDefault();
			$('html,body').animate({
				scrollTop: $(this.hash).offset().top
			}, 1000);
		});
	});

