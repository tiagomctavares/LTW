<?php
    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # MORE INFO IN README.md section FLOW
    require_once realpath(dirname(__FILE__) . "/../resources/config.php");
    require_once VIEWS_PATH.'/pages.php';
    require_once VIEWS_PATH.'/user_actions.php';

    $page = isset($_GET['page'])?$_GET['page']:'';
    
    switch ($page) {
    	case 'home':
            home();
            break;
        case 'userRegister':
            registerUser();
            break;
        case 'login':
            page_login();
            break;
        case 'register':
            page_register();
            break;    
        case 'userLogin':
            loginUser();
            break;
        case 'userLogout':
            logoutUser();
            break;
        case 'newPoll':
            newPoll();
            break;
        case 'viewAllPolls':
            listPolls();
            break;
        case 'showPoll':
            showPoll();
            break;
        case 'search':
            listPollsSearch();
            break;
        default:
            home(); 
    		break;
    }
?>