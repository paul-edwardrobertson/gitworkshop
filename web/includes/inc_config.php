<?php
if (!headers_sent()) {
	header("Content-Type: text/html; charset=utf-8");
	session_start();
}

date_default_timezone_set("Europe/London");

define('DEV', ( ($_SERVER['SERVER_ADDR'] == '192.168.11.121') ? true : false));
define('FS_ROOT',$_SERVER['DOCUMENT_ROOT']."/");
define('SITE_URL',((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://").$_SERVER['HTTP_HOST']."/");

// Turn error display on for dev site
if ( DEV ) {
    error_reporting(E_ALL);
    ini_set('display_errors',1);
}

// INCLUDE REQUIRED FILES
require_once(FS_ROOT."../private/db_config.php");
require_once(FS_ROOT."includes/inc_funcs.php");

if ( $rsConfig = $pdo->query('SELECT * FROM er_config')->fetch() ) {
    // Create config variables from DB
    extract($rsConfig);
}

if ( $fetchOptions = $pdo->query("SELECT * FROM er_options")->fetchAll() ) {
    // Create option variables from DB
    foreach ( $fetchOptions as $opt ) {
        $option_name = $opt['option_name'];
        $$option_name = $opt['option_value'];
    }
}