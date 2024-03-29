<div class="navbar navbar-inverse navbar-fixed-top myNavbar">
	<div class="container">
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
					<form class="navbar-form col-sm-6" role="search" method="post" action="<?=HOME_URL ?>/?page=search">
				          <div class="input-group">
				            <input type="text" class="form-control" placeholder="Search Polls" name="searchPoll" id="searchPoll">
				            <div class="input-group-btn">
				              <button class="btn btn-default" type="submit">
				              	<i class="glyphicon glyphicon-search"></i>
				              </button>
				            </div>
				          </div>
        			</form>
        		</li>

        		<li>
					<a href="<?=HOME_URL ?>/?page=newPoll" data-toggle="tooltip" data-placement="bottom" title="New Poll">
						<i class="glyphicon glyphicon-plus"></i>
					</a>
				</li>
				<li>
					<li class="dropdown navbarDropdown">
						<a href="#" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" role="button" aria-expanded="false" >
	    					Welcome <?=$_user ?> <b class="caret"></b></a>
		  					<ul class="dropdown-menu" role="menu">
							    <li>
							    	<a href="<?=HOME_URL ?>/?page=managePolls"> Manage Polls
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

<div class="navbar navbar-inverse myNavbar"></div>
