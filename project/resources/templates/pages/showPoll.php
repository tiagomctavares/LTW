<div class="container">
  	<h1><?=$polls->title ?></h1>
    <h4><?=$polls->question ?></h4>
    <?=foreach ($polls->answers as $polls->answers): ?>
    		<div class="row">
			  <div class="col-lg-6">
			    <div class="input-group">
			      <span class="input-group-addon">
			        <input type="checkbox">
			      </span>
			      <p> $polls->answers->answer </p>
			    </div><!-- /input-group -->
			  </div><!-- /.col-lg-6 -->
			</div><!-- /.row -->
    <?=endforeach; ?>
</div>


<?php
var_dump($polls->answers->answer);
?>
