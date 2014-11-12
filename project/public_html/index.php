<?php
    require_once realpath(dirname(__FILE__) . "/../resources/config.php");

    require_once LIB_PATH."/template_functions.php";
    require_once MODELS_PATH."/tests.php";

    # This is the first version of the structure
    $tests = getAllTests();
    $test = getTest(1);
    
    $setInIndexDotPhp = "Hey! I was set in the index.php file.";
    // Must pass in variables (as an array) to use in template
    $variables = array(
        'tests' => $tests,
        'test' => $test,
        'setInIndexDotPhp' => $setInIndexDotPhp
    );
     
    renderLayoutWithContentFile("home.php", $variables);
?>