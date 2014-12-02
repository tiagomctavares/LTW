<div class="container">
	<form method="POST" action="<?=HOME_URL ?>/?page=action_answerPoll" >
		<input type="hidden" name="id" value= "<?=$polls->id ?>" >
	  	<h1><?=$polls->title ?></h1>
	    <h4><?=$polls->question ?></h4>

		<?php foreach ($polls->answers as $answer): ?>
	    		<div class="row">
				  <div class="col-lg-6">
				    <div class="input-group">
				      <span class="input-group-addon">
				        <input type="radio" name="answer" value="<?=$answer->id ?>" <?=$answer->id == $polls->userAnswer?"checked='checked'":'' ?>>
				      </span>
				      <p> <?= $answer->answer ?> </p>
				    </div><!-- /input-group -->
				  </div><!-- /.col-lg-6 -->
				</div><!-- /.row -->
	    <?php endforeach; ?>

	    <button>
	    	Vote
	    </button>
    </form>
</div>