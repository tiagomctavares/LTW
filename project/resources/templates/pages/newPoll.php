<div class="container col-lg-6 col-md-8 col-sm-10 col-xs-12 logRegForm" id="newPoll">
	<div class="panel panel-default col-lg-12">
		<h2 class="pull-left col-lg-12">Creating a new poll...</h2>
		<div class="line"></div>

		<div class="panel-body col-lg-6 col-sm-8 col-xs-12">
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
						  <option value="1" selected="selected">Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
						  <option value="0">Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>
						</select>
					</div>
				</div>
				
				<!-- Image -->
				<div class="form-group">
					<label for="image" class="col-lg-2">Image</label>
					<div class="col-lg-10">
						<input type="file" class="form-control" id="image" name="image">
					</div>
				</div>

				<!-- ANSWERS -->
				<div class="form-group effeckt-list-wrap" id="answersGroup">
					<label for="answers" class="col-lg-2"> Answers </label>
					<div class="col-lg-10">
						<ul class="effeckt-list active col-lg-10" data-effeckt-type="pop-in"> 
							<li>
								<input type="text" class="form-control" id="answers" placeholder="Answer" name="answers" required>
							</li>
						</ul>
						<button class="add" id="addAnswerButton" data-toggle="tooltip" data-placement="right" title="Add an answer...">
							<i class="glyphicon glyphicon-plus"> </i>
						</button>
						<button class="remove" style="display: none;">
							Remove
						</button>
					</div>
				</div>

				<!--SUBMIT BUTTON-->
				<div class="form-group">
				    <div class="col-lg-12 text-right">
						<button type="submit" class="btn btn-info">Create</button>
				    </div>
				</div>
			</form>
		</div>
	</div>
</div>