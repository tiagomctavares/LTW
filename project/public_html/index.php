<?php
    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # MORE INFO IN README.md section FLOW
    require_once realpath(dirname(__FILE__) . "/../resources/config.php");

    require_once LIB_PATH."/renderTemplate.php";
    require_once MODELS_PATH."/tests.php";

    # This is the first version of the structure DEPRECATED!
    $tests = getAllTests();
    $test = getTest(1);
    
    $setInIndexDotPhp = "Hey! I was set in the index.php file.";
    // Must pass in variables (as an array) to use in template
    $variables = array(
        'tests' => $tests,
        'test' => $test,
        'setInIndexDotPhp' => $setInIndexDotPhp
    );
     
    $template = new myTemplate();
    $template->render("home.php", $variables);
?>