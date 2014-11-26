<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container myNavbar">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?=HOME_URL ?>/?page=home">LTW Project</a>

			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

		</div>

		<div class="collapse navbar-collapse navHeaderCollapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="<?=HOME_URL ?>/?page=home" class="active">Home</a></li>
				<li><a href="<?=HOME_URL ?>/?page=viewAllPolls">View Polls</a></li>
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

        		<li>
					<a href="<?=HOME_URL ?>/?page=newPoll">
						<i class="glyphicon glyphicon-plus" title="New Poll"></i>
					</a>
				</li>
				<li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="button" aria-expanded="false" >
	    					Welcome <?=$_SESSION['user']['username'] ?> <b class="caret"></b></a>
		  					<ul class="dropdown-menu" role="menu">
							    <li>
							    	<a href="#"> Manage Polls
							    		<i class="glyphicon glyphicon-pencil" title="Manage Polls"></i>
							    	</a>
							    </li>
							    <li>
							    	<a href="<?=HOME_URL ?>/?page=userLogout">Logout
							    		<i class="glyphicon glyphicon-log-out" title="Logout"></i>
							    	</a>
							    </li>
							</ul>
					</li>
				</li>
			</ul>			
		</div>
			
		</div>
</div>
