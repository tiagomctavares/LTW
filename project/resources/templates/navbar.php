<div class="navbar navbar-inverse navbar-static-top">
	<div class="container">
		<a href="#" class="navbar-brand">LTW Project</a>
		
		<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>

		<div class="collapse navbar-collapse navHeaderCollapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="active">Home</a></li>
				<li><a href="#">View Polls</a></li>
				<li><a href="#">Option</a></li>
				<li><a href="#" data-toggle="modal" data-target="#login">Login</a></li>
			</ul>			
		</div>

	</div>

</div>

<!--LOGIN MODAL-->
<div class="modal fade" id="login" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2>ACCESS</h2>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
					    <label for="username" class="col-lg-2 control-label">Username</label>
					    <div class="col-lg-10">
					   		<input type="text" class="form-control" id="username" placeholder="Username">
						</div>
					</div>
					  	
					<div class="form-group">
					   	<label for="password" class="col-lg-2 control-label">Password</label>
					    <div class="col-lg-10">
					    	<input type="password" class="form-control" id="password" placeholder="Password">
					    </div>
					</div>

					<div class="form-group">
					    <div class="col-lg-12 text-right">
					      	<button type="submit" class="btn btn-info">Sign in</button>
					      	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#register">Register</button>
					      	<button type="button" class="btn btn-default">Cancel</button>
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
			<div class="modal-header">
				<h2>REGISTER</h2>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
					    <label for="username" class="col-lg-2 control-label">Username</label>
					    <div class="col-lg-3">
					   		<input type="text" class="form-control" id="username" placeholder="Username">
						</div>
					</div>
					  	
					<div class="form-group">
					   	<label for="password" class="col-lg-2 control-label">Password</label>
					    <div class="col-lg-3">
					    	<input type="password" class="form-control" id="password" placeholder="Password">
					    </div>
					</div>
					
					<div class="form-group">
					    <div class="col-lg-2">
					      	<button type="submit" class="btn btn-info">Register</button>
					      	<button type="button" class="btn btn-default">Cancel</button>
					    </div>
					</div>
			</div>
		</div>
	</div>
</div>