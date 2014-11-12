<?php
# Config file for each user developing
require_once('dev_options.php');

$config = array(
    # Database
    "db" => array(
        "db1" => "../db.sqlite3",
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

# ERROR REPORT
# THIS SETTING IS USED FOR DEBUG
ini_set("error_reporting", "true");
error_reporting(E_ALL|E_STRICT);

?>