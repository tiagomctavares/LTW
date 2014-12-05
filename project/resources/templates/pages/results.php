<div class="container">
	<form method="GET" action="<?=HOME_URL ?>/?page=action_answerPoll" >
		<input type="hidden" name="id" value= "<?=$polls->id ?>" >
	  	<h1><?=$polls->title ?></h1>
	    <h2><?=$polls->question ?></h2>

	    <?php $sum = 0; ?>
	    <?php foreach ($polls->answers as $ans): ?>
	    	<?php $sum = $sum + $ans->votes; ?>
	    	<p><?= $sum ?></p>	
	    <?php endforeach; ?>
	    <br><br><p><?=$sum ?></p>
		<?php foreach ($polls->answers as $row): ?>
			<h4> <?=$row->answer ?> </h4>

			<div class="progress">
				<?php $perc = $row->votes / $sum * 100; ?>
				<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?=$perc ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$perc ?>%">
					<span class="sr-only"> <?=$perc ?> Complete (success)</span>
				</div>
			</div>

	    <?php endforeach; ?>
	     
	    <div id="pieChart" class="chart"></div>
		


		<?php var_dump($polls); ?>

	    <button>
	    	Back
	    </button>
	    
    </form>
</div>
