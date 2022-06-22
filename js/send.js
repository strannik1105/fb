$(function() {
	 'use strict';
		$("form").submit(function(e) {
      e.preventDefault(); 
        var $form = $(this);
        var $header = $(this).find('.btn').data('header');
        $form.find('.input_title').val($header);
        if (!$header) {
             $form.find('.input_title').val('подключение');
        }
        $.ajax({
          type: $form.attr('method'),
          url: $form.attr('action'),
          data: $form.serialize(),
			success: function() {
				if ($form.hasClass('secForm')) {
					$form[0].reset();
					$('#modal-thanks').iziModal('open', this);
				} else {
					$form.fadeOut("fast", function(){
			  		$form.before("<div class='sps'><p class='thanks tac'>Спасибо, Ваша заявка принята.</p><p class='text tac'>Мы свяжемся с Вами в ближайшее время.</p></div>");
        });
				}
			}
        });
      });
    });	