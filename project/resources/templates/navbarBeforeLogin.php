<div class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand" href="#">LTW Project</a>

			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>

		<div class="collapse navbar-collapse navHeaderCollapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="active">Home</a></li>
				<li><a href="#">View Polls</a></li>
				<li>
					<form class="navbar-form" role="search">
				          <div class="input-group">
				            <input type="text" class="form-control" placeholder="Search Polls" name="searchPoll" id="searchPoll" action="">
				            <div class="input-group-btn">
				              <button class="btn btn-default" type="submit">
				              	<i class="glyphicon glyphicon-search"></i>
				              </button>
				            </div>
				          </div>
        			</form>
        		</li>
				<li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
			</ul>			
		</div>

	</div>

</div>

<!--LOGIN MODAL-->
<div class="modal fade" id="login" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h3>SIGN IN</h3>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=userLogin" method="POST">
					<div class="form-group has-feedback">
					    <div class="inner-addon left-addon col-lg-12">
					    	<i class="form-control-feedback glyphicon glyphicon-user"></i>
					   		<input type="text" class="form-control" id="username" placeholder="Username" name="username">
						</div>
					</div>
					  	
					<div class="form-group has-feedback has-feedback-left">
					    <div class="inner-addon left-addon col-lg-12">
					    	<i class="form-control-feedback glyphicon glyphicon-lock"></i>
					    	<input type="password" class="form-control" id="password" placeholder="Password" name="password">
					    </div>
					</div>
		

					<div class="form-group">
					    <div class="col-lg-12 text-right">
					      	<button type="submit" class="btn btn-info">Sign in</button>
					      	<button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#register">Register</button>
					      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<!--REGISTER MODAL-->
<div class="modal fade" id="register" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h3>REGISTER</h3>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=userRegister" method="POST">
					<div class="form-group has-feedback">
					    <!--<label for="username" class="col-lg-2 control-label">Username</label>-->
					    <div class="inner-addon left-addon col-lg-12">
					   		<input type="text" class="form-control" id="username" placeholder="Username" name="username">
					    	<i class="form-control-feedback glyphicon glyphicon-user"></i>
						</div>
					</div>
					  	
					<div class="form-group has-feedback">
					   	<!--<label for="password" class="col-lg-2 control-label">Password</label>-->
					    <div class="inner-addon left-addon col-lg-12">
					    	<input type="password" class="form-control" id="password" placeholder="Password" name="password">
					    	<i class="form-control-feedback glyphicon glyphicon-lock"></i>
					    </div>
					</div>

					<?php if((isset($success))): ?>
					<div class="col-lg-12">
					    <input type="help" class="form-control" id="" value="<?=$success?>">
					</div>	
					<?php endif; ?>
					
					<div class="form-group">
					    <div class="col-lg-12 text-right">
					      	<button type="submit" class="btn btn-info">Register</button>
					      	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
					    </div>
					</div>
			</div>
		</div>
	</div>
</div>