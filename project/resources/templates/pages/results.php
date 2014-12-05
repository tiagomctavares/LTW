<div class="container" id="pollResults">
	<div class="col-lg-12">
		<input type="hidden" name="id" value= "<?=$polls->id ?>" >
	  	<h1 class="col-lg-12"><?=$polls->title ?></h1>
	    <h2 class="col-lg-12"><?=$polls->question ?></h3>

	    <?php $sum = 0; ?>
	    <?php foreach ($polls->answers as $ans): ?>
	    	<?php $sum = $sum + $ans->votes; ?>
	    <?php endforeach; ?>
		
		<div class="barsChart col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div id="progressBarsDiv">
				<?php foreach ($polls->answers as $row): ?>
					<h4> <?=$row->answer ?> </h4>

					<div class="progress">
						<?php $perc = $row->votes / $sum * 100; ?>
						<div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?=$perc ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$perc ?>%">
							<span class="sr-only"> <?=$perc ?> Complete (success)</span>
						</div>
					</div>
			    <?php endforeach; ?>
			</div>
	    </div>
	     
	    <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12">
	    	<div id="pieChart" class="chart"></div>
	    </div>

	    <a type="button" class="thumbnailBtn backBtn pull-left" href="<?=HOME_URL ?>/page=<?=$previous_page?>">
	    	<button type="button">Back</button>
	    </a>
		<!--<?php var_dump($polls); ?>-->	    
    </div>
</div>