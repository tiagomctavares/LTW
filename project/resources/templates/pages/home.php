<h1><?=$setInIndexDotPhp ?></h1>

<h3>TESTS</h3>
<?php foreach($tests as $test): ?>
<p><?=$test->id.' | '.$test->description ?></p>
<?php endforeach; ?>