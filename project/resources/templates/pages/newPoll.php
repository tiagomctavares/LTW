<div class="col-lg-3 col-md-2 col-sm-1 transpDiv"></div>

<div class="container col-lg-6 col-md-8 col-sm-10 col-xs-12 logRegForm" id="newPoll">
	<div class="panel panel-default col-lg-12">
		<h2 class="pull-left col-lg-12 col-sm-12 col-xs-12">Creating a new poll...</h2>
		<div class="line col-lg-12 col-sm-12 col-xs-12"></div>
		
		<div class="col-lg-2 col-sm-1 transpDiv"></div>
		<div class="newPollPanelBody col-lg-8 col-sm-10 col-xs-12">
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
					<div class=" col-lg-4">
						<select class="form-control" id="visability" name="isPublic">
						  <option value="1" selected>Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
						  <option value="0">Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>
						</select>
					</div>
				</div>
				
				<!-- Image -->
				<div class="form-group">
					<label for="image" class="col-lg-2">Image</label>
					<div class=" col-lg-10">
						<input type="file" id="image" name="image" class="form-control">
					</div>
				</div>

				<!-- ANSWERS -->
				<div class="example-row form-group">
					<div class="example example-one" id="answersGroup">
						<label for="answers" class="col-lg-2"> Answers </label>
						<div class="col-lg-10">
							<ul class="list-unstyled"> 
								<li>
									<input type="text" number="1" class="form-control" id="answers" placeholder="Answer 1" name="answer1" required>
								</li>
								<li>
									<input type="text" number="2" class="form-control" id="answers" placeholder="Answer 2" name="answer2" required>
								</li>
							</ul>
						</div>
						
						<button type="button" class="btn_add">
							Add
						</button>
						<button type="button" class="btn_remove">
							Remove
						</button>
					</div>
				</div>
				<br>
				<!--SUBMIT BUTTON-->
				<div class="form-group">
				    <div class="col-lg-12 text-right">
						<button type="submit" class="btn btn-info btn_create">Create</button>
				    </div>
				</div>
			</form>
		</div>
		<div class="col-lg-2 col-sm-1 transpDiv"></div>
	</div>
</div>

<div class="col-lg-3 col-md-2 col-sm-1 transpDiv"></div>
