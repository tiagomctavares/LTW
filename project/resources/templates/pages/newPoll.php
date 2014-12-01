<div class="container col-lg-6 col-md-8 col-sm-10 col-xs-12 logRegForm" id="newPoll">
	<div class="panel panel-default col-lg-12">
		<h2 class="pull-left col-lg-12">Creating a new poll...</h2>
		<hr>

		<div class="panel-body col-lg-4 col-sm-8 col-xs-12">
			<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=action_newPoll" method="POST" enctype="multipart/form-data">
				<!--TITLE-->	
				<div class="form-group has-feedback">
				    <label for="title" class="col-lg-2">Title</label>
				    <div class="col-lg-10">
				   		<input type="text" class="form-control" id="title" placeholder="Poll Title" name="title" required>
					</div>
				</div>
				
				<!--QUESTION-->  	
				<div class="form-group has-feedback">
				    <label for="question" class="col-lg-2">Question</label>
				    <div class="col-lg-10">
				   		<input type="text" class="form-control" id="question" placeholder="Question" name="question" required>
					</div>
				</div>
				
				<!-- Visability -->
				<div class="form-group">
					<label for="visability" class="col-lg-2">Visability</label>
					<div class=" col-lg-2">
						<select class="form-control" id="visability" name="isPublic">
						  <option value="1">Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
						  <option value="0">Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>
						</select>
					</div>
				</div>
				
				<!-- Image -->
				<div class="form-group">
					<label for="image" class="col-lg-2">Image</label>
					<div class=" col-lg-2">
						<input type="file" id="image" name="image">
					</div>
				</div>

				<!-- ANSWERS -->
				<div class="example-row">
					<div class="example example-one">
						<label for="answers" class="col-lg-2"> Answers </label>
						<ul> 
							<li>
								<input type="text" class="form-control" id="answers" placeholder="Answers" name="answers" required>
							</li>
						</ul>
						<button class="btn_add">
							Add
						</button>
						<button class="btn_remove">
							Remove
						</button>
					</div>
				</div>

				<!--SUBMIT BUTTON-->
				<div class="form-group">
				    <div class="col-lg-12 text-right">
						<button type="submit" class="btn btn-info btn_create">Create</button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>