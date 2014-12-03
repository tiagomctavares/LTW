<?php

session_start();
# Config file for each user developing
require_once('developer_config.php');

$config = array(
    # Database
    "db" => array(
        "db1" => realpath(dirname(__FILE__)).'\db.sqlite3',
    )
);

# USEFULL PATHS
defined("LIB_PATH")
    or define("LIB_PATH", realpath(dirname(__FILE__) . '/lib'));
     
defined("TEMPLATES_PATH")
    or define("TEMPLATES_PATH", realpath(dirname(__FILE__) . '/templates'));

defined("MODELS_PATH")
    or define("MODELS_PATH", realpath(dirname(__FILE__) . '/models'));

defined("VIEWS_PATH")
    or define("VIEWS_PATH", realpath(dirname(__FILE__) . '/views'));

defined("TESTS_PATH")
    or define("TESTS_PATH", realpath(dirname(__FILE__) . '/tests'));

defined("UPLOAD_PATH")
    or define("UPLOAD_PATH", realpath(dirname('index.php'). "/img/upload"));

# USEFULL URLS
defined("HOME_URL")
    or define("HOME_URL", $user_url);

defined("UPLOAD_URL")
    or define("UPLOAD_URL", $user_url.'/img/upload/');


# ERROR REPORT
# THIS SETTING IS USED FOR DEBUG
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);

# Load Global LIBS and vars
## LIB to manage User Information in session
require_once(LIB_PATH.'/userInfo.php');
$_user = new UserInfo();

// Session to manage errors
require_once(LIB_PATH.'/pageAlerts.php');
$_alert = new pageAlerts();

## LIB to manage databaseVersion
require_once(LIB_PATH.'/databaseVersion.php');
new databaseVersion($config['db']['db1']);

function GO($str = '') {
    session_write_close();
    header('Location: '. HOME_URL.'/'.$str);
    exit;
}

function GO_ABS($str = '') {
    session_write_close();
    header('Location: '.$str);
    exit;
}
?>