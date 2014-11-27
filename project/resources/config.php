<?php

session_start();
# Config file for each user developing
require_once('developer_config.php');

$config = array(
    # Database
    "db" => array(
        "db1" => realpath(dirname(__FILE__) . "/..").'\db.sqlite3',
    ),
    # URL for page -> defined in dev_options
    "urls" => array(
        "baseUrl" => $user_url
    ),
    "paths" => array(
        "resources" => "../resources/",
        "images" => $_SERVER["DOCUMENT_ROOT"] . "/images/upload/"
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


defined("HOME_URL")
    or define("HOME_URL", $config['urls']['baseUrl']);

# ERROR REPORT
# THIS SETTING IS USED FOR DEBUG
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);

# Load Global LIBS and vars
## LIB to manage User Information in session
require_once('LIB'.'/userInfo.php');
$_user = new UserInfo();

## LIB to manage databaseVersion
require_once('LIB'.'/databaseVersion.php');
new databaseVersion($config['db']['db1']);

?>