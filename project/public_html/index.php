<?php
    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # This is the first version of the structure DEPRECATED!

    # MORE INFO IN README.md section FLOW
    require_once realpath(dirname(__FILE__) . "/../resources/config.php");
    require_once VIEWS_PATH.'/pages.php';
    require_once VIEWS_PATH.'/user_actions.php';
    require_once VIEWS_PATH.'/ajax_requests.php';

    $page = isset($_GET['page'])?$_GET['page']:'';
    
    switch ($page) {
        ## ACTIONS
        case 'userRegister':
            registerUser();
            break;
        case 'userLogin':
            loginUser();
            break;
        case 'userLogout':
            logoutUser();
            break;
        case 'action_newPoll':
            newPoll();
            break;
        case 'action_answerPoll':
            answerPoll();
            break;
        case 'action_editPoll':
            editPoll();
            break;
        case 'deletePoll':
            deletePoll();
            break;
        case 'closePoll':
            closePoll();
            break;
        case 'ajax_viewFilter':
            ajax_getUserPolls();
            break;


        ## PAGES
    	case 'home':
            home();
            break;
        case 'login':
            page_login();
            break;
        case 'register':
            page_register();
            break;    
        case 'newPoll':
            $_user->managePreviousPage();
            page_newPoll();
            break;
        case 'viewAllPolls':
        case 'search':
            page_listPolls();
            break;
        case 'managePolls':
            page_listPollsUser();
            break;
        case 'showPoll':
            $_user->managePreviousPage();
            page_showPoll();
            break;
        case 'editPoll':
            $_user->managePreviousPage();
            page_editPoll();
            break;
        case 'resultsPoll':
            $_user->managePreviousPage();
            page_resultsPoll();
            break;
        default:
            home(); 
    		break;
    }
?>