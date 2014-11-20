	
	<footer>
		<div class="navbar navbar-default navbar-fixed-bottom">
			<div class="container">
				<a href="#" class="pull-right navbar-text" id="qrcode" data-toggle="modal" data-target="#students">
					<i class="glyphicon glyphicon-qrcode"></i>
				</a>
				<p class="navbar-text pull-right"> Built by Tiago Tavares, Pedro Faria and Mário Macedo</p>
			</div>
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
					    <div class="col-lg-4">
					    	<img src="<?=HOME_URL ?>/img/marioLinkedin.png">
					    	<a href="http://goo.gl/vvodFl" class="studentsNames" target="_blank">Tiago Tavares</a>
						</div>
					  	
					    <div class="col-lg-4">
					    	<img src="<?=HOME_URL ?>/img/marioLinkedin.png">
					    	<a href="http://goo.gl/vvodFl" class="studentsNames" target="_blank">Pedro Faria</a>
					    </div>

					    <div class="col-lg-4">
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
	
</body>
</html>