<div class="container col-lg-6 col-md-8 col-sm-10 col-xs-12 logRegForm" id="editPoll">
	<div class="panel panel-default col-lg-12">
		<h2 class="pull-left col-lg-12">Editing a poll...</h2>
		<div class="line"></div>

		<div class="col-lg-6 col-sm-8 col-xs-12">
			<form class="form-horizontal" role="form" action="<?=HOME_URL ?>/?page=action_editPoll" method="POST" enctype="multipart/form-data">
				<!--TITLE-->	
				<div class="form-group has-feedback">
				    <label for="title" class="col-lg-2">Title</label>
				    <div class="col-lg-10">
				   		<input type="text" class="form-control" id="title" placeholder="<?=$polls->title ?>" name="title" required>
					</div>
				</div>
				
				<!--QUESTION-->  	
				<div class="form-group has-feedback">
				    <label for="question" class="col-lg-2">Question</label>
				    <div class="col-lg-10">
				   		<input type="text" class="form-control" id="question" placeholder="<?=$polls->question ?>" name="question" required>
					</div>
				</div>
				
				<!-- Visability -->
				<div class="form-group">
					<label for="visability" class="col-lg-2">Visability</label>
					<div class=" col-lg-4">
						<select class="form-control" id="visability" name="isPublic">
						  <option value="1" <?=$polls->isPublic?'selected':'' ?>>Public <i class="glyphicon glyphicon-eye-open" title="public"> </i></option>
						  <option value="0" <?=!$polls->isPublic?'selected':'' ?>>Private <i class="glyphicon glyphicon-eye-close" title="private"> </i></option>
						</select>
					</div>
				</div>
				
				<!-- Image -->
				<div class="form-group">
					<label for="image" class="col-lg-2">Image</label>
					<img class="img-responsive pollImage" src="<?=UPLOAD_URL ?>/<?=$polls->image ?>" alt="...">
					<div class=" col-lg-10">
						<input type="file" id="image" name="image" class="form-control">
					</div>
				</div>

				<!-- ANSWERS -->
				<div class="example-row">
					<div class="example example-one">
						<label for="answers" class="col-lg-2"> Answers </label>
						<h2> Modifies a Answer will reset all answer and reset all the votes</h2>
						<ul>
							<li>
								<input type="text" number="1" class="form-control" id="answers" placeholder="Answer 1" name="answer1" required>
							</li>
							<li>
								<input type="text" number="2" class="form-control" id="answers" placeholder="Answer 2" name="answer2" required>
							</li>
						</ul>
						
						<br>
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
	</div>
	<?php var_dump($polls) ?>
</div>
