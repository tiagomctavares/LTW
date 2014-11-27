

	<footer class="footer navbar-fixed-bottom branco">
    	<div class="container">
        	<p class="navbar-text pull-left"> Built by Tiago Tavares, Pedro Faria and Mário Macedo</p>
			<a href="#" class="pull-right" id="qrcode" data-toggle="modal" data-target="#students">
				<i class="glyphicon glyphicon-qrcode navbar-text"></i>
			</a>
    	</div>
	</footer>

	<!--STUDENTS MODAL-->
	<div class="modal fade" id="students" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header text-center">
					<h3>Developers Information</h3>
				</div>

				<div class="modal-body">
					<div class="row">
					    <div class="col-lg-4 col-sm-8 col-xs-12">
					    	<img src="<?=HOME_URL ?>/img/marioLinkedin.png">
					    	<a href="http://goo.gl/vvodFl" class="studentsNames" target="_blank">Tiago Tavares</a>
						</div>
					  	
					    <div class="col-lg-4 col-sm-8 col-xs-12">
					    	<img src="<?=HOME_URL ?>/img/marioLinkedin.png">
					    	<a href="http://goo.gl/vvodFl" class="studentsNames" target="_blank">Pedro Faria</a>
					    </div>

					    <div class="col-lg-4 col-sm-8 col-xs-12">
					    	<img src="<?=HOME_URL ?>/img/marioLinkedin.png">
					    	<a href="http://goo.gl/vvodFl" class="studentsNames" target="_blank">Mário Macedo</a>
					    </div>
					</div>

					<div class="form-group">
					    <div class="col-lg-12 text-right">
					      	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<script src="<?=HOME_URL ?>/js/jquery-2.1.1.min.js"></script>
	<script src="<?=HOME_URL ?>/js/bootstrap.js"></script>
	<script src="<?=HOME_URL ?>/js/script.js"></script>
	<script src="<?=HOME_URL ?>/js/jquery.ui.widget.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?=HOME_URL ?>/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?=HOME_URL ?>/js/jquery.fileupload.js"></script>
	<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
	<script>
	/*jslint unparam: true */
	/*global window, $ */
	$(function () {
	    'use strict';
	    // Change this to the location of your server-side upload handler:
	    var url = window.location.hostname === 'blueimp.github.io' ?
	                '//jquery-file-upload.appspot.com/' : 'server/php/';
	    $('#fileupload').fileupload({
	        url: url,
	        dataType: 'json',
	        done: function (e, data) {
	            $.each(data.result.files, function (index, file) {
	                $('<p/>').text(file.name).appendTo('#files');
	            });
	        },
	        progressall: function (e, data) {
	            var progress = parseInt(data.loaded / data.total * 100, 10);
	            $('#progress .progress-bar').css(
	                'width',
	                progress + '%'
	            );
	        }
	    }).prop('disabled', !$.support.fileInput)
	        .parent().addClass($.support.fileInput ? undefined : 'disabled');
	});
	</script>
</body>
</html>