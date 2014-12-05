
// View all pools assync request
$(function () {
	var path = 'img/upload/';
	var home_path = 'http://'+document.location.host + document.location.pathname;
	var myApp;

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
			//console.log(data);
			placeData(data);
		}).error(function() {
			alert('ERROR!');
		}).always(function() {
			myApp.hidePleaseWait();
		});
	});

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

		$('#accordion').empty();
		$.each(data, function(key, value) {
			console.log(value);
			var eye;
			var locked;
			var _public;
			var image;
			var contentClass;
			var buttons;
			if(this.isClosed == 1) locked = 'lock';
			else locked = '';

			if(this.isPublic == 1) eye = 'eye-open';
			else eye = 'eye-close';
			if(this.image != '')
				image='<img class="img-responsive pollImage col-lg-6 col-md-6 col-sm-6 col-xs-12" src="'+path+this.image+'" alt="...">';
			else image = '';

			if(this.image != '')
				contentClass='col-lg-6 col-md-6 col-sm-6 col-xs-12';
			else contentClass = 'col-lg-12';

			var link0 = home_path+'?page=showPoll&poll='+this.id;
			var link1 = home_path+'?page=editPoll&poll='+this.id;
			var link2 = home_path+'?page=resultsPoll&poll='+this.id;
			var link3 = home_path+'?page=closePoll&poll='+this.id;

			if(this.isClosed) buttons = '<a href="'+link0+'" class="btn thumbnailBtn pull-right" role="button">Vote</a><a href="'+link1+'" class="btn thumbnailBtn pull-right" role="button">Edit</a><a href="'+link3+'" class="btn thumbnailBtn pull-right" role="button">Close</a><a href="'+link2+'" class="btn thumbnailBtn pull-right" role="button">Results</a>';
			else buttons = '<p class="text-danger"><i class="glyphicon glyphicon-lock"></i> This poll is closed!</p><a href="'+link2+'" class="btn thumbnailBtn pull-right" role="button">Results</a><a href="#" class="btn thumbnailBtn pull-right" role="button" data-toggle="modal" data-target="#deleteModal">Delete</a>';

			var html = '<div class="panel panel-default" id="accordion_item"><div class="panel-heading" role="tab" id="heading'
			+key+'"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse'+key+'" aria-expanded="false" aria-controls="collapse'
			+key+'">'
			+this.title+'<small class="text-muted pull-right"><i class="glyphicon glyphicon-'+locked+'"></i> <i class="glyphicon glyphicon-'
			+eye+'"></i> <i class="glyphicon glyphicon-time"></i> '
                    +this.createDate+'</small></a></h4></div><div id="collapse'
                    +key+'" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="'+key+'"><div class="panel-body">'
                    +image+'<div class="container '
                    +contentClass+'"><h4 class="pollQuestion col-lg-12">'
                    +this.question+'</h4>'
                    +buttons+'</div></div></div></div>';

			$('#accordion').append(html);
    	});
	}
});