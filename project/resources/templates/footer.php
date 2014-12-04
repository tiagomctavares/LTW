

	<footer class="footer navbar-fixed-bottom branco">
    	<div class="container col-lg-12">
        	<p class="navbar-text pull-left col-lg-10 col-sm-10 col-xs-12"> Built by Tiago Tavares, Pedro Faria and Mário Macedo</p>
			<a href="#" class="pull-right col-lg-2 col-sm-2 col-xs-12" id="qrcode" data-toggle="modal" data-target="#students">
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
					<div class="form-group row">
					    <div class="col-lg-4 col-sm-6 col-xs-12">
					    	<img src="<?=HOME_URL ?>/img/tiagoLinkedin.png" class="qrcode col-lg-12">
					    	<a href="pt.linkedin.com/in/tmctavares" class="studentsNames col-lg-12 text-center" target="_blank">Tiago Tavares</a>
						</div>
					  	
					    <div class="col-lg-4 col-sm-6 col-xs-12">
					    	<img src="<?=HOME_URL ?>/img/pedroLinkedin.png" class="qrcode col-lg-12">
					    	<a href="https://www.linkedin.com/pub/pedro-faria/94/b35/4b4" class="studentsNames col-lg-12 text-center" target="_blank">Pedro Faria</a>
					    </div>

					    <div class="col-lg-4 col-sm-6 col-xs-12">
					    	<img src="<?=HOME_URL ?>/img/marioLinkedin.png" class="qrcode col-lg-12">
					    	<a href="http://goo.gl/vvodFl" class="studentsNames col-lg-12 text-center" target="_blank">Mário Macedo</a>
					    </div>
					</div>

					<div class="form-group row">
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
	<script src="<?=HOME_URL ?>/js/imagesloaded.min.js"></script>
	<script src="<?=HOME_URL ?>/js/masonry.min.js"></script>
	<script src="<?=HOME_URL ?>/js/script.js"></script>
</body>
</html>