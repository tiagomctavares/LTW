<div class="col-lg-3 col-md-2 col-sm-1 transpDiv"></div>

<div class="container col-lg-6 col-md-8 col-sm-10 col-xs-12 logRegForm" role="form">
	<div class="panel panel-default col-lg-12">
		<h2 class="pull-left col-lg-12 col-sm-12 col-xs-12">Sign in to your account</h2>
		<div class="line col-lg-12 col-sm-12 col-xs-12"></div>
		
		<div class="col-lg-3 col-sm-2 transpDiv"></div>
		<div class="panel-body col-lg-6 col-sm-8 col-xs-12">
			<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=userLogin" method="POST">
				<div class="form-group has-feedback">
				    <div class="inner-addon left-addon col-lg-12">
				    	<i class="form-control-feedback glyphicon glyphicon-user"></i>
				   		<input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
					</div>
				</div>
				  	
				<div class="form-group has-feedback has-feedback-left">
				    <div class="inner-addon left-addon col-lg-12">
				    	<i class="form-control-feedback glyphicon glyphicon-lock"></i>
				    	<input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
				    </div>
				</div>

				<?php if((isset($success))): ?>
					<div class="col-lg-12">
					    <input type="help" class="form-control" id="" value="<?=$success?>">
					</div>	
				<?php else: ?>
					<?php foreach ($errors as $error) { ?>
						<div class="alert alert-danger col-lg-12" role="alert"><?=$error?></div>
					<?php } ?>						
				<?php endif; ?>

				<div class="form-group">
				    <div class="col-lg-12 text-right">
				      	<button type="submit" class="btn btn-info">Sign in</button>
				      	<a href="<?=HOME_URL ?>/?page=register">
				      		<button type="button" class="btn btn-primary">Register</button>
				      	</a>
				    </div>
				</div>
			</form>
		</div>
		<div class="col-lg-3 col-sm-2 transpDiv"></div>
	</div>
</div>

<div class="col-lg-3 col-md-2 col-sm-1 transpDiv"></div>


