$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function($){
	var $timeline_block = $('.cd-timeline-block');

	//hide timeline blocks which are outside the viewport
	$timeline_block.each(function(){
		if($(this).offset().top > $(window).scrollTop()+$(window).height()*0.75) {
			$(this).find('.cd-timeline-img, .cd-timeline-content').addClass('is-hidden');
		}
	});

	//on scolling, show/animate timeline blocks when enter the viewport
	$(window).on('scroll', function(){
		$timeline_block.each(function(){
			if( $(this).offset().top <= $(window).scrollTop()+$(window).height()*0.75 && $(this).find('.cd-timeline-img').hasClass('is-hidden') ) {
				$(this).find('.cd-timeline-img, .cd-timeline-content').removeClass('is-hidden').addClass('bounce-in');
			}
		});
	});
});

// add answer functions
$(".btn_add").on("click", function() {
  var insertPoint = $(this).parent().find("li:nth-child(0)");
  
  $("<li />", {
    'text': "New Item",
    'class': "new-item"
  }).insertAfter(insertPoint);
});

$("#ex-four-button, #example-four-close").on("click", function() {
  $("#example-four-slider-wrap").toggleClass("open");
});

$("#ex-five-button").on("click", function() {
  $(this)
    .toggleClass("open")
    .find(".details")
    .slideToggle();
});

$("#ex-six-button").on("click", function() {
  
  $("#example-six-list").toggleClass("open");
  
  $(this)
    .toggleClass("open")
    .find(".details")
    .slideToggle();
});