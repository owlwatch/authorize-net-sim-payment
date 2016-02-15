<?php
/********************************************************
* This is the main controller file
*********************************************************/
// global defines
define('ROOTDIR', dirname( __FILE__ ) );
define('ROOTPATH', dirname( $_SERVER['SCRIPT_NAME'] ));
define('ROOTURL', 'http'.
                   (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ?'s':'').
                   '://'.
                   $_SERVER['HTTP_HOST'].
                   ROOTPATH
                   );

// Composer autoload
require('vendor/autoload.php');

// Launch the application
\Payment\Controller::init();