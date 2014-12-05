$(function () {
	var path = document.location.host + document.location.pathname;
	var myApp;

	// or with jQuery
	var $container = $('#masonry_container');
	// initialize Masonry after all images have loaded  
	$container.imagesLoaded( function() {
		$container.masonry({itemSelector: '.masonry_item'});
	});

	$('.filter_options li').on('click', function() {
		if($(this).hasClass('active'))
			return;
		
		//Change Classes
		$(this).parent().find('.active').removeClass('active');
		$(this).addClass('active');

		var values = getSendData();

		$.ajax({
			url: "?page=ajax_viewFilter",
			type: "POST",
			data: {'values':values},
			dataType: 'json',
			beforeSend: function() { myApp.showPleaseWait(); }
		}).done(function(data) {
			console.log(data.test);
			placeData(data);
		}).error(function() {
			alert('ERROR!');
		}).always(function() {
			myApp.hidePleaseWait();
		});
		//console.log(values);
	});

	myApp = myApp || (function () {
	    var pleaseWaitDiv = $('<div class="modal hide" id="pleaseWaitDialog" data-backdrop="static" data-keyboard="false"><div class="modal-header"><h1>Processing...</h1></div><div class="modal-body"><div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div></div></div>');
	    return {
	        showPleaseWait: function() {
	            pleaseWaitDiv.modal();
	        },
	        hidePleaseWait: function () {
	            pleaseWaitDiv.modal('hide');
	        },

	    };
	})();

	function getSendData() {
		var values = [];
		$('.filter_options li.active').each(function() {
			values.push($(this).attr('id'));
		});
		return values;
	}

	function placeData(data) {
		var thumb_item = $('.masonry_item').last().clone();
		var thumb = $('#masonry_container').empty();

		$.each(data, function() {
			console.log(this);
			if(this.image != '')
				this.image = path + this.image;

			thumb_item.find('img.pollImage').attr('src', this.image);
			
			$('#container').append( $boxes ).masonry( 'appended', $boxes );
			
			thumb.append(thumb_item);
    	});
	}
});

