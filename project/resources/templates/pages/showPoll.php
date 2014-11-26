<div class="container">
		<br><br><br>
  	<h1>$poll->title</h1>		
		<?php foreach($polls as $poll): ?>
			<a class="media-left" href="<?=HOME_URL ?>/?page=showPoll">
  		<div class="media-body">
    		<h4 class="media-heading"><?=$poll->title ?></h4>
    		<p><?=$poll->question ?></p>
  		</div>
  		</a>
  		<br>
  		<?php endforeach; ?>
</div>

<?php var_dump($polls); ?>

<br><br><br>