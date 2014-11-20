<?php
    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # MORE INFO IN README.md section FLOW
    require_once realpath(dirname(__FILE__) . "/../resources/config.php");

    require_once (VIEWS_PATH . "/user.php");

    $page = isset($_GET['page'])?$_GET['page']:'';
    switch ($page) {
    	case 'register':
    		page_register();
    		break;
    	
    	case 'login':
    		page_login();
    		break;
    	
    	default:
    		# code...
    		break;
    }
    test();
?>