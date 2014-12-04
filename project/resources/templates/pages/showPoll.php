<div class="col-lg-2 col-md-2 col-sm-2 transpDiv"></div>

<div class="container thumbnail col-lg-8 col-md-8 col-sm-8" id="votePollCont">	
	<form method="POST" class="col-lg-12" action="<?=HOME_URL ?>/?page=action_answerPoll" >
		<div class="col-lg-6 col-sm-6 col-xs-12">
			<input type="hidden" name="id" value= "<?=$polls->id ?>" >
		  	<h1><?=$polls->title ?></h1>
		    <h4><?=$polls->question ?></h4>

			<?php foreach ($polls->answers as $answer): ?>
	    		<div class="row">
				  <div class="col-lg-12 ">
				    <div class="input-group">
				      <span class="input-group-addon" id="voteCheckbox">
				        <input class="voteRadioBtn" type="radio" name="answer" value="<?=$answer->id ?>" <?=$answer->id == $polls->userAnswer?"checked='checked'":'' ?>>
				      </span>
				      <p> <?= $answer->answer ?> </p>
				    </div>
				  </div>
				</div>
		    <?php endforeach; ?>

		    <button>
		    	Vote
		    </button>
	    </div>

		<?php if($polls->image != ''): ?>
		  <img class="img-responsive pollImage col-lg-6 col-sm-6 col-xs-12" src="<?=UPLOAD_URL ?>/<?=$polls->image ?>" alt="...">
		<?php endif ?>
    </form>
</div>

<div class="col-lg-2 col-md-2 col-sm-2 transpDiv"></div>