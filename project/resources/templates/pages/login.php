<div class="modal fade" role="form">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h2>ACCESS</h2>
			</div>

			<div class="modal-body">
				<form class="form-horizontal" role="form">
					<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Username</label>
					    <div class="col-sm-3">
					   		<input type="text" class="form-control" id="username" placeholder="Username">
						</div>
					</div>
					  	
					<div class="form-group">
					   	<label for="password" class="col-sm-2 control-label">Password</label>
					    <div class="col-sm-3">
					    	<input type="password" class="form-control" id="password" placeholder="Password">
					    </div>
					</div>
					
					<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-2">
					      	<button type="submit" class="btn btn-info">Sign in</button>
					    </div>

					    <div class="col-sm-offset-2 col-sm-2">
					      	<button type="button" class="btn btn-primary">
					      		<a href="<?=HOME_URL ?>?page=register">Register</a>
					      	</button>
					    </div>

					    <div class="col-sm-offset-2 col-sm-2">
					      	<button type="button" class="btn btn-default">Cancel</button>
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>