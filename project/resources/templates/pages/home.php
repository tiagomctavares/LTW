<h1><?=$setInIndexDotPhp ?></h1>

<h3>TESTS</h3>
<?php foreach($tests as $_test): ?>
<p><?=$_test->id.' | '.$_test->description ?></p>
<?php endforeach; ?>

<h3>TEST 1</h3>
<p><?=$test->id.' | '.$test->description ?></p>